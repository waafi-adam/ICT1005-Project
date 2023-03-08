<?php
    include "head.inc.php";
?>
<body>
    <?php
        include "nav.inc.php";
    ?>
<?php
    $email = $errorMsg = "";
    $success = true;
    $agreevar = false;
    
    $fields = array("fname" => "First Name", "lname" => "Last Name", "email" => "Email", "pwd" => "Password", "pwd_confirm" => "Confirm Password");
    $dbfields = [];
    
//    print_r($dbfields);
    
    if (!checkpassword($_POST["pwd"], $_POST["pwd_confirm"])) {
        $errorMsg .= "Passwords are not the same. <br>";
        $success = false;
    }
    
    foreach($_POST as $key=>$value) {
        if ($key != "fname") {
            if (empty($value)) {
                $errorMsg .= $fields[$key] . " is required.<br>";
                $success = false;
            } else {
                if ($key != "pwd_confirm" && $key != "agree" && $key != "pwd") {
                    $dbfields[$key] = $value;
                }
                if ($key == "pwd") {
                    $dbfields[$key] = password_hash($value, PASSWORD_DEFAULT);
                }
            }
        } else {
            $dbfields[$key] = $value;
        }
        
        $value = sanitize_input($value);
        
        if ($key == "email") {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errorMsg .= "Invalid Email Format. <br>";
                $success = false;
            } else {
                $email = $value;
            }
        }
    }
   
    
    
    
    if (!isset($_POST["agree"])) {
        $errorMsg .= "Terms and Conditions not Checked. <br>";
        $success = false;
    }

    if ($success){
        saveMemberToDB();
        echo "<div class='jumbotron text-center'>";
        echo "<h4 class='display-4'>Registration Successful!</h4>";
        echo "<p><b>Email: " . $email ."</b>";
        echo "</div>";
    } else {
        echo "<div class='jumbotron text-center'>";
        echo "<h4 class='display-4'>RIP :( </h4>";
        echo "<h5>The following errors were detected:</h5>";
        echo "<p class='display-5'><b>" . $errorMsg . "</b></p>";
    }
    
    function checkpassword($pwd1, $pwd2) {
        if ($pwd1 === $pwd2) {
            return true;
        } else {
            return false;
        }
    }
    
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    function saveMemberToDB() {
        global $fname, $lname, $email, $pwd, $errorMsg, $success;
        global $dbfields;
        
        $config = parse_ini_file('../../private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
        
        if ($conn->connect_error) {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
            die($errorMsg);
        } else {
            $sql = "INSERT INTO members (fname, lname, email, password) VALUES(";
            foreach($dbfields as $key=>$value) {
                if ($key != "pwd_confirm" && $key != "agree") {
                    $sql .= "'$value'" . ",";
                }
            }
            
            $sql = substr($sql, 0, -1);
            $sql .= ")";
            
            if (!$conn->query($sql)) {
                $errorMsg = "Database error: " . $conn->error;
                $success = false;
                die($errorMsg);
            }
            
        }
        
        $conn->close();
    }
?>
<?php
    include "footer.inc.php";
?>
</body>