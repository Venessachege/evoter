<?php
    require_once 'php/connection.php';

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
    $fname = $lname = $email = $pass = $cpass = $admission="";
    $fname_err = $lname_err = $email_err = $pass_err = $cpass_err = "";

   
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
            }else {
                $sql="select * from Users where (Email='$email');";
                $res=mysqli_query($mysqli,$sql);
                if (mysqli_num_rows($res) > 0) {
                    // output data of each row
                $row = mysqli_fetch_assoc($res);
       
           if($email==$row['Email'])
           {
          $email_err = "Email already exists";
        }
        else{
         echo "alright";
     }
	}
            }

            $pass = $mysqli->real_escape_string($_REQUEST['Password']);
            $cpass = $mysqli->real_escape_string($_REQUEST['confirmpassword']);

            if(strlen($pass)<6){
                 $pass_err = "Password too short";
                if(strcmp($pass,$cpass)){
                    $cpass_err = "Passwords dont match";
                }

            }
           
           //Only runs when there is no error
           if(!$fname_err && !$lname_err && !$email_err && !$pass_err && !$cpass_err ){
                $fname = $mysqli->real_escape_string($_REQUEST['First_name']);
                $lname = $mysqli->real_escape_string($_REQUEST['Last_name']);
                $email = $mysqli->real_escape_string($_REQUEST['Email']);
                $admission = 2018;
                $user_type = 1;
                $hashedpassword = password_hash($pass, PASSWORD_DEFAULT); // Creates a password hash
             
               $sql = "INSERT INTO users (First_name,Last_name,Email,Admission_year,Usertype_id,Password) VALUES ('$fname','$lname','$email','$admission','$user_type','$hashedpassword')";

                if($mysqli->query($sql) === true){
                    //Sends sign up email to user
                    require_once"applyemail.php";
                    $message = "Hello ".$fname.",
                    You have been successfully been registered.";

                    $sent = send_email($email,$message,"ACCOUNT REGISTRATION");
                    if($sent){
                        header('Location: login.php');
                    }else{
        //                echo "Email could not be sent. Try again later.";
                    }
                }else{
                    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                }
           }                           
        
    } 

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eVOTER</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="css/Styles.css" rel="stylesheet">
       <script src="jquery-3.3.1.js"></script>
    
  
</head>
    <body>
    <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="inactive underlineHover"> <a href="login.php">Sign In</a> </h2>
    <h2 class="active">Sign Up </h2>

    <!-- Login Form -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" class="validate" >
      <input type="text" value="<?= $fname; ?>" id="First_name" class="fadeIn first" name="First_name" placeholder="First Name" required="required" autocomplete="off"><br>
          <span class="errors" id="fname-error"><?php echo $fname_err;?></span>
      <input type="text" value="<?= $lname; ?>" id="Last_name" class="fadeIn second" name="Last_name" placeholder="Last Name" required="required" autocomplete="off"><br>
            <span class="errors" id="lname-error"><?php echo $lname_err;?></span>
      <input type="text" value="<?= $email; ?>" id="Email" class="fadeIn third" name="Email" placeholder="Email" required="required" autocomplete="off" ><br>
            <span class="errors" id="email-error"><?php echo $email_err;?></span>
     <input type="text" value="<?= $admission; ?>"id="Admission_year" class="fadeIn third" name="Admission_year" placeholder="Year of admission" required="required" autocomplete="off">
      <input type="password" id="Password" class="fadeIn fourth" name="Password" placeholder="Password" required="required" autocomplete="off" ><span id="passworderror"><?php echo $pass_err;?></span><br>
             <span class="errors" id="pass-error"></span>
      <input type="password" id="confirmpassword" class="fadeIn fourth" name="confirmpassword" placeholder="Confirm password" required="required" autocomplete="off"><br>
           <span class="errors" id="confirm-error"><?php echo $cpass_err;?></span><br>
      <input type="submit" class="fadeIn fourth" value="Sign Up" id="submit">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="login.html">Already have an Account?</a>
    </div>

  </div>
</div>
       
<script src="Js/scripts.js"></script>
</body>
</html>