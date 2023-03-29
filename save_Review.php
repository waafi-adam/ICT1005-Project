<?php

// Retrieve the review text and order ID from the form
$review_text = $_POST['review_text'];
$order_id = $_POST['DetailID'];
$review_rating = $_POST['review_rating'];
$product_id = $_POST['orderProductID'];
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
    // Update reviews in database
    $sql = "INSERT INTO shoeStore.Review (productID, reviewDescription, reviewRating) VALUES ('$product_id' , '$review_text','$review_rating')";
    $result = $conn->query($sql);
}

// Redirect back to the orderHistory.php page
header('Location: orderHistory.php');
exit;
?>