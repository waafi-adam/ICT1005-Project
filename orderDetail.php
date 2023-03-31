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
    <?php include "includes/sidebar.php"; ?>
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
               <button type="submit" class="cart-checkout btn" formaction="payment_test.php">Checkout</button>
          </form>
        </footer>
      </aside>
    </div>
    
    <div class="dashboard-center section-center">
        <?php
        // Get user order detail 
        $order_id = $_GET['DetailID'];
        $username = $_SESSION['username'];
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
            //$sql = "SELECT * FROM shoeStore.orderDetail WHERE DetailID = $order_id";
            $sql = "SELECT  * FROM shoeStore.orderDetail INNER JOIN shoeStore.Product ON 
                shoeStore.orderDetail.orderProductID = shoeStore.Product.productID WHERE DetailID = $order_id";
            $result = $conn->query($sql);

            $row = mysqli_fetch_assoc($result);
            $imageLink = $row['productImagePath'];
            // Display order name, quantity and price for specified item 
            echo '<p><strong>Order Name: </strong>' . $row['orderName'] . "</p>";
            echo '<p><strong>Quantity: </strong>' . $row['orderQuantity'] . "</p>";
            echo '<p><strong>Price: </strong>' . $row['orderPrice'] . "</p>";
            echo "<img src='$imageLink' alt='Image' width='300' height='300'>";
            $conn->close();
        }
        ?>
        <!-- Review section -->
        <h2>Leave a Review</h2>
        <form method="post" action="save_Review.php">
            <input type="hidden" name="orderProductID" value="<?php echo $row['orderProductID']; ?>">
            <input type="hidden" name="username" value="<?php echo $username ?>">

            <label for="review_title">Review Title:</label>
            <textarea id="review_title" name="review_title"></textarea>
            <br>
            <label for="review_text">Review:</label>
            <textarea id="review_text" name="review_text"></textarea>
            <br>
            <select id="review_rating" name="review_rating">
                 <option value="1">1 star</option>
                 <option value="2">2 stars</option>
                 <option value="3">3 stars</option>
                 <option value="4">4 stars</option>
                 <option value="5">5 stars</option>
            </select>
            <button type="submit">Submit Review</button>
        </form>

    </div>
    <!-- page loading -->
    <script type="module" src="js/pages/orderhistory.js"></script>
  </body>
</html>