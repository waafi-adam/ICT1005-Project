<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

$msg = "";
$success = true;
$fields = array("name"=>"name", "price"=>"price", "brand"=>"brand", "description"=>"description");
$dbfields = [];

$thumbnail = null;
// Handle thumbnail upload
if ($_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
  $thumbnail = file_get_contents($_FILES['thumbnail']['tmp_name']);
  // Get the file extension and check if it's a valid image file
  $thumbnail_info = pathinfo($_FILES['thumbnail']['name']);
  $thumbnail_extension = strtolower($thumbnail_info['extension']);
  if (!in_array($thumbnail_extension, array('jpg', 'jpeg', 'png'))) {
    die('Invalid thumbnail file type.');
  }
}

//makeConnection();
$config = parse_ini_file('../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

if ($conn->connect_error) {
    $msg = "Connection failed: " . $conn->connect_error;
    die(json_encode(array('msg' => $msg))); 
    $success = false;
}

if($success){
    foreach($_POST as $key=>$value){
        if ($key == "name" || $key == "price"){
            if (empty($value)){
                $msg = "name and price is required";
                $success = false;
                 die(json_encode(array('msg' => $msg)));                
            }
            if ($key == "name"){
                // Prepare the statement:
                $stmt = $conn->prepare("SELECT * FROM Product WHERE productName=?");
                
                // Bind & execute the query statement:
                $stmt->bind_param("s", $value);
                $stmt->execute();
                $result = $stmt->get_result();
                
                
                if ($result->num_rows > 0){
                    $msg = "name already existed";
                    $success = false;
                    die(json_encode(array('msg' => $msg))); 
                }
                $stmt->close();
            } 
        } elseif (empty($value)){
            $msg = "successfull but best to have all contents";
            $test .= "suggestion \n";
        }
        $test .= "sanitizing \n";
        $value = sanitize_input($value);
        $dbfields[$key] = $value;
    }
}



if ($success){
    
    // Prepare the statement: 
    $stmt = $conn->prepare("INSERT INTO Product (productName, productPrice, productCompany, productImage, productDescription) VALUES (?, ?, ?, ?, ?)");
    
    // Changing price to type double
    if ($dbfields['price']){
        $dbfields['price'] = (double) $dbfields['price'];
    }
    
    // Bind & execute the query statement: 
    $stmt->bind_param("sdsbs", $dbfields['name'], $dbfields['price'], $dbfields['brand'], $thumbnail, $ $dbfields['description']);
    
    // Execute statement and do error checking
//     $stmt->execute();
    if (!$stmt->execute()) {
        $msg = "Execute failed: (" . json_encode($stmt->errno) . ") " . json_encode($stmt->error). json_encode($thumbnail);
        $success = false;
        die(json_encode(array('msg' => $msg)));

    }else {
        $msg = "successfull";
        echo json_encode(array('msg' => $msg));
    }
    $stmt->close();
}
$conn->close();

function sanitize_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
