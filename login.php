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

        <section class="register-section">
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
        </section>
    </body>
</html>