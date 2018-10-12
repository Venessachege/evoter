<?php
session_start();
include_once"php/connection.php";
 //Only runs when there is no error

    $success;
    $error;
           if (isset($_POST["update"])){
                $name = $mysqli->real_escape_string($_REQUEST['First_name']);
                $lname = $mysqli->real_escape_string($_REQUEST['Last_name']);
                $year = $mysqli->real_escape_string($_REQUEST['year']);
                $course  = $mysqli->real_escape_string($_REQUEST['course']);
                $faculty= $mysqli->real_escape_string($_REQUEST['faculty']);
                $telephone = $mysqli->real_escape_string($_POST['telephone']);
                
               $sql="UPDATE users u INNER JOIN candidate_details cd ON u.User_id=cd.User_id
                        SET cd.year=$year,cd.course='$course',cd.faculty='$faculty',cd.telephone='$telephone',
                        u.First_Name='$name',u.Last_name='$lname'
                        WHERE u.User_id=".$_SESSION['id'];
              
                if($mysqli->query($sql) ){				 
                    $_SESSION['telephone']=$telephone;
                    $_SESSION['faculty']=$faculty;
                    $_SESSION['year']=$year;
                    $_SESSION['course']=$course;
                    $_SESSION['name'] = $name;
                    $_SESSION['lname'] = $lname;
                    
                    $success = "Successfully updated records";                    
                }else{
                    $error = "ERROR: Could not able to execute $sql. " . $mysqli->error;
                }
           }
           
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>eVOTER</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet" />

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet" />

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-background-color="black" data-active-color="danger">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text">
                        eVoter
                    </a>
                </div>

                <ul class="nav">
                    <li>
                        <a href="dashboard.php">
                            <i class="ti-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="dashboard.php">
                            <i class="ti-user"></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <li>
                        <a href="manifesto.php">
                            <i class="ti-view-list-alt"></i>
                            <p>Manifesto</p>
                        </a>
                    </li>


                </ul>
            </div>
        </div>

        <div class="main-panel">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar bar1"></span>
                            <span class="icon-bar bar2"></span>
                            <span class="icon-bar bar3"></span>
                        </button>
                        <a class="navbar-brand" href="#">Candidate Module</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-user"></i>
                                    <p>Welcome
                                        <?= $_SESSION['name'] ?>
                                    </p>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-settings"></i>
                                    <p class="notification">5</p>
                                    <p>Options</p>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Notification 1</a></li>
                                    <li><a href="#">Notification 2</a></li>
                                    <li><a href="#">Notification 3</a></li>
                                    <li><a href="#">Notification 4</a></li>
                                    <li><a href="#">Another notification</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="index.php" onclick="noBack()">
                                    <i class="ti-bell"></i>
                                    <p>Logout</p>
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>


            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="card card-user">
                                <div class="image">
                                    <img src="assets/img/background.jpg" alt="..." />
                                </div>
                                <div class="content">
                                    <div class="author">
                                        <img class="avatar border-white" id="avatar" src="images/user.png" alt="..." />

                                        <!--Form for image upload-->
                                        <input class="hidden" type="file" name="add-image" id="add-image">

                                        <h4 class="title">
                                            <?= $_SESSION['name'].' '.$_SESSION['lname'];?><br />
                                            <a href="#"><small>@President</small></a>
                                        </h4>
                                    </div>
                                    <p class="description text-center">
                                    </p>
                                </div>
                                <hr>
                                <div class="text-center">
                                    <div class="row">
                                        <div class="col-md-3 col-md-offset-1">
                                            <h5>12<br /><small>Year</small></h5>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>B<br /><small>Group</small></h5>
                                        </div>
                                        <div class="col-md-3">
                                            <h5>ics<br /><small>Faculty</small></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-8 col-md-7">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title" style="display: inline;">Edit Profile</h4>

                                    <div style="float:right; font-weight:700;">
                                        VoterID: <span>
                                            <?= $_SESSION['id'] ?></span>
                                    </div>
                                </div>
                                <div class="content">
                                    <form method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control border-input" placeholder="Company" name="First_name"value="<?= $_SESSION['name'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text"name="Last_name" class="form-control border-input" placeholder="Last Name" value="<?= $_SESSION['lname'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Email address</label>
                                                    <input type="email" class="form-control border-input" placeholder="Email" value="<?= $_SESSION['userEmail'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Telephone</label>
                                                    <input type="text" class="form-control border-input" placeholder="Telephone number" name="telephone" value="<?= $_SESSION['telephone'] ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Year</label>
                                                    <input type="number" class="form-control border-input" placeholder="Current year" required value="<?= $_SESSION['year'] ?>" name="year">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Course</label>
                                                    <input type="text" class="form-control border-input" placeholder="Course" value="<?= $_SESSION['course'] ?>" name="course">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Faculty</label>
                                                    <input type="text" class="form-control border-input" value="<?= $_SESSION['faculty'] ?>" placeholder="Class" name="faculty">
                                                </div>
                                            </div>
                                        </div>

                                        <!--
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>About Me</label>
                                                    <textarea rows="5" class="form-control border-input" placeholder="Here can be your description" value="Mike" name="about"></textarea>
                                                </div>
                                            </div>
                                        </div>
-->
                                        <div class="text-center">
                                            <button type="submit" id="update" name="update" class="btn btn-info btn-fill btn-wd">Update Profile</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">

                    </nav>
                    <div class="copyright pull-right">
                    </div>
                </div>
            </footer>

        </div>
    </div>


</body>

<!--   Core JS Files   -->
<script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="assets/js/bootstrap-checkbox-radio.js"></script>

<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="assets/js/paper-dashboard.js"></script>

<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

<script src="js/scripts.js"></script>
    
     <?php if(isset($success)): ?>
        <script>
            $(document).ready(()=> {
                notify('success','fa fa-check','<?= $success;?>');
                console.log('success');   
                
            });
        </script>    
    <?php endif; ?>
    >
    <?php if(isset($error)): ?>
        <script>
            $(document).ready(()=> {
                notify('warning','fa fa-warning','<?= $error;?>');
                console.log('success');                
            });
            
        </script>
    <?php endif; ?>


</html>
