<?php
    //To get userID
    require './zebra_session/Zebra_Session.php';

    // define $session as a global variable
    global $session;

    $configs = parse_ini_file('../private/db-config.ini');
    $conns = new mysqli($configs['servername'], $configs['username'],
            $configs['password'], $configs['dbname']);

    if ($conns->connect_error) {
        $errorMsg = "Connection failed: " . $conns->connect_error;
    } else {
        $session = new Zebra_Session($conns, 'sEcUr1tY_c0dE');
    }
    
    $userID=$_SESSION['userID'];   
    echo json_encode($userID);

    //Main code

    $productID = $_POST["productID"];
    echo json_encode($productID);
    $DBaction = $_POST["DBaction"];
    echo json_encode($DBaction);
    

    $config = parse_ini_file('../private/db-config.ini');
    

    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    
        // Check connection
    if ($conn->connect_error)
    {
        
        echo json_encode("Connection fail test");
    }
    else {
        //Add new item
        if($DBaction == "addCart") {
            echo json_encode("add cart");
            $quantity = 1;
            $stmt = $conn->prepare("INSERT INTO Cart (cartQuantity, User_userID, Product_productID) VALUES (?,?,?)");
            $stmt->bind_param("iii", $quantity, $userID, $productID);
            if(!$stmt->execute()) {
                $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                echo json_encode($errorMsg);
            }
        }
        elseif($DBaction == "updateCart") {
            echo json_encode("update cart");
            $quantity = $_POST["cartQuantity"];
            echo json_encode($quantity);

            $stmt = $conn->prepare("UPDATE Cart SET cartQuantity=? WHERE Product_productID=? AND User_userID=?");
            $stmt->bind_param("iii", $quantity, $productID, $userID);

            if(!$stmt->execute()) {
                $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                echo json_encode($errorMsg);
            }
        }
        elseif($DBaction == "removeCart") {
            echo json_encode("delete cart");
            $stmt = $conn->prepare("DELETE FROM Cart WHERE Product_productID=? AND User_userID=?");
            $stmt->bind_param("ii", $productID, $userID);
            
            if(!$stmt->execute()) {
                $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                echo json_encode($errorMsg);
            }
        }







        $stmt->close();
 
    }

    $conn->close();