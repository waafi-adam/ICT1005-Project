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
        <div class="cart-overlay">
            <aside class="cart">
                <button class="cart-close">
                    <i class="fas fa-times"></i>
                </button>
                <header>
                    <h3 class="text-slanted">your bag</h3>
                </header>
                <!-- cart items -->
                <div class="cart-items"></div>
                <!-- footer -->
                <footer>
                    <h3 class="cart-total text-slanted">
                        total: $12.00
                    </h3>
                    <button class="cart-checkout btn">checkout</button>
                </footer>
            </aside>
        </div>
        <main class='jumbotron text-left'>
            <section class="register-section">
                <?php

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
                    $username = sanitize_input($_POST['username']);
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
                        echo '<div>
                           <section class="register-section">
                            <div class="register">
                              <form class="account-form">
                                <h3>Registration Successful, Welcome ' . $username . '!</h3>
                                <p> Email: ' . $email . '</P>
                                <p> Please check your email to verify your account! </p>
                                <button class="btn" type="button" onclick="location.href=\'login.php\';">Login</button>
                              </form>
                            </div>
                          </section>
                          </div>';
                    } else {
                        echo '<div><section class="register-section">
                            <div class="register">
                              <form class="account-form">
                                <h3>Unable to send email to ' . $email . '!</h3>
                              </form>
                            </div>
                          </section>
                          </div>';
                    }
                } else {
                    echo '<div>
                        <section class="register-section">
                        <div class="register">
                          <form class="account-form">
                           <h3>Oops! Following Error Detected:</h3>
                            <p>' . $errorMsg . '</P>
                            <button class="btn" type="button" onclick="location.href=\'index.php\';">Back Home</button>    
                            <button class="btn" type="button" onclick="location.href=\'login.php\';">Return Login</button>
                          </form>
                        </div>
                      </section>
                      </div>';
                }

                //Helper function that checks input for malicious or unwanted content.
                function sanitize_input($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
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
        </main>
        <script type="module" src="js/toggleSidebar.js"></script>
        <script type="module" src="js/cart/setupCart.js"></script>
        <script type="module" src="js/cart/toggleCart.js"></script>
    </body>
</html>