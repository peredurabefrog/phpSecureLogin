<?php
    require_once 'includes/db_connect.php';
    require_once 'includes/functions.php';

    sec_session_start();

    if (login_check($mysqli) == true) {
        $logged = 'in';
        $_SESSION['loggedStatus'] = true;
    } else {
        $logged = 'out';
        $_SESSION['loggedStatus'] = false;
    }

    if ($_SESSION['loggedStatus']): ?>

    <!DOCTYPE html>
    <html>

    <head>

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />

        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
        <script src="js/genaralFunctions.js"></script>

    </head>

    <body>
        <div data-role="page">
            <div data-role="header">
                <h1>You need to logout</h1>
            </div>
            <div data-role="main" class="ui-content">
                <form name="logout_form">
                    <a onclick='changePage("logout.php");' class='ui-btn'>Log out</a>
                </form>
            </div>
        </div>
    </body>

    </html>

    <?php
    else : ?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta http-equiv="content-type" content="text/html; charset=utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />

            <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
            <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
            <script type="text/JavaScript" src="js/sha512.js"></script>
            <script type="text/JavaScript" src="js/loginFunctions.js"></script>

        </head>

        <body>
            <script type="text/javascript" src="js/genaralFunctions.js"></script>
            <div data-role="page">
                <div data-role="header">
                    <h1>Welcome To My Homepage</h1>
                </div>
                <div data-role="main" class="ui-content">
                    <form method="post" action="includes/process_login.php" method="post" name="login_form" id='login_form'>
                        <h3>Login information</h3>
                        <label for="email">E-mail:</label>
                        <input type="text" name="email" id="email" placeholder="e-mail ...">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" placeholder="password ...">
                        <button type="submit" value="Login" onclick="formhash(this.form, this.form.password);" />
                    </form>
                </div>
            </div>
        </body>

        </html>

        <?php endif;
    ?>
