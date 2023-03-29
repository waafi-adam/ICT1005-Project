       <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile | Comfy</title>
    <!-- font-awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
    />

    <!-- styles css -->
    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body>
      <style>
            .orderHistory{
                position: relative;
                z-index: 2;
                
                width: 100%;
                height: 500px;
                margin: 0;
                padding: 0;
                outline: 0;
            }
            
            .orderHistory thead tr {
                background-color: #009879;
                color: #ffffff;
                text-align: left;
                
            }
            tr:nth-child(odd){
                background-color: #eeeeee;
            }
            th, td {
                padding: 12px 15px;
            }
        </style>
    <!--     navbar -->
    <?php include "includes/nav-black.inc.php"; ?>
    <!-- hero -->
    <section class="page-hero">
      <div class="section-center">
        <h3 class="page-hero-title">
          home / Order Detail
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
          <form>
               <button type="submit" class="cart-checkout btn" formaction="payment_addr.php">Checkout</button>
          </form>
        </footer>
      </aside>
    </div>
    
    <div class="dashboard-center section-center">
        <?php
        // Get user order detail 
        $order_id = $_GET['DetailID'];
        
        // Connect to database
        $config = parse_ini_file('../private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
        // If database connect fail
        if ($conn->connect_error) {
            echo "error";
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else {
            // Retrieve from database
            $sql = "SELECT * FROM shoeStore.orderDetail WHERE DetailID = $order_id";
            $result = $conn->query($sql);

            $row = mysqli_fetch_assoc($result);
            // Display order name, quantity and price for specified item 
            echo '<p><strong>Order Name: </strong>' . $row['orderName'] . "</p>";
            echo '<p><strong>Quantity: </strong>' . $row['orderQuantity'] . "</p>";
            echo '<p><strong>Price: </strong>' . $row['orderPrice'] . "</p>";
            echo '<p><strong>Review Left: </strong>' . $row['Review']. "</p>";
            $conn->close();
        }
        ?>
        <!-- Review section -->
        <h2>Leave a Review</h2>
        <form method="post" action="save_Review.php">
            <input type="hidden" name="DetailID" value="<?php echo $row['DetailID']; ?>">
            <label for="review_text">Review:</label>
            <textarea id="review_text" name="review_text"></textarea>
            <button type="submit">Submit Review</button>
        </form>

    </div>
    <!-- page loading -->
    <script type="module" src="js/pages/orderhistory.js"></script>
  </body>
</html>