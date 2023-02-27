<?php
class Get {

    private $pdo;
    private $gm;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->gm = new GlobalMethods($pdo);
    }



    public function get_employee($id = null){
       
       $sql = "SELECT * FROM employees ";
       if($id!=null){
         $sql .= "WHERE stud_no = $id";
       } 

       $res = $this->gm->execute_query($sql);
       if($res['code']==200){
        return $this->gm->response_payload($res['data'], "success", "Succesfully retrieved the data.", $res['code']);
       }
       return $this->gm->response_payload(null, "failed", "Failed to retrieved the data.", $res['code']);
    }

  public function get_employeecount($id = null)
  {

    $sql = "SELECT COUNT(*) as total FROM employees ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();


    return $result = $stmt->fetch(PDO::FETCH_ASSOC);
  }

    public function get_request($id = null){
       
      $sql = "SELECT * FROM requests ";
      if($id!=null){
        $sql .= "WHERE id = $id";
      } 

      $res = $this->gm->execute_query($sql);
      if($res['code']==200){
       return $this->gm->response_payload($res['data'], "success", "Succesfully retrieved archived the data.", $res['code']);
      }
      return $this->gm->response_payload(null, "failed", "Failed to retrieved the data.", $res['code']);
   }

  public function get_requestcount($id = null)
  {

    $sql = "SELECT COUNT(*) as total FROM requests ";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();


    return $result = $stmt->fetch(PDO::FETCH_ASSOC);
  }
  public function get_pendingcount($id = null)
  {

    $sql = "SELECT COUNT(*) as total FROM requests WHERE status = 'pending';";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();


    return $result = $stmt->fetch(PDO::FETCH_ASSOC);
  }
  public function get_approvedcount($id = null)
  {

    $sql = "SELECT COUNT(*) as total FROM requests WHERE status = 'approved';";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();


    return $result = $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function get_declinedcount($id = null)
  {

    $sql = "SELECT COUNT(*) as total FROM requests WHERE status = 'approved';";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();


    return $result = $stmt->fetch(PDO::FETCH_ASSOC);
  }

  





}
