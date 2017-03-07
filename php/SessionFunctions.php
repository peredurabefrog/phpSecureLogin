<?php
    require_once 'config.php';

    class SessionMaintainer{
        public static function create_secure_session(){
            //$session_name = 'sec_session_id';   // Set a custom session name
            $secure = SECURE; //settings coming from configuration file;

            // This stops JavaScript being able to access the session id.
            $httponly = true;

            //fix save path for cookies
            ini_set(' session.save_path',SESSIONFOLDER);

            // Forces sessions to only use cookies.
            ini_set('session.use_only_cookies', 1);

            // Gets current cookies params.
            $cookieParams = session_get_cookie_params();
            session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);

            // Sets the session name to the one set above.
            //session_name($session_name);

            session_start();            // Start the PHP session
            //session_regenerate_id();    // regenerated the session, delete the old one.
        }
    }

?>
