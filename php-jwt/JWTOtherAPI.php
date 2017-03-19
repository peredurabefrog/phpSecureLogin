<?php
    require_once 'LoginAdmin.php';
    require_once 'User.php';
    require_once 'UserManager.php';

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $messageRequest = json_decode(file_get_contents('php://input'), true);
        $messageResponse = array("status" => 67, "msg" => "This is the otherAPI response", "userId"=>$messageRequest['userId'], "email"=>$messageRequest['email'],"extraTag"=>"extraTag value","buttonPressTimeStamp"=>$messageRequest['currentTime'],"uid"=>$messageRequest['uid'],"other"=>$messageRequest['other']);
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
