<?php
    require_once "JWTManager.php";
    require_once 'LoginAdmin.php';
    require_once 'User.php';

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $token = null;
        $headers = apache_request_headers();

/*        if(isset($headers['Authorization'])){*/

            $messageRequest = json_decode(file_get_contents('php://input'), true);
            if($messageRequest['messageName'] == "processLogin"){

                $user = new User();
                $user->setEmail($messageRequest['txtEmail']);
                $user->setPassword($messageRequest['hPassword']);

                $messageResponse = LoginAdmin::loginCheck($user);

                if($messageResponse["status"] == 0){
                    $txt = JWTManager::createToken($messageResponse["userId"]);

                    $messageResponse["token"] = $txt;

                }

            }else{
                $messageResponse = array("status" => -2, "msg" => "Sorry, this is just for session check.");
            }
        /*}else{
            $messageResponse = array("status" => -3, "msg" => "Sorry, token is not set or token outdated.");
        }*/
    }else{
        $messageResponse = array("status" => -1, "msg" => "Request method not accepted only POST messages are accepted!");
    }

    /* Output header */
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
//    header("Access-Control-Expose-Headers : Authorization");
    header('Content-type: application/json');

    echo json_encode($messageResponse);
    //session_write_close();
    exit();
?>
