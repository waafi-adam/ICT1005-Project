<?php
include "includes/checkSession.php";
$loggedin = false;
$username = $_SESSION['username'];
$adminMode=$_SESSION['adminMode'];
if (empty($username)) {
    $loggedin = false;
} else {
    $loggedin = true;
}
?>
<!--     navbar -->
<nav class="navbar page">
    <div class="nav-center">
        <!-- links -->
        <div>
            <button class="toggle-nav" aria-label="Toggle Menu">
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
        global $loggedin,$username,$adminMode;
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
        }
        else if ($adminMode==1){
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
        }
        else{
             echo '<ul class="nav-links">
                <li>
                    <a href="logout.php" class="nav-link">
                        Logout
                    </a>
                </li>
                <li>
                    <a href="orderHistory.php" class="nav-link">
                        '.$username.'
                    </a>
                </li>
            </ul>';
        }
        ?>
                
        </div>
        <!-- logo -->
        <img src="./images/logo-black.svg" class="nav-logo" alt="logo">
        <!-- cart icon -->
        <div class="toggle-container">
            <button class="toggle-cart" aria-label="View Shopping Cart">
                <i class="fas fa-shopping-cart"></i>
            </button>
            <span class="cart-item-count">1</span>
        </div>
    </div>
</nav>
