<?php
session_start();

if (isset($_POST["postmanifesto"])) {
        include_once 'connection.php';
   
     $manifesto = $mysqli->real_escape_string($_REQUEST['manifesto']);
     
      $sql = "UPDATE candidate_details SET manifesto='$manifesto'WHERE User_id=".$_SESSION['id'].";";

                if($mysqli->query($sql) === true){
                    //Sends sign up email to user
                    
                        header('Location: ../login.php');
                    
                }else{
                    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                }
           }                          
?> 