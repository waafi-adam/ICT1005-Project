<?php

require 'zebra_session/Zebra_Session.php';

// define $session as a global variable
global $session;

$config = parse_ini_file('../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'],
        $config['password'], $config['dbname']);

if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
} else {
    $session = new Zebra_Session($conn, 'sEcUr1tY_c0dE');
}

// return the $session variable
return $session;
