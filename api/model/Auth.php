<?php
class Auth
{

    private $pdo;
    private $gm;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->gm = new GlobalMethods($pdo);
    }

    public function encrypt_password($pword)
    {
        $hashFormat = "$2y$10$";
        $saltLength = 22;
        $salt = $this->generateSalt($saltLength);
        return crypt($pword, $hashFormat . $salt);
    }

    private function generateSalt($saltLength)
    {
        $str = md5(uniqid(mt_rand(), true));
        $b64string = base64_encode($str);
        $mb64string = str_replace("+", ".", $b64string);
        return substr($mb64string, 0, $saltLength);
    }

    private function checkPassword($pword, $existingHash)
    {
        return $existingHash === crypt($pword, $existingHash);
    }


    public function add_users($data)
    {

        // $sql = "INSERT INTO employees(fname, lname , email , dpt, position, password)
        //     VALUES('$data->fname', '$data->lname', '$data->email', '$data->dpt', '$data->position', ?);";
        $sql = "INSERT INTO users(fname, lname , email , dpt, position, password)
            VALUES('$data->fname', '$data->lname', '$data->email', '$data->dpt', '$data->position', ?);";

        try {
            $stmt = $this->pdo->prepare($sql);
            $data->password = password_hash($data->password, PASSWORD_DEFAULT);
            $stmt->execute([$data->password]);
            return $this->gm->response_payload($data, "success", "Succesfully added user.", 200);
        } catch (PDOException $e) {
            return $this->gm->response_payload(null, "failed", $e->getMessage(), 400);
        }
    }

    public function login($data)
    {
        $username = $data->email;
        $password = $data->password;
        $sql = "SELECT * FROM employees WHERE email = ? LIMIT 1";
        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute([$username]);
            if ($stmt->rowCount() > 0) {
                $res = $stmt->fetchAll()[0];
                if (password_verify($password, $res['password'])) {
                    $data = array(
                        "fname" => $res['fname'],
                        "lname" => $res['lname'],
                        "position" => $res['position']
                    );

                    return $this->gm->response_payload($data, "success", "Succesfully logged in.", 200);
                } else {
                    return $this->gm->response_payload(null, "failed", "Incorrect password", 401);
                }
            } else {
                return $this->gm->response_payload(null, "failed", "Incorrect username", 401);
            }
        } catch (\PDOException $e) {
            return $this->gm->response_payload(null, "failed", "Unable to process data.", 401);
        }
    }
}
