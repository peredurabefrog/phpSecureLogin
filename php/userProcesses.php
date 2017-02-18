<?php
    session_start();
    require_once 'LoginAdmin.php';
    require_once 'User.php';
    require_once 'UserManager.php';


    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $messageRequest = json_decode(file_get_contents('php://input'), true);
            switch ($messageRequest['messageName']) {
                case "processLogin":

                    $user = new User();
                    $user->setEmail($messageRequest['txtEmail']);
                    $user->setPassword($messageRequest['hPassword']);

                    $messageResponse = LoginAdmin::loginCheck($user);

                    if($messageResponse["status"] == 0){
                        LoginAdmin::storeInSession($user);
                    }

                    break;
                case "processLogout":

                    // Unset all session values
                    $_SESSION = array();

                    /*
                        // get session parameters
                        $params = session_get_cookie_params();
                        // Delete the actual cookie.
                        setcookie(session_name(),'', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
                    */

                    // unset session
                    session_unset();
                    // Destroy session
                    session_destroy();

                    $messageResponse = array("status"=>-1);

                    break;
                case "getSession":

                    $user = new User();
                    if(session_status() == PHP_SESSION_ACTIVE)
                    {
                        $user = UserManager::getFromSession();
                        $messageResponse = $user->toJson();
                    }
                    else
                    {
                        $user->setUserId(-1);

                        $messageResponse = $user->toJson();
                    }
                    break;
                default:
                    $messageResponse = array("status" => -1, "msg" => "No process found!");
                    break;
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
