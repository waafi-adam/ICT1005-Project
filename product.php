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
    <main>
        <!-- hero -->
        <section class="page-hero">
          <div class="section-center">
            <h3 class="page-hero-title">
              home / single product
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
        <!-- RATING REVIEWS START -->
        <section class="section review-rating">
          <div class="section-center review-rating-center">
            <div class="title">
              <h2><spanR>/</spanR>rating & reviews</h2>
            </div>
            <!-- ratings start -->
            <div class="container ratings">
              <div class="chart">
                <div class="rate-box">
                  <span class="value">5</span>
                  <div class="progress-bar">
                    <span class="progress"></span>
                  </div>
                  <span class="count">0</span>
                </div>
                <div class="rate-box">
                  <span class="value">4</span>
                  <div class="progress-bar"><span class="progress"></span></div>
                  <span class="count">0</span>
                </div>
                <div class="rate-box">
                  <span class="value">3</span>
                  <div class="progress-bar"><span class="progress"></span></div>
                  <span class="count">0</span>
                </div>
                <div class="rate-box">
                  <span class="value">2</span>
                  <div class="progress-bar"><span class="progress"></span></div>
                  <span class="count">0</span>
                </div>
                <div class="rate-box">
                  <span class="value">1</span>
                  <div class="progress-bar"><span class="progress"></span></div>
                  <span class="count">0</span>
                </div>
              </div>
              <div class="global">
                <span class="global-value">0.0</span>
                <div class="rating-icons">
                  <span class="one"
                    ><i class="fas fa-star"></i><i class="fas fa-star"></i
                    ><i class="fas fa-star"></i><i class="fas fa-star"></i
                    ><i class="fas fa-star"></i
                  ></span>
                  <span class="two"
                    ><i class="fas fa-star"></i><i class="fas fa-star"></i
                    ><i class="fas fa-star"></i><i class="fas fa-star"></i
                    ><i class="fas fa-star"></i
                  ></span>
                </div>
                <span class="total-reviews">0</span>
              </div>
            </div>
            <!-- ratings end -->
            <!-- reviews start -->
            <div id="reviews">
              <!--reviews-box-container------>
              <div class="testimonial-box-container"></div>
            </div>

            <!-- reviews end -->
          </div>
        </section>
        <!-- RATING REVIEWS END -->
        <!-- page loading -->
        <div class="page-loading">
          <h2>Loading...</h2>
        </div>

        <script type="module" src="/js/pages/product.js"></script>
        
    </main>
  </body>
</html>
