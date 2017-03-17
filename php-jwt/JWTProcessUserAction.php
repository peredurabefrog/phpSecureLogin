<?php
    require_once "JWTManager.php";
	require_once 'User.php';
	require_once 'UserManager.php';


    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $messageRequest = json_decode(file_get_contents('php://input'), true);

        $token = null;

        if(
            ($messageRequest['token'] != "") &&
            ($messageRequest['token'] != null) &&
            ($messageRequest['token'] != "undefined")
          ){

            //$txt = JWTManager::getToken();

            //$messageResponse = array("status" => 0, "msg" => "Yeee.");

            //user is still active check
            //$user = new User();


            //get user from active session
            //$user = UserManager::getFromSession();

            //since its on the same server create the url for it, port number not included now
            $sameURLStart = $_SERVER['REQUEST_URI'];
            $lastPosition = strripos($sameURLStart, "/");

            //putting together url
            $url = "http://".$_SERVER['SERVER_NAME'].substr($sameURLStart,0,$lastPosition)."/OtherAPI.php";

            // adding extra tags for forward message and post to other API
            //$messageRequest['userId'] = $user->getUserId();
            //$messageRequest['email'] = $user->getEmail();

            //format request to json
            $forwardedRequest = json_encode($messageRequest);

            //put together the call
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_URL,$url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $forwardedRequest);

            //send request and store response
            $json_response = curl_exec($curl);

            //check request-response status
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            //prepare response received
            $messageResponse = json_decode($json_response, true);

            //close curl
            curl_close($curl);


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
