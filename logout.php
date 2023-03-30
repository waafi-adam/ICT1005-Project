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
        <?php include "includes/checkSession.php";

        $username = $_SESSION['username'];
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
                        <ul class="nav-links-right">
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
        <?php $session->stop(); ?>
        <?php
        global $username;
        if (empty($username)) {
            echo'<section class="register-section">
                    <div class="register">
                      <form class="account-form">
                        <h3>You are not logged in!</h3>
                        <button class="btn"><a href="login.php">Login</a></button>
                        <button class="btn"><a href="register.php">Register</a></button>
                      </form>
                    </div>
                </section>';
        } else {
            echo'<section class="register-section">
                    <div class="register">
                      <form class="account-form">
                        <h3>Goodbye, Come Again ' . $username . '!</h3>
                        <button class="btn"><a href="index.php">Back Home</a></button>
                      </form>
                    </div>
                  </section>';
            echo"<script>localStorage.removeItem('cart');</script>";
        }
        ?>
        <script type="module" src="js/toggleSidebar.js"></script>
        <script type="module" src="js/cart/setupCart.js"></script>
        <script type="module" src="js/cart/toggleCart.js"></script> 
    </body>
</html>