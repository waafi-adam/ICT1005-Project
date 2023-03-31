<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Stripe JavaScript library -->
    <script src="https://js.stripe.com/v2/"></script>
    <?php include "includes/head.inc.php" ?>
    <title>Home | Comfy</title>
  </head>
  <body>
      
     <?php include "includes/nav-white.inc.php"; ?> 
      
    
    <main>
        <!-- hero -->
        <section class="hero">
          <div class="hero-container">
            <h1 class="text-slanted">
              All Your Comfort Shoes
            </h1>
            <h2>embrace your choices - we do</h2>
            <a href="/products.php" class="hero-btn">Shop Now</a>
          </div>
        </section>
        <!-- sidebar -->
        <?php include "includes/sidebar.php"; ?>
        <!-- cart -->
        <div class="cart-overlay">
          <aside class="cart" aria-label="Shopping Cart">
            <button class="cart-close" aria-label="Close Car">
              <i class="fas fa-times"></i>
            </button>
            <header>
              <h3 class="text-slanted">your bag</h3>
            </header>
            <!-- cart items -->
            <div class="cart-items">


            </div>
            <!-- footer -->
            <footer>
              <h3 class="cart-total text-slanted">
                total: $12.00
              </h3>
                <form>
                    <button type="submit" class="cart-checkout btn" formaction="payment_test.php">Checkout</button>
                </form>
            </footer>
          </aside>
        </div>
        <!--numbers section-->
        <section class="section numbers">
            <div class="title">
              <h2><span>/</span> Our Numbers</h2>
            </div>
            <div class="numbers-center section-center">
                <!-- single number -->
                <article>
                  <span class="number" data-value="500">0</span>
                  <h3>Shoes Sold</h3>
                </article>
                <!-- end of single number -->
                <!-- single number -->
                <article>
                  <span class="number" data-value="17140">0</span>
                  <h3>Brands Available</h3>
                </article>
                <!-- end of single number -->
                <!-- single number -->
                <article>
                  <span class="number" data-value="1500">0</span>
                  <h3>Shoes Available</h3>
                </article>
                <!-- end of single number -->
            </div>
        </section>
        <!--numbers section end-->
        <!-- featured products -->
        <section class="section featured">
          <div class="title">
            <h2><span>/</span> featured</h2>
          </div>
          <div class="featured-center section-center">
            <h2 class="section-loading">
              loading...
            </h2>
          </div>
          <a href="products.php" class="btn">
            all products
          </a>
        </section>
        <script type="module" src="index.js"></script>
    </main>
  </body>
</html>