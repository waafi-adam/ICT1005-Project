<?php
require 'zebra_session/Zebra_Session.php';
$conn = new mysqli("localhost", "sqldev", "InF1005", "shoeStore");
if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
} else {
    $session = new Zebra_Session($conn, 'sEcUr1tY_c0dE');


    print_r('<pre>');
    print_r($_SESSION);
    print_r('</pre>');

}
?>

