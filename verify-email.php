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
        <section class="register-section">
            <?php
            $token = $username = $success = "";
            $success = true;
            session_start();
            if (isset($_GET['token'])) {
                $token = $_GET['token'];
                verifyUser();
                if ($success) {
                    echo "<h1>Your verification is successful!</h1>";
                    echo "<div>";
                    echo "<p>Click on the button below to login in now!</p>";
                    echo '<button class="btn btn-primary"><a href="login.php">Log in now!</a></button>';
                    echo"</div>";
                } else {
                    echo "<h1>Your verification is unsuccessful!</h1>";
                }
            } else {
                echo "<h1>You have reached an incorrect page!</h1>";
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
                    $stmt = $conn->prepare("SELECT verified FROM User WHERE
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
                            $update_stmt = $conn->prepare("UPDATE User SET verified='1' "
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
        <script type="module" src="js/toggleSidebar.js"></script>
        <script type="module" src="js/cart/setupCart.js"></script>
        <script type="module" src="js/cart/toggleCart.js"></script>
    </body>
</html>