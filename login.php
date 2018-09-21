
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eVOTER</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="css/Styles.css" rel="stylesheet">
</head>
    <body>
    <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <h2 class="active"> Sign In </h2>
      <h2 class="inactive underlineHover"><a href="signup.php">SignUp</a> </h2>

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form method="POST" action="php/Logindb.php">
      <input type="text" id="login" class="fadeIn second" name="Email" placeholder="email" required="required" autocomplete="off">
      <input type="password" id="password" class="fadeIn third" name="Password" placeholder="password" required="required" autocomplete="off">
      <input type="submit" class="fadeIn fourth" value="login" name="loginuser" >
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="passwordreset.php">Forgot Password?</a>
    </div>

  </div>
</div>
</body>