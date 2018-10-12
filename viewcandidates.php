<!Doctype html>
<html>
<head>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
		<title>eVOTER</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
</head>
<title>
   
</title>
<body style="background-color: #263238;">
<!--
    <header id="header">
				<h1><a href="index.php">eVOTER</a></h1>
				<nav id="nav">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="voting.php">Days to Elections</a></li>
                        <li><a href="viewcandidates.php">Candidates</a></li>
						<li><a href="">Live Results</a></li>
						<li><a href="signup.php" class="button special">Sign Up</a></li>
						<li><a href="login.php" class="button special">Sign In</a></li>
					</ul>
				</nav>
			</header>
-->
   <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-end">
    <a class="navbar-brand" href="index.php">Home</a>
    <button class="btn btn-success ml-auto">Always Show</button>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
        <ul class="navbar-nav text-right">
            <li class="nav-item active">
                <a class="nav-link" href="voting.php">Days to Election</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Candidates</a>
                
            </li>
             <li class="nav-item active">
                <a class="nav-link" href="">Live Results</a>
                
            </li>
             <li class="nav-item active">
                <a class="nav-link" href="#">Sign Up</a>
                
            </li>
             <li class="nav-item active">
                <a class="nav-link" href="signup.php" class="button special">Sign Up</a> 
                
            </li>
              <li class="nav-item active">
                <a class="nav-link" href="login.php" class="button special">Sign In</a> 
                
            </li>
            
        </ul>
    </div>
</nav>
  


   
    <?php 
        require_once('php/connection.php');
        $result =$mysqli->query("SELECT * FROM users"
            . "	INNER JOIN candidate_details"
            . "    ON users.User_id = candidate_details.User_id") OR die($mysqli->error);
        $candidates = mysqli_fetch_all($result,MYSQLI_ASSOC);    
    ?>
    <div class="row">
        <?php foreach($candidates as $candidate): ?>
            <div class="card col-md-3">
              <img class="card-img-top" src="<?= $candidate['image'];?>" style="width: 100%;" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title"><?= $candidate['First_name']; ?></h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card content.</p>
                <a href="candidatesmanifesto.php?candidate=<?= $candidate['User_id']?>" class="btn btn-primary">View Manifesto</a>
              </div>
            </div>
        <?php endforeach; ?>
    </div>
    

</body>
</html>
 