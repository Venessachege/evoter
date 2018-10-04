<?php
    session_start();
    $user_id = $_SESSION['id'];

    if(isset($_POST['new_path'])){
        $image = $_POST['new_path'];
        
        require_once('php/connection.php');
        
        $sql = "UPDATE candidate_details SET image='$image' WHERE User_id=$user_id";
        echo $mysqli->query($sql) OR die($mysqli->error);
    }
    
?>