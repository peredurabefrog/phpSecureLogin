<?php

	require_once 'User.php';
	require_once 'UserManager.php';

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $messageRequest = json_decode(file_get_contents('php://input'), true);
        if($messageRequest['messageName'] == "processLogout"){

            $messageResponse = array("status"=> 0, "msg" => "Succesful logout.");

        }else{
            $messageResponse = array("status" => -2, "msg" => "Sorry, this is just for logout.");
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
