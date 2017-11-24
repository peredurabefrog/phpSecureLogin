<?php
    session_start();
    require_once 'UserManager.php';
    require_once 'User.php';

    class LoginAdmin{
        public static function loginCheck($user){
            $result = "";
            $dbUser = UserManager::getUser($user);

            switch ($dbUser->getUserId()) {
                case -1:
                    $result =  array("status" => -4, "msg" => "Database connection error!");
                    break;
                case -2:
                    $result = array("status" => -5, "msg" => "User does not exists!");
                    break;
                case -3:
                    $result = array("status" => -6, "msg" => "Wrong password for the specified user!");
                    break;
                default:
                    $result = array("status" => 0, "msg" => "User authenticated", "userId"=> $user->getUserId());
                    break;
            }
            return($result);
		}

        public static function storeInSession($user){
            $_SESSION["userId"] = $user->getUserId();
            $_SESSION["username"] = $user->getUsername();
            $_SESSION["email"] = $user->getEmail();
        }
    }
?>
