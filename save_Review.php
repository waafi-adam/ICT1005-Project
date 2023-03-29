<?php

// Retrieve the review text and order ID from the form
$review_text = $_POST['review_text'];
$order_id = $_POST['DetailID'];

// Connect to database
$config = parse_ini_file('../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
// If database connect fail
if ($conn->connect_error) {
    echo "error";
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
} else {
    // Update reviews in database
    $sql = "UPDATE shoeStore.orderDetail SET Review='$review_text' WHERE DetailID= '$order_id'";
    $result = $conn->query($sql);
}

// Redirect back to the orderHistory.php page
header('Location: orderHistory.php');
exit;
?>