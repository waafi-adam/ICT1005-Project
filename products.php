       <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | Comfy</title>
    <!-- font-awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    >

    <!-- styles css -->
    <link rel="stylesheet" href="css/styles.css" >
  </head>
  <body>
      
    <!--     navbar -->
    <?php include "includes/nav-black.inc.php"; ?>
    <main>
    
        <!-- hero -->
        <section class="page-hero">
          <div class="section-center">
            <h3 class="page-hero-title">
              home / Products
            </h3>
          </div>
        </section>
        <!-- sidebar -->
        <?php include "includes/sidebar.php"; ?>
        <!-- cart -->
        <div class="cart-overlay">
          <aside class="cart" aria-label="Shopping Cart">
            <button class="cart-close" aria-label="Close Cart">
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
        <!-- products -->
        <section class="products">
          <!-- filters -->
          <div class="filters">
            <div class="filters-container">
              <!-- search -->
              <form class="input-form">
                <input type="text" class="search-input" placeholder="search...">
              </form>
              <!-- categories -->
              <h4>Company</h4>
              <article class="companies">
                  <h2>Shoe Companies</h2>
                <button class="company-btn" aria-label="Shoe Companies">all</button>
              </article>
              <!-- price -->
              <h4>price</h4>
              <form class="price-form">
                <span id="price-range-label">Price range:</span>
                <input type="range" class="price-filter" aria-labelledby="price-range-label">
              </form>
              <p class="price-value">max value: $10</p>
            </div>
          </div>
          <!-- products -->
          <div class="products-container"></div>
        </section>
        <!-- page loading -->
        <div class="page-loading">
          <h2>Loading...</h2>
        </div>
        <script type="module" src="js/pages/products.js"></script>
    </main>
  </body>
</html>