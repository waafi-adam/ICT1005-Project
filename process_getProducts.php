<?php


    $config = parse_ini_file('../private/db-config.ini');
    //echo $config['servername'];
    
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    //echo $config['servername'];
        // Check connection
    if ($conn->connect_error)
    {
        echo "Connection fail";
    }
    else {
        
        // Prepare the query statement
        $stmt = $conn->prepare("SELECT productID, productName, productPrice, productCompany, productImagePath, productDescription FROM Product");
        // Execute the query statement and bind the result columns to variables
        $stmt->execute();
        $stmt->bind_result($productID, $productName, $productPrice, $productCompany, $productImagePath, $productDescription);

        // Fetch the data and store it in an array
        $data = array();
        while ($stmt->fetch()) {
          $data[] = array(
            'productID' => $productID,
            'productName' => $productName,
            'productPrice' => $productPrice,
            'productCompany' => $productCompany,
            'productImagePath' => $productImagePath,
            'productDescription' => $productDescription
          );
        }

        // Close the statement and database connection
        $stmt->close();
        $conn->close();
        
        $json = json_encode($data);  
        echo $json;
    }

