<?php
    require_once 'includes/functions.php';
    sec_session_start();

    // Unset all session values
    $_SESSION = array();

    // get session parameters
    $params = session_get_cookie_params();

    // Delete the actual cookie.
    setcookie(session_name(),'', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);

    // unset session
    session_unset();

    // Destroy session
    session_destroy();
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    </head>

    <body>
        <script type="text/javascript">
            $(document).ready(function () {
                window.location.href = "index.php";
            });
        </script>
    </body>

    </html>
