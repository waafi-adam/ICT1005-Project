<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- font-awesome -->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
            />

        <!-- styles css -->
        <link rel="stylesheet" href="css/styles.css" />
        <title>Home | Comfy</title>
    </head>
    <body>

        <?php include "includes/nav-white.inc.php"; ?> 
        <?php
        global $session;
        $username=$_SESSION['username'];
        if (empty($username)) {
            echo'<section class="register-section">
            <div class="register">
                <h1>
                    You are not logged in!
                </h1>
                <p>
                    Login here <a href="login.php">Click here to login.</a>.
                </p>
                <p>
                    Not registered? <a href="register.php">Click here to register.</a>.
                </p>
                </div>
                </section>';
        } else {
            $session->stop();
            echo'<section class="register-section">
            <div class="register">
                <h1>
                    Come again!
                </h1>
                <p>
                    Goodbye '.$username.'</p>';

            echo"<script>localStorage.removeItem('cart');</script>";        
        }
        ?>

    </body>
</html>