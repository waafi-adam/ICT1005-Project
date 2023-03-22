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
        $res = $conn->query('SELECT * FROM Product');
        $rowstest = [];
        foreach ($res as $row) {
            $rowstest[] = [
                'productID' => $row['productID'], 
                'productName' => $row['productName'],
                'productPrice' => $row['productPrice'],
                'productCompany' => $row['productCompany'],
                'productImage' => base64_encode($row['productImage']),
                'productDescription' => $row['productDescription'],
                'productImagePath' => $row['productImagePath']
            ];
        }
        
        $json = json_encode($rowstest);  
        echo "<script>localStorage.setItem('product', '$json');</script>";

      
    }

