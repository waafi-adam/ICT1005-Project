
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
        <?php
        $username = $email = $pwd_hashed = $errorMsg = $success = $OTP = "";
        $userID = "";
        $adminMode = 0;
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
        if (empty($_POST["otp"])) {
            $errorMsg .= "OTP is empty.<br>";
            $success = false;
        } else {
            $OTP = $_POST["otp"];
        }

        authenticateAdmin();
        if ($success) {
            $adminMode = 1;
            $_SESSION['username'] = $username;
            $_SESSION['userID'] = $userID;
            $_SESSION['adminMode'] = $adminMode;
        }

        function authenticateAdmin() {
            global $username, $email, $pwd_hashed, $errorMsg, $success;
            global $userID, $OTP;
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
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
// Note that email field is unique, so should only have
// one row in the result set.
                    $row = $result->fetch_assoc();
                    $username = $row["admin_name"];
                    $pwd_hashed = $row["admin_email"];
                    $otp_hashed = $row["admin_otp"];
                    if (!password_verify($OTP, $otp_hashed)) {
                        //Check if hashed OTP matches
                        $errorMsg = "Email not found or password doesn't match11";
                        $success = false;
                    }
                    $userID = $row["userID"];
                } else {
                    $errorMsg = "Email not found or password doesn't match...";
                    $success = false;
                }
                $stmt->close();
            }
            $conn->close();
        }
        ?>

        <!-- navbar -->

        <nav class="navbar">
            <div class="nav-center">
                <!-- links -->
                <div>
                    <button class="toggle-nav">
                        <i class="fas fa-bars"></i>
                    </button>
                    <ul class="nav-links">
                        <li>
                            <a href="index.php" class="nav-link">
                                home
                            </a>
                        </li>
                        <li>
                            <a href="products.php" class="nav-link">
                                products
                            </a>
                        </li>
                        <li>
                            <a href="about.php" class="nav-link">
                                about
                            </a>
                        </li>
                    </ul>
                    <?php
                    global $success, $username, $adminMode;
                    $loggedin = $success;
                    if (!$loggedin) {
                        echo '<ul class="nav-links">
                <li>
                    <a href="register.php" class="nav-link">
                        Register
                    </a>
                </li>
                <li>
                    <a href="login.php" class="nav-link">
                        Login
                    </a>
                </li>
            </ul>';
                    } else if ($adminMode == 1) {
                        echo '<ul class="nav-links">
                <li>
                    <a href="logout.php" class="nav-link">
                        Logout
                    </a>
                </li>
                <li>
                    <a href="admin.php" class="nav-link">
                        Admin
                    </a>
                </li>
            </ul>';
                    } else {
                        echo '<ul class="nav-links">
                <li>
                    <a href="logout.php" class="nav-link">
                        Logout
                    </a>
                </li>
                <li>
                    <a href="orderHistory.php" class="nav-link">
                        ' . $username . '
                    </a>
                </li>
            </ul>';
                    }
                    ?>
                </div>
                <!-- logo -->
                <img src="images/logo-white.svg" class="nav-logo" alt="logo">
                <!-- cart icon -->
                <div class="toggle-container">
                    <button class="toggle-cart">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                    <span class="cart-item-count">0</span>
                </div>
            </div>
        </nav> 
        <?php include "includes/sidebar.php"; ?>
        <?php
        if ($success) {
            global $username;
            echo '<section class="register-section">
                            <div class="register">
                              <form class="account-form">
                                <h3>Login Successful, welcome back ' . $username . '!</h3>
                                <button class="btn" type="button" onclick="location.href=\'index.php\';">Back Home</button>
                                <button class="btn" type="button" onclick="location.href=\'admin.php\';">Admin Page</button>
                              </form>
                            </div>
                          </section>';
        } else {
            echo '<section class="register-section">
                            <div class="register">
                              <form class="account-form">
                                <h3>Oops! Following Error(s) Detected:</h3>
                                <p>' . $errorMsg . '</P>
                                <button class="btn" type="button" onclick="location.href=\'index.php\';">Back Home</button>
                                <button class="btn" type="button" onclick="location.href=\'admin_login.php\';">Return Admin Login</button>
                              </form>
                            </div>
                          </section>';
        }
        ?>
    </section>
</main>
<script type="module" src="js/toggleSidebar.js"></script>
<script type="module" src="js/cart/setupCart.js"></script>
<script type="module" src="js/cart/toggleCart.js"></script> 
</body>
</html>