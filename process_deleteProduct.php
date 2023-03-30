<?php

$ID = $_POST["productID"];

$config = parse_ini_file('../private/db-config.ini');

$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check connection
if ($conn->connect_error) {
    die(json_encode(array('msg' => "Connection fail test", 'type' => "danger")));
} else {
    // Delete the product with the given ID from the database
    $stmt = $conn->prepare("DELETE FROM Product WHERE productID = ?");
    $stmt->bind_param("i", $ID);
    if ($stmt->execute()) {
        // Return a success message
        echo json_encode(array('msg' => "Product $ID deleted, refreshing page.", 'type' => "success"));
    } else {
        // Return an error message
        die(json_encode(array('msg' => "Error deleting product $ID: " . $conn->error, 'type' => "danger")));
    }
    
    $stmt->close();
    $conn->close();
}
