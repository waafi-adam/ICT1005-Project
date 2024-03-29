
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- font-awesome -->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
            >

        <!-- styles css -->
        <link rel="stylesheet" href="css/styles.css">
        <title>Home | Comfy</title>
    </head>
    <body>
        <?php include "includes/nav-white.inc.php"; ?> 
        <?php include "includes/sidebar.php"; ?>
        <main>
            <div class="cart-overlay">
                <aside class="cart" aria-label="Shopping Cart">
                    <button class="cart-close" aria-label="Close Cart">
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
            $username = $_SESSION['username'];
            $userID = $_SESSION['userID'];
            if (empty($username)) {
                echo'<section class="register-section">
                        <div class="register">
                          <form
                            id="form"
                            class="account-form"
                            action="process_register.php"
                            method="post"
                          >
                            <img    
                              src="images/logo-black.svg"
                              alt="logo-black"
                            >
                            <h3>Register</h3>
                            <div class="form-group">
                              <label for="username">User Name:</label>
                              <input
                                type="text"
                                id="username"
                                name="username"
                                class="form-control"
                                required
                                maxlength="45"
                                placeholder="Enter user name"
                              >
                            </div>
                            <div class="form-group">
                              <label for="email">Email:</label>
                              <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control"
                                required
                                placeholder="Enter email"
                              >
                            </div>
                            <div class="form-group">
                              <label for="pwd">Password:</label>
                              <input
                                id="pwd"
                                name="pwd"
                                class="form-control"
                                type="password"
                                required
                                placeholder="Enter password"
                              >
                            </div>
                            <div class="form-group">
                              <label for="pwd_confirm">Confirm Password:</label>
                              <input
                                id="pwd_confirm"
                                name="pwd_confirm"
                                class="form-control"
                                required
                                type="password"
                                placeholder="Confirm password"
                              >
                            </div>
                            <div class="form-group">
                              <div class="form-check">
                                <label>
                                  <input type="checkbox" name="agree" required>
                                  I agree to the terms and conditions.
                                </label>
                              </div>
                            </div>
                            <button class="btn btn-primary" id="submit" type="submit">
                              Submit
                            </button>
                            <p>Already a member? <a href="login.php" class="accessibility-link">Login</a></p>
                          </form>
                        </div>
                      </section>';
            } else {
                echo' <section class="register-section">
                        <div class="register">
                          <form class="account-form">
                            <h3>You are already logged in!</h3>
                            <button class="btn" type="button" onclick="location.href=\'index.php\';">Back Home</button>
                            <button class="btn" type="button" onclick="location.href=\'logout.php\';">Log out</button>
                          </form>
                        </div>
                      </section>';
            }
            ?>
            <script type="module" src="js/toggleSidebar.js"></script>
            <script type="module" src="js/cart/setupCart.js"></script>
            <script type="module" src="js/cart/toggleCart.js"></script>
        </main>
    </body>
</html>
