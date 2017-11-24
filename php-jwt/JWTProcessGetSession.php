<?php
    require_once "JWTManager.php";

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $messageRequest = json_decode(file_get_contents('php://input'), true);

        $token = null;
    //    $headers = apache_request_headers();

        if(
            ($messageRequest['token'] != "") &&
            ($messageRequest['token'] != null) &&
            ($messageRequest['token'] != "undefined")
          ){

            if($messageRequest['messageName'] == "getSession"){
                $txt = JWTManager::getToken();

                $messageResponse = array("status" => 0, "msg" => "Yeee.");

            }else{
                $messageResponse = array("status" => -2, "msg" => "Sorry, this is just for session check.");
            }
        }else{
            $messageResponse = array("status" => -3, "msg" => "Sorry, token is not set or token outdated.");
        }
    }else{
        $messageResponse = array("status" => -1, "msg" => "Request method not accepted only POST messages are accepted!");
    }

    /* Output header */
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header('Content-type: application/json');

    echo json_encode($messageResponse);
    exit();
?>
