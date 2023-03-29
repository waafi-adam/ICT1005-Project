<?php


    $config = parse_ini_file('../private/db-config.ini');
    //echo json_encode($config['servername']);
    
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    //echo $config['servername'];
        // Check connection
    if ($conn->connect_error)
    {
        echo json_encode("Connection fail");
    }
    else {
        // Prepare the query statement
        $stmt = $conn->prepare("SELECT userID, userName, userEmail FROM User");

        // Execute the query statement and bind the result columns to variables
        $stmt->execute();
        $stmt->bind_result($userID, $userName, $userEmail);
        // Fetch the data and store it in an array
        $data = array();
        while ($stmt->fetch()) {
          $data[] = array(
            'userID' => $userID,
            'userName' => $userName,
            'userEmail' => $userEmail
          );
        }

        // Close the statement and database connection
        $stmt->close();
        $conn->close();

        // Return the data as a JSON-encoded response
        header('Content-Type: application/json');
        echo json_encode($data);
        
        
       
    }