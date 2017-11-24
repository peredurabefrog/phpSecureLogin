<?php

	require_once 'User.php';
	require_once 'UserManager.php';
    require_once 'SessionFunctions.php';

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $messageRequest = json_decode(file_get_contents('php://input'), true);
        if($messageRequest['messageName'] == "getSession"){

            SessionMaintainer::create_secure_session();
            $user = new User();
            if(session_status() == PHP_SESSION_ACTIVE){
                $user = UserManager::getFromSession();
                $messageResponse = $user->toJson();
            }else{
                $user->setUserId(-1);
                $messageResponse = $user->toJson();
            }

        }else{
            $messageResponse = array("status" => -2, "msg" => "Sorry, this is just for session check.");
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
