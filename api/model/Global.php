<?php
class GlobalMethods {

    private $pdo;
    private $gm;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function execute_query($sql){
       $data = array();
       $errmsg = "";
       $code = 0;

       try{
           if($result = $this->pdo->query($sql)->fetchAll()){
             foreach($result as $record){
                array_push($data, $record);
             }   
             $result = null;
             $code = 200;
             return array("code"=>$code, "data"=>$data);
           }
           else{
            $errmsg = "No data found";
            $code = 404;
           }
       }
       catch(PDOException $e){
          $errmsg = $e->getMessage();
          $code = 403;
       }
       return array("code"=>$code, "errmsg"=>$errmsg);
    }

    public function response_payload($payload, $remarks, $message, $code){
        $status = array("remarks"=>$remarks, "message"=>$message);
        http_response_code($code);
        return array(
            "status"=>$status,
            "payload"=>$payload,
            "timestamp"=> date_create(),
            "prepared_by"=> "Call of Duty: Modern Wireframe"
        );
    }


    public function insert($table, $data){

    }


    public function update($table, $data, $conditionString){
        
    }
}





?>