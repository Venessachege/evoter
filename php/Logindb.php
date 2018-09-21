<?php
    session_start();
    if (isset($_POST["loginuser"])) {
        include_once 'connection.php';
        
    if (array_key_exists("loginuser",$_POST)  AND isset($_POST['loginuser'])) {
            $email = $mysqli->real_escape_string($_POST['Email']);
            $password = $mysqli->real_escape_string($_POST['Password']);

            $query="SELECT * FROM users where `Email` ='$email';";
            $result = $mysqli->query($query) OR die($mysqli->error);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $pass = $row['Password'];
                $match = password_verify($password,$pass);
                if($match){
                    $_SESSION['id'] = $row['User_id'];
				    $_SESSION['userEmail'] = $row['Email'];
				   $_SESSION['name'] = $row['First_name'];
                    $_SESSION['loggedIn'] = true;
               
                    header("location:/brettinterfaces/dashboard.php");
                }
                else{
                    echo "Passwords do not match";
                }
            }
        }
    }
?>