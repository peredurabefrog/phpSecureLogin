<?php

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $messageRequest = json_decode(file_get_contents('php://input'), true);

        if($messageRequest['messageName'] == "processLogin"){
            if($messageRequest['nameUser'] == "test"){
                if($messageRequest['secret'] == "ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff"){
                    $messageResponse = array("status" => 0, "msg" => "User authenticated", "useridentifier"=>"testUser");
                }else{
                    $messageResponse = array("status" => -3, "msg" => "Username and password missmatch!");
                }
            }else{
                $messageResponse = array("status" => -3, "msg" => "Username and password missmatch!");
            }
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
