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
          home / Profile
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
               <button type="submit" class="cart-checkout btn" formaction="payment_addr.php">Checkout</button>
          </form>
        </footer>
      </aside>
    </div>
     <div class="dashboard-center section-center">
            <!-- get user's username and email -->
                <div class="dashboard-content">
                 <?php
                  $username = $_SESSION['username'];
                  $email = $_SESSION['useremail'];
                    echo "<p><strong>Username: </strong> $username</p>";
                    echo "<p><strong>Email: </strong> $email</p>";
                  ?>
                    <!-- display all order placed by user-->
                                    
            
        
                    <h3><b> Order History: </b></h3>
                    <div class="orderHistory">
                         <table class="orderHistory" >
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Order Name</th>
                                    <th>Order Quantity</th>
                                    <th>Price</th>
                                    <th>View Order</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            // get session user id
                            $userID = $_SESSION['userID'];
                            
                            // connect to database
                            $config = parse_ini_file('../private/db-config.ini');
                            $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
                            // if database connect fail 
                            if ($conn->connect_error) {
                                $errorMsg = "Connection failed: " . $conn->connect_error;
                                $success = false;
                            } else {
                                // retrieve from database
                                $sql = "SELECT * FROM shoeStore.orderDetail WHERE User_userID = $userID";
                                $result = $conn->query($sql);
                                 // display result in table format
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td>' . $row['DetailID'] . '</td>';
                                    echo '<td>' . $row['orderName']. '</td>';
                                    echo '<td>' . $row['orderQuantity'] . '</td>';
                                    echo '<td>' . $row['orderPrice'] . '</td>';
                                    echo '<td><a href="orderDetail.php?DetailID='.$row['DetailID']. '">View</a></td>';
                                    echo '</tr>';
                                }
                                $conn->close();
                            }
                            ?>
                            </tbody>
                         </table>

                    </div>
              </div>          
</div>
    <!-- page loading -->
    <script type="module" src="js/pages/orderhistory.js"></script>
  </body>
</html>