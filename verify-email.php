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
        <main class='jumbotron text-left'>
        <section class="register-section">

            <?php
            $errorMsg=$token = $username = $success = "";
            $success = true;
            session_start();
            if (isset($_GET['token'])) {
                $token = $_GET['token'];
                verifyUser();
                if ($success) {
                    echo "<h3>Your verification is successful!</h3>";
                    echo "<div>";
                    echo "<p>Click on the button below to login in now!</p>";
                    echo '<a href="login.php"  class="btn btn-primary">Log in now!</a>';
                    echo"</div>";
                }
                else{
                    echo "<h3>Your verification is unsuccessful!</h3>";
                    echo "<div>";
                    echo "<p>Please try again!</p>";
                    echo"</div>";
                }
            }
            else{
                    echo "<h3>Your verification is unsuccessful!</h3>";
                    echo "<div>";
                    echo "<p>Please try again!</p>";
                    echo"</div>";
                }
            

            function debug_to_console($data) {
                $output = $data;
                if (is_array($output)) {
                    $output = implode(',', $output);
                }

                echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
            }

            function verifyUser() {
                global $token, $username;
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
                    $stmt = $conn->prepare("SELECT * FROM User WHERE
verify_token=? LIMIT 1");
// Bind & execute the query statement:
                    $stmt->bind_param("s", $token);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        //Matches so we will set verified to 1
                        $update_stmt = $conn->prepare("UPDATE User SET verified='1' "
                                . "WHERE verify_token=? LIMIT 1");
// Bind & execute the query statement:
                        $update_stmt->bind_param("s", $token);
                        $update_stmt->execute();
                    } else {
                        $errorMsg = "Wrong verification code, please try again.";
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