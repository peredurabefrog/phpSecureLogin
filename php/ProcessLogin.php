<?php
    require_once 'LoginAdmin.php';
    require_once 'User.php';
    require_once 'SessionFunctions.php';



    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $messageRequest = json_decode(file_get_contents('php://input'), true);
        if($messageRequest['messageName'] == "processLogin"){

            SessionMaintainer::create_secure_session();

            $user = new User();
            $user->setEmail($messageRequest['txtEmail']);
            $user->setPassword($messageRequest['hPassword']);

            $messageResponse = LoginAdmin::loginCheck($user);

            if($messageResponse["status"] == 0){
                LoginAdmin::storeInSession($user);
            }

        }else{
            $messageResponse = array("status" => -2, "msg" => "Sorry, this is just for login processing.");
        }

    }else{
        $messageResponse = array("status" => -1, "msg" => "Request method not accepted only POST messages are accepted!");
    }

    /* Output header */
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header('Content-type: application/json');

    echo json_encode($messageResponse);
    session_write_close();
    exit();
?>
