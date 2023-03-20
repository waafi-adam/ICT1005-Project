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
        <?php include "includes/checkSession.php"; ?>
        <?php
        global $session;
        $username=$_SESSION['username'];
        if (empty($username)) {
            echo'<section class="register-section">
            <div class="register">
                <h1>
                    Login to your account
                </h1>
                <form class= "text-slanted" action="process_login.php" method="post">
                    <div class="form-group">
                        <label for="email">Enter your email:</label>
                        <input type="email" id="email" name="email" class="form-control"  required
                               placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" id="pwd" name="pwd" class="form-control" type="password" required
                               placeholder="Enter password">
                    </div>
                    <button class="btn btn-primary" id="submit" type="submit">Submit</button>
                    <p>
                        Not registered yet? <a href="register.php">Register here!</a>.
                    </p>
                </form>
            </div>
        </section>';
        } else {
            echo'<section class="register-section">
            <div class="register">
                <h1>
                    You are already logged in!
                </h1>
                <p>
                    Go back to homepage <a href="index.php">Click here to go back to the homepage.</a>.
                </p>
                <p>
                    Logout instead?<a href="logout.php">Click here to logout.</a>.
                </p>';
        }
        ?>

    </body>
</html>