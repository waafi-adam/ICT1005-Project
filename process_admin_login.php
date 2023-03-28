
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
        <main class='jumbotron text-left'>
        <section class="register-section">
            <?php
            $username = $email = $pwd_hashed = $errorMsg = $success = $OTP="";
            $userID="";
            $adminMode=0;
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
            if(empty($_POST["otp"])){
                $errorMsg.="OTP is empty.<br>";
                $success=false;
            }
            else{
                $OTP=$_POST["otp"];
            }
            authenticateUser();
            if ($success) {
                $adminMode=1;
                echo "<h3>Login successful!</h3>";
                echo "<p>Welcome back," . $username . "</p>";
                echo '<a href="admin.php" class="btn btn-primary">View User Order History</a>';
                $_SESSION['username'] = $username;
                $_SESSION['userID']=$userID;
                $_SESSION['adminMode']=$adminMode;
            } else {
                echo "<h3>Oops!</h3>";
                echo "<h4>The following errors were detected:</h4>";
                echo "<p>" . $errorMsg . "</p>";
                echo '<a href="login.php" class="btn btn-primary">Return back to login page</a>';
            }

            function debug_to_console($data) {
                $output = $data;
                if (is_array($output)) {
                    $output = implode(',', $output);
                }

                echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
            }

            function authenticateUser() {
                global $username, $email, $pwd_hashed, $errorMsg, $success;
                global $userID,$OTP;
// Create database connection.
                $config = parse_ini_file('../private/db-config.ini');
                $conn = new mysqli($config['servername'], $config['username'],
                        $config['password'], $config['dbname']);
// Check connection
                if ($conn->connect_error) {
                    $errorMsg = "Connection failed: " . $conn->connect_error;
                    $success = false;
                } else {
// Prepare the statement:
                    $stmt = $conn->prepare("SELECT * FROM Admin WHERE
admin_email=?");
// Bind & execute the query statement:
        debug_to_console($email);
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
// Note that email field is unique, so should only have
// one row in the result set.
                        $row = $result->fetch_assoc();
                        $username = $row["admin_name"];
                        $pwd_hashed = $row["admin_email"];
                        $otp_hashed=$row["admin_otp"];
                        debug_to_console($otp_hashed);
                        debug_to_console($OTP);
                        if (!password_verify($OTP, $otp_hashed)) {
                    //Check if hashed OTP matches
                            $errorMsg = "Email not found or password doesn't match11";
                            $success = false;
                        }
                        $userID=$row["userID"];
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
        </main>
    </body>
</html>