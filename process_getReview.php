<?php

    $ID = $_POST["productID"];

    $config = parse_ini_file('../private/db-config.ini');
    

    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    
        // Check connection
    if ($conn->connect_error)
    {
        
        echo json_encode("Connection fail test");
    }
    else {
        
        // Prepare the query statement
        $stmt = $conn->prepare("SELECT reviewID, reviewTitle, reviewDescription, reviewRating FROM Review WHERE productID=$ID");
        // Execute the query statement and bind the result columns to variables
        $stmt->execute();
        $stmt->bind_result($reviewID, $reviewTitle, $reviewDescription, $reviewRating);

        // Fetch the data and store it in an array
        $data = array();
        while ($stmt->fetch()) {
          $data[] = array(
            'reviewID' => $reviewID,
            'reviewTitle' => $reviewTitle,
            'reviewDescription' => $reviewDescription,
            'reviewRating' => $reviewRating
          );
        }

        // Close the statement and database connection
        $stmt->close();
        $conn->close();
        
        
        $json = json_encode($data);  
        echo($json);
    }