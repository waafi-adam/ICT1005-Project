<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Single Product</title>
    <!-- font-awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    />

    <!-- styles css -->
    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body>
    <!--     navbar -->
    <?php include "includes/nav-black.inc.php"; ?>
    <!-- hero -->
    <section class="page-hero">
      <div class="section-center">
        <h3 class="page-hero-title">
          home / single product
        </h3>
      </div>
    </section>
    <!-- sidebar -->
    <div class="sidebar-overlay">
      <aside class="sidebar">
        <!-- close -->
        <button class="sidebar-close">
          <i class="fas fa-times"></i>
        </button>
        <!-- links -->
        <ul class="sidebar-links">
          <li>
            <a href="index.html" class="sidebar-link">
              <i class="fas fa-home fa-fw"></i>
              home
            </a>
          </li>
          <li>
            <a href="products.html" class="sidebar-link">
              <i class="fas fa-couch fa-fw"></i>
              products
            </a>
          </li>
          <li>
            <a href="about.html" class="sidebar-link">
              <i class="fas fa-book fa-fw"></i>
              about
            </a>
          </li>
        </ul>
      </aside>
    </div>
    <!-- cart -->
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
    <!-- product info -->
    <section class="single-product section">
      <div class="section-center single-product-center">
        <img src="" alt="" class="single-product-img img">
        <article class="single-product-info">
          <div>
            <h2 class="single-product-title"></h2>
            <p class="single-product-company text-slanted"></p>
            <span class="single-product-price"></span>
            <!--
            <div class="single-product-colors">
              <span class="product-color"></span>
              <span class="product-color product-color-red"></span>
            </div>
            -->
            <p class="single-product-desc"></p>
            <button class="addToCartBtn btn" data-id="">add to cart</button>
          </div>
        </article>
      </div>
    </section>
    <div class="review">
        <h4 class="review-tile">Reviews</h4>
    </div>
    <!-- page loading -->
    <div class="page-loading">
      <h2>Loading...</h2>
    </div>
    
    <script type="module" src="/js/pages/product.js"></script>
  </body>
</html>
