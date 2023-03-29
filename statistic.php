<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Products | Comfy</title>
        <!-- font-awesome -->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
            />

        <!-- styles css -->
        <link rel="stylesheet" href="css/styles.css" />
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body>
        <style>
            .container {
                display: flex;
                flex-basis: 50%;
            }
        </style>
        <!--     navbar -->
        <?php include "includes/nav-black.inc.php"; ?>

        <!-- hero -->
        <section class="page-hero">
            <div class="section-center">
                <h3 class="page-hero-title">
                    Items Statistics
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
        <h2> testing </h2>
        <?php
        $config = parse_ini_file('../private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
        // If database connect fail
        if ($conn->connect_error) {
            echo "error";
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else {
            $result = $conn->query("SELECT orderName, Count(orderQuantity) as amount FROM shoeStore.orderDetail GROUP BY orderName;");
            
            foreach($result as $data)
            {
            $product[] = $data['orderName'];
            $amount[] = $data['amount'];
            }
        }
            ?>
<div class="dashboard-center section-center">
    <div class="container" style="width:30%;height:50%">
   <canvas id="myChart" width="5" height="5"></canvas> 
    <canvas id="pieChart" width="5" height="5"></canvas>
</div>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($product)?>,
        datasets: [{
            label: 'amount',
            data: <?php echo json_encode($amount)?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
 <?php
        $config = parse_ini_file('../private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
        // If database connect fail
        if ($conn->connect_error) {
            echo "error";
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } else {
            $result = $conn->query("SELECT reviewRating, count(reviewRating) as ratingcount FROM shoeStore.Review GROUP BY reviewRating;");
            
            foreach($result as $data)
            {
            $rating[] = $data['reviewRating'];
            $ratingCount[] = $data['ratingcount'];
            }
        }
            ?>

   
 
<script>
    var ctx = document.getElementById('pieChart').getContext('2d');
var pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
       labels: <?php echo json_encode($rating)?>,
            datasets: [{
                    label: 'rating',
                    data:<?php echo json_encode($ratingCount)?>,
                    backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 0, 0, 1)'
                    ]
        }]
        }
        });
</script>
</div>
    <!--<script type="module" src="js/pages/orderHistory.js"></script>-->
    </body>
</html>