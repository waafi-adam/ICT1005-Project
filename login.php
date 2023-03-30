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
        <?php include "includes/sidebar.php"; ?>
        <?php
        $username = $_SESSION['username'];
        $userID = $_SESSION['userID'];
        $email = $_SESSION['useremail'];
        if (empty($username)) {
            echo'<section class="register-section">
            <div class="register">
                <form class= "account-form" action="process_login.php" method="post">
                    <img
                        src="images/logo-black.svg"
                        alt="logo-black"
                    />
                    <h3>Login</h3>
                    <div class="form-group">
                        <label for="email">Enter your email:</label>
                        <input type="email" id="email" name="email" class="form-control"  required
                               placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input id="pwd" name="pwd" class="form-control" type="password" required
                               placeholder="Enter password">
                    </div>
                    <button class="btn btn-primary" id="submit" type="submit">Submit</button>
                    <p>
                        Not a member yet? <a href="register.php">Register</a>.
                    </p>
                </form>
            </div>
        </section>';
        } else {
            echo'<section class="register-section">
                    <div class="register">
                      <form class="account-form">
                        <h3>You are already logged in!</h3>
                        <button class="btn"><a href="index.php">Back Home</a></button>
                        <button class="btn"><a href="logout.php">Log out</a></button>
                      </form>
                    </div>
                  </section>';
        }


        //For displaying pls login message
        if (isset($_SESSION['message'])) {
            //Change H1 text
            echo "<script>document.querySelector('h3').innerText = 'Login to Checkout'</script>";
            unset($_SESSION['message']); // clear the value so that it doesn't display again
        }
        ?>
        <script type="module" src="js/toggleSidebar.js"></script>
        <script type="module" src="js/cart/setupCart.js"></script>
        <script type="module" src="js/cart/toggleCart.js"></script> 
    </body>
</html>