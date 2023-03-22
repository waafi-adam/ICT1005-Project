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

        <?php include "includes/nav-session.inc.php"; ?> 
        <?php
        $username=$_SESSION['username'];
        $userID=$_SESSION['userID'];
        if (empty($username)) {
            echo'<section class="register-section">
            <div class="register">
                <h1>
                    Sign up now!
                </h1>
                <form id="form" class= "text-slanted" action="process_register.php" method="post">
                    <div class="form-group">
                        <label for="lname">User Name:</label>
                        <input type="text" id="username" name="username" class="form-control" required maxlength="45"
                               placeholder="Enter user name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control"  required
                               placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" id="pwd" name="pwd" class="form-control" type="password" required
                               placeholder="Enter password">
                    </div>
                    <div class="form-group">
                        <label for="pwd_confirm">Confirm Password:</label>
                        <input type="password" id="pwd_confirm" name="pwd_confirm" class="form-control" 
                               required type="password" placeholder="Confirm password">
                    </div>
                    <div class="form-group">
                        <div class="form-check"
                             <label>
                            <input type="checkbox" name="agree" required>
                            I agree to the terms and conditions.
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-primary" id="submit"  type="submit">Submit</button>
                    <p>
                        Already a member with us? <a href="login.php">Login here.</a>.
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