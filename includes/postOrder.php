<?php
    //To get userID
    require '../zebra_session/Zebra_Session.php';

    // define $session as a global variable
    global $session;

    $configs = parse_ini_file('../../private/db-config.ini');
    $conns = new mysqli($configs['servername'], $configs['username'],
            $configs['password'], $configs['dbname']);

    if ($conns->connect_error) {
        $errorMsg = "Connection failed: " . $conns->connect_error;
    } else {
        $session = new Zebra_Session($conns, 'sEcUr1tY_c0dE');
    }
    
    $userID=$_SESSION['userID'];   
    
    ////////////////////////////////
    $orderItems = json_decode($_POST['orderItems'], true);

    $config = parse_ini_file('../../private/db-config.ini');
    
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    
    // Check connection
    if ($conn->connect_error)
    {
        
        echo json_encode("Connection fail test");
    }
    else {
        echo json_encode($cartArray);
        foreach($orderItems AS $orderItem){
            
            $stmt = $conn->prepare("INSERT INTO orderDetail (orderQuantity, orderName, orderPrice, User_userID) VALUES (?, ?, ?, ?)");
           $orderQuantity = $orderItem['amount'];
            $orderName = $orderItem['productName'];
            $orderPrice = $orderItem['productPrice'];
            $User_userID = $userID;
            $stmt->bind_param("isii", $orderQuantity, $orderName , $orderPrice, $User_userID);
            if (!$stmt->execute())
            {
                echo json_encode("error");
            }
            $stmt->close();
        }
        
        
        $conn->close();
        echo json_encode("success");
        

    }