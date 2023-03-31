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
        <main class='jumbotron text-left'>
        <section class="payment-section">
            <?php

            //set up PHPMailer variables
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;

            require 'phpmailer/src/Exception.php';
            require 'phpmailer/src/PHPMailer.php';
            require 'phpmailer/src/SMTP.php';
            
            $name = $errorMsg = $email = $address;
            $verify_token = md5(rand());
            $success = true;
            
            if (empty($_POST['name'])) {
                $errorMsg .= "Name is required.<br>";
                $success = false;
            } else {
                $username = sanitize_input($_POST['name']); //This is input validation
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
                $mail->Subject = 'Payment Success!';
                $email_template = "
                    <h2>Thank you for Purchasing with Comfy</h2>
                    <p>Your purchase will be shipped to you within 5 working days!</P>
                ";
                $mail->Body = $email_template;

                if ($mail->send()) {
                    
                    echo '<section class="payemnt-section">
                            <div class="payment">
                              <form class="account-form">
                                <h3>Thank you for purchasing with Comfy!</h3>
                                <p>Your purchase will be shipped to you within 5 working days!</P>
                                <button class="btn"><a href="index.php">Back to Homepage</a></button>
                              </form>
                            </div>
                          </section>';
                } else {
                    echo "<main class='jumbotron text-left'>";
                    echo "<h4>Can't send email to " . $email . " </h4>";
                }
            }
            else {
                echo '<section class="payment-section">
                        <div class="register">
                          <form class="account-form">
                            <h3>Oops! Following Error Detected:</h3>
                            <p>'.$errorMsg.'</P>
                            <button class="btn"><a href="index.php">Back Home</a></button>
                            <button class="btn"><a href="login.php">Return Login</a></button>
                          </form>
                        </div>
                      </section>';
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
            ?>
        </section>
        </main>
        <script type="module" src="js/toggleSidebar.js"></script>
       <script type="module" src="js/cart/setupCart.js"></script>
       <script type="module" src="js/cart/toggleCart.js"></script>
    </body>
</html>