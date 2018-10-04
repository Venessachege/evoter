<?php
session_start();
if (isset($_POST["postmanifesto"])) {
        include_once 'connection.php';
     $manifesto = $mysqli->real_escape_string($_REQUEST['editor1']);
      $sql = "INSERT INTO manifesto (copy) VALUES ('$manifesto')";

                if($mysqli->query($sql) === true){
                    //Sends sign up email to user
                    
                        header('Location: ../login.php');
                    
                }else{
                    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                }
           }                           
?>