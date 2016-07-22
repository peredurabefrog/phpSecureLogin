<?php
    require_once 'psl-config.php';

    function loginCheck($userMailIdentifier,$pass){
        $checkResult ="";

        //create Database connection
        $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
        if ($mysqli->connect_error) {
            $checkResult = array("status" => -4, "msg" => "Database connection error!");
        }else{
            $queryUserCheck = "SELECT id, username, password, salt FROM members WHERE email = ? LIMIT 1";
            $stmt = $mysqli->prepare($queryUserCheck);
            $stmt->bind_param('s', $userMailIdentifier);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($user_id, $username, $db_password, $salt);
            $stmt->fetch();

            if ($stmt->num_rows == 1) {
                $password = hash('sha512', $pass . $salt);
                if($password == $db_password){
                    $checkResult = array("status" => 0, "msg" => "User authenticated", "useridentifier"=> $username );
                }else{
                    $checkResult = array("status" => -6, "msg" => "Wrong password for the specified user!");
                }
            }else{
                $checkResult = array("status" => -5, "msg" => "User does not exists!");
            }
        }
        return $checkResult;
    }

?>
