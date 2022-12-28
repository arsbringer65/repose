<?php
class Post {

    private $pdo;
    private $gm;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->gm = new GlobalMethods($pdo);
    }


    public function add_queue($data){
        $sql = "INSERT INTO queu(name, email, queu_no, dpt) 
        VALUES (?,?,?,?)";
        try{
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$data->name, $data->email, $data->queu_no, $data->dpt]);
            return $this->gm->response_payload($data, "success", "Succesfully inserted data.", 200);
        }
        catch(PDOException $e){
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

    // Registrar
    public function add_registrar($data)
    {
        $sql = "SELECT MAX(queue_no) FROM registrar_queue";

        $stmt = $this->pdo->prepare($sql);

        // Execute the statement
        $stmt->execute();

        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Extract the maximum queue number from the result array
        $max = $result['MAX(queue_no)'];

        // Increment the maximum queue number by 1 to get the next queue number
        $next = $max + 1;

        $sql = "INSERT INTO registrar_queue(stud_no, queue_no, purpose) 
        VALUES (?, $next, ?)";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$data->stud_no, $data->purpose]);
            return $this->gm->response_payload($data, "success", "Succesfully inserted data.", 200);
        } catch (PDOException $e) {
            return $this->gm->response_payload(null, "failed", $e->getMessage(), 400);
        }
    }

    // Clinic
    public function add_clinic($data)
    {
        
        $sql = "SELECT MAX(queue_no) FROM clinic_queue";

        $stmt = $this->pdo->prepare($sql);

        // Execute the statement
        $stmt->execute();

        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Extract the maximum queue number from the result array
        $max = $result['MAX(queue_no)'];

        // Increment the maximum queue number by 1 to get the next queue number
        $next = $max + 1;

        $sql = "INSERT INTO clinic_queue(stud_no, queue_no, purpose) 
        VALUES (?, $next, ?)";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$data->stud_no, $data->purpose]);
            return $this->gm->response_payload($data, "success", "Succesfully inserted data.", 200);
        } catch (PDOException $e) {
            return $this->gm->response_payload(null, "failed", $e->getMessage(), 400);
        }
    }


    // COOP
    public function add_coop($data)
    {
        $sql = "SELECT MAX(queue_no) FROM coop_queue";

        $stmt = $this->pdo->prepare($sql);

        // Execute the statement
        $stmt->execute();

        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Extract the maximum queue number from the result array
        $max = $result['MAX(queue_no)'];

        // Increment the maximum queue number by 1 to get the next queue number
        $next = $max + 1;

        $sql = "INSERT INTO coop_queue(stud_no, queue_no, purpose) 
        VALUES (?, $next, ?)";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$data->stud_no, $data->purpose]);
            return $this->gm->response_payload($data, "success", "Succesfully inserted data.", 200);
        } catch (PDOException $e) {
            return $this->gm->response_payload(null, "failed", $e->getMessage(), 400);
        }
    }





}





?>