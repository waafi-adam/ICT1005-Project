<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About | Comfy</title>
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
              home / about
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
        <!-- about -->
        <section class="section sectoin-center about-page">
          <div class="title">
            <h2>
              Comfy
            </h2>
            <p class="about-text">
            Welcome to our shoestore! We are passionate about shoes and believe that the right pair can make all the difference. Our mission is to help you find the perfect pair of shoes that not only look great but also fit comfortably and suit your lifestyle.
            <br>
            At our shoestore, we offer a wide variety of shoes for men, women, and children. From casual to dressy, athletic to outdoor, we have something for everyone. We carry top brands known for their quality and durability, so you can trust that your shoes will last for years to come.
            </p>


          </div>



          <div>
          <h2 style="text-align: center; margin-top: 30px">
                Our Team
          </h2>
          <div class="about-organization">
            <div class="individual-organization">
              <h5 style="font-weight: bold;">Director</h5>
              <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Elon_Musk_Royal_Society_%28crop2%29.jpg/1200px-Elon_Musk_Royal_Society_%28crop2%29.jpg">
              <p>John Smith</p>
              <p>John is responsible for overseeing the day-to-day operations of our shoe company.</p>
            </div>
            <div class="individual-organization">
              <h5 style="font-weight: bold;">Sales Manager</h5>
              <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Elon_Musk_Royal_Society_%28crop2%29.jpg/1200px-Elon_Musk_Royal_Society_%28crop2%29.jpg">
              <p>John Doe</p>
              <p>John is responsible for overseeing the day-to-day operations of our shoe company.</p>
              <p>
            </div>
            <div class="individual-organization">
              <h5 style="font-weight: bold;">Technical Manager</h5>
              <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Elon_Musk_Royal_Society_%28crop2%29.jpg/1200px-Elon_Musk_Royal_Society_%28crop2%29.jpg">
              <p>John James</p>
              <p>John is responsible for overseeing the day-to-day operations of our shoe company.</p>
            </div>
          </div>
          </div>



          <div>




          </div>
        </section>
        <script type="module" src="js/pages/about.js"></script>
    </main>
  </body>
</html>