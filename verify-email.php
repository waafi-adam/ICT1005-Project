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
        <section class="verification-section">
            <?php
            $token = $username = $success = "";
            $success = true;
            session_start();
            if (isset($_GET['token'])) {
                $token = $_GET['token'];
                verifyUser();
                if ($success) {
                    echo "<main class='jumbotron text-left'>";
                    echo "<h1>Your verification is successful!</h4>";
                    echo "<div>";
                    echo "<p>Click on the button below to login in now!</p>";
                    echo '<button class="btn btn-primary"><a href="login.php">Log in now!</a></button>';
                    echo"</div>";
                }
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
//                $config = parse_ini_file('../private/db-config.ini');
//                $conn = new mysqli($config['servername'], $config['username'],
//                        $config['password'], $config['dbname']);
                //Test
                $conn = new mysqli("localhost", "sqldev", "InF1005", "shoeStore");

// Check connection
                if ($conn->connect_error) {
                    $errorMsg = "Connection failed: " . $conn->connect_error;
                    $success = false;
                } else {
// Prepare the statement:
                    $stmt = $conn->prepare("SELECT verified FROM shoeStore_user WHERE
verify_token=? LIMIT 1");
// Bind & execute the query statement:
                    $stmt->bind_param("s", $token);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        //Matches so we will set verified to 1
                        $row = $result->fetch_assoc();
                        $verified = $row["verified"];
                        if ($verified === 1) {
                            //already verified
                            $errorMsg = "You have already been verified, please login instead.";
                            $success = false;
                        } else {
                            //Update verified to 1 
                            $update_stmt = $conn->prepare("UPDATE shoeStore_user SET verified='1' "
                                    . "WHERE verify_token=? LIMIT 1");
// Bind & execute the query statement:
                            $update_stmt->bind_param("s", $token);
                            $update_stmt->execute();
                        }
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
    </body>
</html>