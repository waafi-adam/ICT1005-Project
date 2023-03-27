<?php
// Connect to the database
$config = parse_ini_file('../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check for errors
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

// Prepare the query statement
$stmt = $conn->prepare("SELECT productID, productName, productPrice, productCompany, productImage, productDescription, productImagePath FROM Product");

// Execute the query statement and bind the result columns to variables
$stmt->execute();
$stmt->bind_result($productID, $productName, $productPrice, $productCompany, $productImage, $productDescription, $productImagePath);

// Fetch the data and store it in an array
$data = array();
while ($stmt->fetch()) {
  $data[] = array(
    'productID' => $productID,
    'productName' => $productName,
    'productPrice' => $productPrice,
    'productCompany' => $productCompany,
//    'productImage' => $productImage,
    'productDescription' => $productDescription,
    'productImagePath' => $productImagePath
  );
}

// Close the statement and database connection
$stmt->close();
$conn->close();

// Return the data as a JSON-encoded response
header('Content-Type: application/json');
echo json_encode($data);

