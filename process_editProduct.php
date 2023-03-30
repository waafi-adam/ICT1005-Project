<?php

$msg = "";
$success = true;
$fields = array("name" => "name", "price" => "price", "brand" => "brand", "description" => "description", "id" => "id");
$dbfields = [];

$thumbnail = null;
$thumbnail_path = $_POST['currImgPath']; // Set the thumbnail path to the current image path by default

// Handle thumbnail upload
if ($_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
    $thumbnail = file_get_contents($_FILES['thumbnail']['tmp_name']);
    // Get the file extension and check if it's a valid image file
    $thumbnail_info = pathinfo($_FILES['thumbnail']['name']);
    $thumbnail_extension = strtolower($thumbnail_info['extension']);
    if (!in_array($thumbnail_extension, array('jpg', 'jpeg', 'png'))) {
        $msg = "Invalid thumbnail file type.";
        die(json_encode(array('msg' => $msg, 'type' => "danger")));
    }

    // Move the uploaded thumbnail image file to a directory on the server
    $thumbnail_filename = uniqid() . '.' . $thumbnail_extension;
    $thumbnail_path = 'images/' . $thumbnail_filename;
    move_uploaded_file($_FILES['thumbnail']['tmp_name'], $thumbnail_path);
} 

// Make sure the thumbnail path is set to a non-empty value
if (empty($thumbnail_path)) {
    $msg = "Thumbnail path is required.";
    die(json_encode(array('msg' => $msg, 'type' => "danger")));
}


//makeConnection();
$config = parse_ini_file('../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

if ($conn->connect_error) {
    $msg = "Connection failed: " . $conn->connect_error;
    die(json_encode(array('msg' => $msg, 'type' => "danger")));
    $success = false;
}

if ($success) {
    foreach ($_POST as $key => $value) {
        if ($key == "name" || $key == "price") {
            if (empty($value)) {
                $msg = "name and price is required";
                $success = false;
                die(json_encode(array('msg' => $msg, 'type' => "danger")));
            }
            if ($key == "name") {
                // Prepare the statement:
                $stmt = $conn->prepare("SELECT * FROM Product WHERE productName=? AND productId!=?");

                // Bind & execute the query statement:
                $stmt->bind_param("si", $value, $_POST['id']);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $msg = "name already existed";
                    $success = false;
                    die(json_encode(array('msg' => $msg, 'type' => "danger")));
                }
                $stmt->close();
            }
        } elseif (empty($value)) {
            $msg = "successfull but best to have all contents";
            $test .= "suggestion \n";
        }
        $test .= "sanitizing \n";
        $value = sanitize_input($value);
        $dbfields[$key] = $value;
    }
}

if ($success) {

    // Prepare the statement: 
    $stmt = $conn->prepare("UPDATE Product SET productName=?, productPrice=?, productCompany=?, productDescription=?, productImagePath=? WHERE productID=?");
    // Changing price to type double
    if ($dbfields['price']) {
        $dbfields['price'] = (double) $dbfields['price'];
    }

    // Bind & execute the query statement: 
    $stmt->bind_param("sdsssi", $dbfields['name'], $dbfields['price'], $dbfields['brand'], $dbfields['description'], $thumbnail_path, $dbfields['id']);

// Execute statement and do error checking
// $stmt->execute();
    if (!$stmt->execute()) {
        $msg = "Execute failed: (" . json_encode($stmt->errno) . ") " . json_encode($stmt->error) . json_encode($thumbnail);
        $success = false;
        die(json_encode(array('msg' => $msg, 'type' => "danger")));
    } else {
        $msg = "successfully updated, refreshing pg";
        echo json_encode(array('msg' => $msg, 'type' => "success"));
    }
    $stmt->close();
}
$conn->close();

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
