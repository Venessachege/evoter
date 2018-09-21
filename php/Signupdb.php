<?php
    require_once 'connection.php';

    function filterName($field){
    // Sanitize name
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    
    // Validate name
    if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        return $field;
    } else{
        return FALSE;
    }
}    
function filterEmail($field){
    // Sanitize e-mail address
    $field = filter_var(trim($field), FILTER_SANITIZE_EMAIL);
    
    // Validate e-mail address
    if(filter_var($field, FILTER_VALIDATE_EMAIL)){
        return $field;
    } else{
        return FALSE;
    }
}

    //Define the variables initializing them as empty
    $fname ="" $lname ="" $email ="" $pass ="" $cpass = "";
    $fname_err ="" $lname_err ="" $email_err ="" $pass_err ="" $cpass_err = "";

   
       if($_SERVER["REQUEST_METHOD"]=="POST"){
        $fname = filterName($_POST["First_name"]);
        if($fname == FALSE){
            $fname_err = "Name can only contain alphabets";
        }
        $lname = filterName($_POST["Last_name"]);
        if($lname == FALSE){
            $lname_err = "Name can only contain alphabets";
        }
        
        $email = filterEmail($_POST["Email"]);
        if($email == FALSE){
            $email_err = "Please enter a valid email address.";
        }
        
        $pass = $mysqli->real_escape_string($_REQUEST['Password']);
        $cpass = $mysqli->real_escape_string($_REQUEST['confirmpassword']);
        
        if(strlen($pass)<6){
             $pass_err = "Password too short";
            if(strcmp($pass,$cpass)){
                $cpass_err = "Passwords dont match";
            }
            
        }
        $fname = $mysqli->real_escape_string($_REQUEST['First_name']);
        $lname = $mysqli->real_escape_string($_REQUEST['Last_name']);
        $email = $mysqli->real_escape_string($_REQUEST['Email']);
        $admission = 2018;
        $user_type = 1;
        $hashedpassword = password_hash($pass, PASSWORD_DEFAULT); // Creates a password hash
        // Prepare an insert statement
 
       $sql = "INSERT INTO users (First_name,Last_name,Email,Admission_year,Usertype_id,Password) VALUES ('$fname','$lname','$email','$admission','$user_type','$hashedpassword')";
           
        if($mysqli->query($sql) === true){
            header('Location: login.php');
        }else{
            echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
        }
           
        
         
        
    } 

?>



 