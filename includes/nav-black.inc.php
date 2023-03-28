<?php
include "includes/checkSession.php";
$loggedin=false;
$username=$_SESSION['username'];
if(empty($username)){
    $loggedin=false;
}
else{
    $loggedin=true;
}
?>
<!--     navbar -->
    <nav class="navbar page">
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
        </div>
        <!-- logo -->
        <img src="./images/logo-black.svg" class="nav-logo" alt="logo">
         <?php
        global $loggedin;
        if (!$loggedin) {
            echo '<ul class="nav-register">
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
        else{
             echo '<ul class="nav-register">
                <li>
                    <a href="logout.php" class="nav-link">
                        Logout
                    </a>
                </li>
            </ul>';
        }
        ?>
        <!-- cart icon -->
        <div class="toggle-container">
          <button class="toggle-cart">
            <i class="fas fa-shopping-cart"></i>
          </button>
          <span class="cart-item-count">1</span>
        </div>
      </div>
    </nav>