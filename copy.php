<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */


$thumbnail = null;
if (isset($_POST['submit'])) {
  // Handle thumbnail upload
  if ($_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
    $thumbnail = file_get_contents($_FILES['thumbnail']['tmp_name']);
    // Get the file extension and check if it's a valid image file
    $thumbnail_info = pathinfo($_FILES['thumbnail']['name']);
    $thumbnail_extension = strtolower($thumbnail_info['extension']);
    if (!in_array($thumbnail_extension, array('jpg', 'jpeg', 'png'))) {
      die('Invalid thumbnail file type.');
    }
    // Open a connection to the database
    $conn = mysqli_connect('localhost', 'username', 'password', 'database');
    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, "INSERT INTO images (thumbnail) VALUES (?)");
    // Bind the thumbnail to the statement
    mysqli_stmt_bind_param($stmt, 'b', $thumbnail);
    // Execute the statement
    mysqli_stmt_execute($stmt);
    // Close the connection to the database
    mysqli_close($conn);
  }
}

$alertMsg = "";
$success = true;
$fields = array("name"=>"name", "price"=>"price", "brand"=>"brand", "description"=>"description");
$dbfields = [];

$test = "";
$test .= "start \n";

//makeConnection();
$config = parse_ini_file('../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
$test .= "connecting \n";
$test .= json_encode($conn) . " \n";
if ($conn->connect_error) {
    $test .= "errorConnecting \n";
    $alertMsg = "Connection failed: " . $conn->connect_error;
//        die(json_encode(array('error' => $alertMsg))); 
//        die("error: connection");
    $success = false;
}

$test .= "connectionEnd \n";

if($success){
    $test .= "beforeLoop \n";
    $test .= json_encode($_POST) . " \n";
    
    foreach($_POST as $key=>$value){
        $test .= "looping_$key\n";
        // echo "post=" . $value;
        if ($key == "name" || $key == "price"){
            $test .= "validateNamePrice \n";
            if (empty($value)){
                $alertMsg = $fields[$key] . " is required.";
                $success = false;
                // die(json_encode(array('error' => $alertMsg)));                
            }
            $test .= $key . "\n";
            if ($key == "name"){
                $test .= "checkNameExist \n";
                // checkProductNameExist($value, $conn);
                // Prepare the statement:
                $stmt = $conn->prepare("SELECT * FROM Product WHERE productName=?");
                
                // Bind & execute the query statement:
                $stmt->bind_param("s", $value);
                $test .= json_encode($stmt) . " check\n";
                $stmt->execute();
                $result = $stmt->get_result();
                $test .= json_encode($result) . " check\n";
                
                
                if ($result->num_rows > 0){
                    $test .= "nameExistAlready\n";
                    $alertMsg = "name already existed";
                    $success = false;
                     die(json_encode($alertMsg)); 
                    // die("Error: name alread exists");
                }
                $stmt->close();
            } 
        } elseif (empty($value)){
            $alertMsg = "successfull but best to have all contents";
            $test .= "suggestion \n";
        }
        $test .= "sanitizing \n";
        $value = sanitize_input($value);
        $dbfields[$key] = $value;
    }
    $test .= "endLoop \n";
    $test .= json_encode($dbfields). " \n";
}



if ($success){
    $test .= json_encode($conn) . " storing\n";
    
    // Prepare the statement: 
    $stmt = $conn->prepare("INSERT INTO Product (productName, productPrice, productCompany, productImage, productDescription) VALUES (?, ?, ?, ?, ?)");
    
    // Changing price to type double
    if ($dbfields['price']){
        $dbfields['price'] = (double) $dbfields['price'];
        $test .= "idDouble:" . json_encode(is_double($dbfields['price'])) . " \n";
    }
    
    // Bind & execute the query statement: 
    $stmt->bind_param("sdsbs", $dbfields['name'], $dbfields['price'], $dbfields['brand'], $thumbnail, $ $dbfields['description']);
    
    foreach($dbfields as $key=>$value) {
        $test .= $value . " \n";
    }

    // Execute statement and do error checking
//     $stmt->execute();
    if (!$stmt->execute()) {
        $test .= "executeFail \n";
//        $alertMsg = "Execute failed: (" . json_encode($stmt->errno) . ") " . json_encode($stmt->error);
//        $success = false;
         die($alertMsg);   
    }else {
        $test .= "success \n";
        $alertMsg = "successfull";
        echo $alertMsg;
    }
    $test .= json_encode($stmt) . " storing\n";
    $stmt->close();
}
$conn->close();
echo json_encode($test);

//$name=$_POST['name']; $price=$_POST['price'];
//$data = array('name'=> $name, 'price' => $price);

//
//function makeConnection(){
//    $config = parse_ini_file('../../private/db-config.ini');
//    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
//    $test .= "connecting ";
////    $conn = new mysqli("localhost", "project", "password", "shoeStore");
//    $test .= json_encode($conn) . " ";
//    $test .= $config['servername'] . " ";
//    $test .= $config['username'] . " ";
//    $test .= $config['password'] . " ";
//    $test .= $config['dbname'] . " ";
////    echo json_encode($conn);
////    echo $conn;
////    $test .= $conn . " ";
//    if ($conn->connect_error) {
//        $test .= "errorConnecting ";
//        $alertMsg = "Connection failed: " . $conn->connect_error;
////        die(json_encode(array('error' => $alertMsg))); 
////        die("error: connection");
//        $success = false;
//    }
//}
//
//
//function checkProductNameExist($name, $conn){
//    // Prepare the statement:
//    $stmt = $conn->prepare("SELECT * FROM product WHERE productName=?");
//    $test .= json_encode($stmt);
//    // Bind & execute the query statement:
//    $stmt->bind_param("s", $name);
//    $stmt->execute();
//    $result = $stmt->get_result();
//    if ($result->num_rows > 0){
//        $test .= "nameExistAlready";
//        $alertMsg = "name already existed";
//        $success = false;
////        die(json_encode(array('error' => $alertMsg))); 
////        die("Error: name alread exists");
//    }
//    $stmt->close();
//}


function sanitize_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function saveMemberToDB(){
    // Prepare the statement: 
    $stmt = $conn->prepare("INSERT INTO Product (productName, productPrice, productCompany, productImage, productDescription) VALUES (?, ?, ?, ?, ?)");
    
    // Get an array of the parameter types (e.g. 'sss') based on the number of fields
    $param_types = str_repeat('s', count($dbfields));

    // Create an array of the parameter values
    $params = array();
    foreach($dbfields as $key=>$value) {
        if ($key != "pwd_confirm" && $key != "agree") {
            $params[] = $value;
        }
    }

    // Dynamically bind the parameters to the statement using call_user_func_array()
    $bind_params = array_merge(array($param_types), $params);
    call_user_func_array(array($stmt, 'bind_param'), $bind_params);
    
    // Execute statement and do error checking
    if (!$stmt->execute()) {
        $alertMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        $success = false;
//        die(json_encode(array('error' => $alertMsg))); 
        
    }else {
        $alertMsg = "successfull";
    }
    $stmt->close();
//    echo json_encode($alertMsg);
}