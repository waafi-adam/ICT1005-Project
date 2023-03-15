<?php

    echo "hello";

    $id = $_POST["productID"];

    $config = parse_ini_file('../private/db-config.ini');

    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    
        // Check connection
    if ($conn->connect_error)
    {
        echo "Connection fail";
    }
    else {
        $stmt = $conn->prepare("SELECT * FROM Product WHERE email=?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $json = $result;
        echo $json;
    }

