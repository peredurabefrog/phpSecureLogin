<?php
    include_once 'includes/functions.php';

  sec_session_start();

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
                <div>
                    <span id='nameUser'><?php echo $_SESSION['username'] ?></span>
                    <br/>
                </div>
            </div>
            <div data-role="main" class="ui-content">
                <form name="logout_form">
                    <div>
                        <!--<a href="logout.php" class='ui-btn'>Log out</a>-->
                        <a onclick='changePage("logout.php");' class='ui-btn'>Log out</a>
                    </div>
                </form>
            </div>
        </div>
    </body>

    </html>

    <?php
    else : ?>
        <script type="text/javascript">
            window.location.href = "index.php?apple=1";
        </script>
        <?php endif;
    ?>
