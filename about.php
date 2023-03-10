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
    
    <!-- hero -->
    <section class="page-hero">
      <div class="section-center">
        <h3 class="page-hero-title">
          home / about
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
    <!-- about -->
    <section class="section sectoin-center about-page">
      <div class="title">
        <h2>
          <span>/</span>
          our history
        </h2>
        <p class="about-text">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate est rerum nulla numquam. Earum necessitatibus delectus dolore quo laboriosam! Voluptas, praesentium! Cupiditate quos maxime, qui sint accusantium modi quas velit quis suscipit laudantium veniam tempora molestias. Officia voluptas ad rem laboriosam nemo tempora quisquam optio architecto, earum iusto officiis maiores velit! Repudiandae voluptate beatae consequuntur. Soluta numquam, sint quos quo id nulla aspernatur autem adipisci, nostrum, doloremque dolor nobis animi repellat repudiandae ea ut. Possimus odio quibusdam sint esse illum.
        </p>
      </div>
    </section>
    <script type="module" src="js/pages/about.js"></script>
  </body>
</html>