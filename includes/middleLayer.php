<?php
    require_once 'databaseFunctions.php';

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $messageRequest = json_decode(file_get_contents('php://input'), true);
        if($messageRequest['messageName'] == "processLogin"){
            $messageResponse = loginCheck($messageRequest['nameUser'],$messageRequest['secret']);
        }else{
            $messageResponse = array("status" => -2, "msg" => "There are some issues with the sent message structure!");
        }
    }else{
        $messageResponse = array("status" => -1, "msg" => "Request method not accepted only POST messages are accepted!");
    }

    /* Output header */
    header('Content-type: application/json');
    echo json_encode($messageResponse);

?>
