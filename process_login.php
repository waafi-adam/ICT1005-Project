
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
            <?php
            $username = $email = $pwd_hashed = $errorMsg = $success = "";
            $success = true;
            if (empty($_POST["email"])) {
                $errorMsg .= "Email is empty.<br>";
                $success = false;
            } else {
                $email = $_POST["email"];
// Additional check to make sure e-mail address is well-formed.
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errorMsg .= "Invalid email format.";
                    $success = false;
                }
            }
            if (empty($_POST["pwd"])) {
                $errorMsg .= "Password is empty.<br>";
                $success = false;
            } else {
                $pwd = $_POST["pwd"];
            }
            authenticateUser();
            if ($success) {
                echo "<main class='jumbotron text-left'>";
                echo "<h3>Login successful!</h4>";
                echo "<p>Welcome back," . $username . "</p>";
                echo "<button id='loginbtn' class='btn btn-primary' type='login'>Return to Home</button>";
            } else {
                echo "<main class='jumbotron text-left'>";
                echo "<h3>Oops!</h3>";
                echo "<h4>The following errors were detected:</h4>";
                echo "<p>" . $errorMsg . "</p>";
                echo "<button id='returnbtn' class='btn btn-primary' type='signup'>Return to Sign-up</button>" . "<br>";
            }

            function authenticateUser() {
                global $username, $email, $pwd_hashed, $errorMsg, $success;
// Create database connection.
//                $config = parse_ini_file('../../private/db-config.ini');
//                $conn = new mysqli($config['servername'], $config['username'],
//                        $config['password'], $config['dbname']);
                //Production
                //$conn = new mysqli("localhost", "project", "password", "shoeStore");
                //Test
                $conn = new mysqli("localhost", "sqldev", "InF1005", "shoeStore");

// Check connection
                if ($conn->connect_error) {
                    $errorMsg = "Connection failed: " . $conn->connect_error;
                    $success = false;
                } else {
// Prepare the statement:
                    $stmt = $conn->prepare("SELECT * FROM shoeStore_user WHERE
userEmail=?");
// Bind & execute the query statement:
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
// Note that email field is unique, so should only have
// one row in the result set.
                        $row = $result->fetch_assoc();
                        $username = $row["userName"];
                        $pwd_hashed = $row["userPassword"];
// Check if the password matches:
                        if (!password_verify($_POST["pwd"], $pwd_hashed)) {
// Don't be too specific with the error message - hackers don't
// need to know which one they got right or wrong. :)
                            $errorMsg = "Email not found or password doesn't match";
                            $success = false;
                        }
                        $verified = $row["verified"];
                        if ($verified === 0) {
                            $errorMsg = "Please register through your email first!";
                            $success = false;
                        }
                    } else {
                        $errorMsg = "Email not found or password doesn't match...";
                        $success = false;
                    }
                    $stmt->close();
                }
                $conn->close();
            }
            ?>
        </section>
    </body>
</html>