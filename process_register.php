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
            //For debugging purposes (Delete once onto production)
            ini_set('display_errors', 1);
            error_reporting(E_ALL);

            //set up PHPMailer variables
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
            require 'phpmailer/src/PHPMailer.php';
            require 'phpmailer/src/SMTP.php';
            $email = $errorMsg = $username = $pwd = $pwd_confirm = $pwd_hashed = "";
            $verify_token = md5(rand());
            $success = true;
            if (empty($_POST['username'])) {
                $errorMsg .= "User name is required.<br>";
                $success = false;
            } else {
                $username = sanitize_input($_POST['username']); //This is input validation
            }
            if (empty($_POST["email"])) {
                $errorMsg .= "Email is required.<br>";
                $success = false;
            } else {
                $email = sanitize_input($_POST["email"]);
// Additional check to make sure e-mail address is well-formed.
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errorMsg .= "Invalid email format.";
                    $success = false;
                }
            }
            if (empty($_POST["pwd"]) || empty($_POST["pwd_confirm"])) {
                $errorMsg .= "Both passwords are required.<br>";
                $success = false;
            } else {
                $pwd = $_POST["pwd"];
                $pwd_confirm = $_POST["pwd_confirm"];
                if ($pwd != $pwd_confirm) {
                    $errorMsg .= "Passwords do not match!.<br>";
                    $success = false;
                }
            }
            $pwd_hashed = password_hash($pwd, PASSWORD_DEFAULT);

            saveMemberToDB();
            if ($success) {
                $smtpconfig = parse_ini_file('../private/smtp_cred.ini');
                $mail = new PHPMailer(true);
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
                $mail->SMTPSecure = 'ssl';
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->Username = $smtpconfig['email'];
                $mail->Password = $smtpconfig['password'];
                $mail->setFrom('2201113.sit@gmail.com');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Welcome to Comfy!';
                $email_template = "
                    <h2>Thank you for registering with Comfy!</h2>
                    <h5>Verify your account with the link below</h5>
                    <br/><br/>
                    <a href='http://35.212.148.163/verify-email.php?token=$verify_token'>Click me</a>
                ";
                $mail->Body = $email_template;

                if ($mail->send()) {
                    debug_to_console("inside if");
                    echo "<main class='jumbotron text-left'>";
                    echo "<h4>Your registration is successful!</h4>";
                    echo "<p> Thank you for signing up," . $username . "</p>";
                    echo "<p>Email: " . $email . "<br>";
                    echo "<p> Please check your email to verify your account! </p>";
                } else {
                    echo "<main class='jumbotron text-left'>";
                    echo "<h4>Can't send email to " . $email . " </h4>";
                }
            } else {
                echo "<main class='jumbotron text-left'>";
                echo "<h3>Oops!</h3>";
                echo "<h4>The following input errors were detected:</h4>";
                echo "<p>" . $errorMsg . "</p>";
                echo '<button class="btn btn-primary"><a href="register.php">Return back to sign-in page</a></button>';
            }

            //Helper function that checks input for malicious or unwanted content.
            function sanitize_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            function debug_to_console($data) {
                $output = $data;
                if (is_array($output)) {
                    $output = implode(',', $output);
                }

                echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
            }

            /*
             * Helper function to write the member data to the DB
             */

            function saveMemberToDB() {
                global $username, $email, $pwd_hashed, $errorMsg, $success, $verify_token;
                // Create database connection.prod
                $config = parse_ini_file('../private/db-config.ini');
                $conn = new mysqli($config['servername'], $config['username'],
                        $config['password'], $config['dbname']);
                
                // Check connection
                if ($conn->connect_error) {
                    $errorMsg = "Connection failed: " . $conn->connect_error;
                    $success = false;
                } else {
                    // Prepare the statement:
                    
                    $stmt = $conn->prepare("INSERT INTO User (userName,
            userEmail, userPassword,verified,verify_token) VALUES (?, ?, ?, ?,?)");
                    $notverified = 0;
                    $stmt->bind_param("sssis", $username, $email, $pwd_hashed, $notverified, $verify_token);
                    if (!$stmt->execute()) {
                        $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
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