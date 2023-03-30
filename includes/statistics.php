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
<div class="statistic">
    <div class="container chart-container">
      <canvas id="myChart" width="3" height="3"></canvas>
      <canvas id="pieChart" width="3" height="3"></canvas>
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