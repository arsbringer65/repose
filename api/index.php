<?php
require_once "./config/Connection.php";
require_once "./model/Get.php";
require_once "./model/Post.php";
require_once "./model/Auth.php";
require_once "./model/Global.php";


$db = new Connection();
$pdo = $db->connect();

$get = new Get($pdo);
$post = new Post($pdo);
$auth = new Auth($pdo);

$gm = new GlobalMethods($pdo);




if (isset($_REQUEST['request'])) {
    $request = explode('/', $_REQUEST['request']);
} else {
    http_response_code(404);
}

if($_SERVER['REQUEST_METHOD'] ==='OPTIONS'){
    header('HTTP/1.1 200 OK');
    exit();
}


switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        switch ($request[0]) {
            case 'login':
                echo json_encode($auth->login($data));
                break;

            case 'addrequest':
                echo json_encode($post->add_queue($data));
                break;

            case 'addemployee':
                echo json_encode($auth->add_users($data));
            break;    

            case 'updatestudent':
                echo json_encode($post->edit_student($data, $request[1]));
                break;


            case 'hash':
                // echo md5('hello world');
             
                echo $auth->encrypt_password("Aa1234567");
                break;

            default:
                break;
        }
        break;

    case 'GET':
        switch ($request[0]) {
            case 'users':
                if (count($request) > 1) {
                    echo json_encode($get->get_users($request[1]));
                } else {
                    echo json_encode($get->get_users());
                }
                break;

            case 'queues':
                if (count($request) > 1) {
                    echo json_encode($get->get_clinic_queue($request[1]));
                } else {
                    echo json_encode($get->get_clinic_queue());
                }
                break;
            case 'registrar':
                if (count($request) > 1) {
                    echo json_encode($get->get_registrar_queue($request[1]));
                } else {
                    echo json_encode($get->get_registrar_queue());
                }
                break;
            case 'clinic':
                if (count($request) > 1) {
                    echo json_encode($get->get_clinic_queue($request[1]));
                } else {
                    echo json_encode($get->get_clinic_queue());
                }
                break;
            case 'coop':
                if (count($request) > 1) {
                    echo json_encode($get->get_coop_queue($request[1]));
                } else {
                    echo json_encode($get->get_coop_queue());
                }
                break;


            default:
                break;
        }
        break;

    case 'PUT':
        break;

    case 'PATCH':
        break;

    case 'DELETE':
        switch($request[0]){
            case 'deleteuser':
                echo json_encode($post->delete_user($request[1]));
            break;
            case 'deletetask':
                echo 'success';
            break;
            default: break;
        }
        
    break;

    default:
        http_response_code(403);
        break;
}
