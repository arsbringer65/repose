<?php
class Post {

    private $pdo;
    private $gm;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->gm = new GlobalMethods($pdo);
    }


    public function add_request($data)
    {

        $sql = "INSERT INTO requests(user_id, leave_type, starting_time, ending_time, status)
            VALUES(?,?,?,?,'pending');";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$data->user_id, $data->leave_type, $data->starting_time, $data->ending_time]);
            return $this->gm->response_payload($data, "success", "Succesfully added queu.", 200);
        } catch (PDOException $e) {
            return $this->gm->response_payload(null, "failed", $e->getMessage(), 400);
        }
    }

    public function add_user($data)
    {
        $sql = "INSERT INTO users(stud_no, fname, lname, password) 
        VALUES (?,?,?,?)";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$data->stud_no, $data->fname, $data->lname, $data->password]);
            return $this->gm->response_payload($data, "success", "Succesfully inserted data.", 200);
        } catch (PDOException $e) {
            return $this->gm->response_payload(null, "failed", $e->getMessage(), 400);
        }
    }

    public function edit_student($data, $id){
        $sql = "UPDATE student SET fname=?, lname=? WHERE studnum=?";
        try{
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$data->fname,$data->lname,$id]);
            return $this->gm->response_payload(null, "success", "Succesfully updated data.", 200);
        }
        catch(PDOException $e){
            return $this->gm->response_payload(null, "failed", $e->getMessage(), 400);
        }      
    }

    public function delete_user($id){
        $sql = "DELETE FROM users WHERE id = ?";
        try{
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            return $this->gm->response_payload(null, "success", "Succesfully deleted data.", 200);
        }
        catch(PDOException $e){
            return $this->gm->response_payload(null, "failed", $e->getMessage(), 400);
        }  
    }


}





?>