
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
        <?php include "includes/checkSession.php"; ?>
        <?php
        $username = $email = $pwd_hashed = $errorMsg = $success = "";
        $userID = "";
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
            $_SESSION['username'] = $username;
            $_SESSION['userID'] = $userID;
            $_SESSION['useremail'] = $email;
        }

        function authenticateUser() {
            global $username, $email, $pwd_hashed, $errorMsg, $success;
            global $userID;
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
                $stmt = $conn->prepare("SELECT * FROM User WHERE
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
                        <?php
                        global $success;
                        $loggedin=$success;
                        if (!$loggedin) {
                            echo '<ul class="nav-links-right">
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
                        } else {
                            echo '<ul class="nav-links-right">
                <li>
                    <a href="logout.php" class="nav-link">
                        Logout
                    </a>
                </li>
                <li>
                    <a href="orderHistory.php" class="nav-link">
                        Profile
                    </a>
                </li>
            </ul>';
                        }
                        ?>
                    </ul>
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
        <main class='jumbotron text-left'>
            <section class="register-section">
                <?php
                global $username, $email, $pwd_hashed, $errorMsg, $success;
                global $userID;
                if ($success) {
                    //echo "<script>localStorage.setItem('product', '$json');</script>";

                    echo '<section class="register-section">
                            <div class="register">
                              <form class="account-form">
                                <h3>Login Successfull, welcome back ' . $username . '!</h3>
                                <button class="btn"><a href="index.php">Back Home</a></button>
                                <button class="btn"><a href="orderHistory.php">Profile</a></button>
                              </form>
                            </div>
                          </section>';

                    //Cart stuff
                    echo "<script>if(localStorage.getItem('cart')){localStorage.removeItem('cart');}</script>";  //Remove cart
                    //Get array of cart items
                    $array = getCartItems();
                    echo "<script>localStorage.setItem('cart', '$array');</script>";
                } else {
                    echo '<section class="register-section">
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

                function debug_to_console($data) {
                    $output = $data;
                    if (is_array($output)) {
                        $output = implode(',', $output);
                    }

                    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
                }

//Function to get cart item
                function getCartItems() {
                    //Get cart item
                    $config = parse_ini_file('../private/db-config.ini');
                    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
                    if ($conn->connect_error) {
                        $errorMsg = "Connection failed: " . $conn->connect_error;
                        $success = false;
                    } else {
                        //$userstuff = $_SESSION['userID'];
                        $stmt = $conn->prepare("SELECT Cart.cartQuantity, Product.productCompany, Product.productID, Product.productImagePath, Product.productName, Product.productPrice FROM Cart INNER JOIN Product ON Cart.Product_productID = Product.productID WHERE Cart.User_userID=?");

                        $stmt->bind_param("i", $_SESSION['userID']);
                        $stmt->execute();
                        $stmt->bind_result($cartQuantity, $productCompany, $productID, $productImagePath, $productName, $productPrice);

                        $data = array();
                        while ($stmt->fetch()) {
                            $data[] = array(
                                'amount' => $cartQuantity,
                                'productCompany' => $productCompany,
                                'productID' => $productID,
                                'productImagePath' => $productImagePath,
                                'productName' => $productName,
                                'productPrice' => $productPrice
                            );
                        }

                        $stmt->close();
                        $conn->close();
                        return json_encode($data);
                    }
                }
                ?>
            </section>
        </main>
        <script type="module" src="js/toggleSidebar.js"></script>
        <script type="module" src="js/cart/setupCart.js"></script>
        <script type="module" src="js/cart/toggleCart.js"></script> 
    </body>
</html>