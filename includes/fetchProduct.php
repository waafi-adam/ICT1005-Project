<?php

    $ID = $_POST["productID"];

    $config = parse_ini_file('../../private/db-config.ini');
    

    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    
        // Check connection
    if ($conn->connect_error)
    {
        
        echo json_encode("Connection fail test");
    }
    else {
        
        $results = $conn->query("SELECT * FROM Product WHERE productID=$ID");
        $row = [];
        foreach($results as $result) {

            $row[] = [
                'productID' => $result['productID'], 
                'productName' => $result['productName'],
                'productPrice' => $result['productPrice'],
                'productCompany' => $result['productCompany'],
                'productImage' => base64_encode($result['productImage']),
                'productDescription' => $result['productDescription'],
                'productImagePath' => $result['productImagePath']
            ];
        }
        
        echo json_encode($row);
         
        $conn->close();
    }

