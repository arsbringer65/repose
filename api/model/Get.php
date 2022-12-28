<?php
class Get {

    private $pdo;
    private $gm;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->gm = new GlobalMethods($pdo);
    }



    public function get_users($id = null){
       
       $sql = "SELECT * FROM users ";
       if($id!=null){
         $sql .= "WHERE stud_no = $id";
       } 

       $res = $this->gm->execute_query($sql);
       if($res['code']==200){
        return $this->gm->response_payload($res['data'], "success", "Succesfully retrieved students data.", $res['code']);
       }
       return $this->gm->response_payload(null, "failed", "Failed to retrieved students data.", $res['code']);
    }

    public function get_queue($id = null){
       
      $sql = "SELECT * FROM queu";
      if($id!=null){
        $sql .= "AND studnum = $id";
      } 

      $res = $this->gm->execute_query($sql);
      if($res['code']==200){
       return $this->gm->response_payload($res['data'], "success", "Succesfully retrieved archived students data.", $res['code']);
      }
      return $this->gm->response_payload(null, "failed", "Failed to retrieved students data.", $res['code']);
   }

  public function get_clinic_queue($std_no = null)
  {

    $sql = "SELECT * FROM clinic_queue ";
    if ($std_no != null) {
      $sql .= "WHERE stud_no = $std_no";
    }

    $res = $this->gm->execute_query($sql);
    if ($res['code'] == 200) {
      return $this->gm->response_payload($res['data'], "success", "Succesfully retrieved students data.", $res['code']);
    }
    return $this->gm->response_payload(null, "failed", "Failed to retrieved students data.", $res['code']);
  }

  public function get_registrar_queue($id = null)
  {

    $sql = "SELECT * FROM registrar_queue ";
    if ($id != null) {
      $sql .= "WHERE stud_no = $id";
    }

    $res = $this->gm->execute_query($sql);
    if ($res['code'] == 200) {
      return $this->gm->response_payload($res['data'], "success", "Succesfully retrieved students data.", $res['code']);
    }
    return $this->gm->response_payload(null, "failed", "Failed to retrieved students data.", $res['code']);
  }

  public function get_coop_queue($id = null)
  {

    $sql = "SELECT * FROM coop_queue ";
    if ($id != null) {
      $sql .= "WHERE stud_no = $id";
    }

    $res = $this->gm->execute_query($sql);
    if ($res['code'] == 200) {
      return $this->gm->response_payload($res['data'], "success", "Succesfully retrieved students data.", $res['code']);
    }
    return $this->gm->response_payload(null, "failed", "Failed to retrieved students data.", $res['code']);
  }





}
