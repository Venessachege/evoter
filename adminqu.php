<?php
session_start();
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
        <link href="assets/css/animate.min.css" rel="stylesheet"/>

        <!--  Paper Dashboard core CSS    -->
        <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>

        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="assets/css/demo.css" rel="stylesheet" />

        <!--  Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
        <link href="assets/css/themify-icons.css" rel="stylesheet">
        <?php
        $conn = new mysqli('localhost', 'root', '', 'evoter');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 


        ?>
        <script type="text/javascript">
            function noBack()
            {
                window.history.forward()
            }
            noBack();
            window.onload = noBack;
            window.onpageshow = function(evt) { if (evt.persisted) noBack() }
            window.onunload = function() { void (0) }
        </script>

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
                        <li >
                            <a href="admin.php">
                                <i class="ti-home"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li>
                            <a href="adminre.php">
                                <i class="ti-user"></i>
                                <p>Registration</p>
                            </a>
                        </li>
                        <li class="active">
                            <a href="adminqu.php">
                                <i class="ti-view-list-alt"></i>
                                <p>Query</p>
                            </a>
                        </li>
                        <li>
                            <a href="adminalt.php">
                                <i class="ti-text"></i>
                                <p>Live Table</p>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="ti-bell"></i>
                                <p>Notifications</p>
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
                            <a class="navbar-brand" href="#">Administrator</a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="ti-panel"></i>
                                        <p>Welcome <?= $_SESSION['name'] ?></p>
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
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Registered Voters</h4>
                            </div>
							  <form action="" method="post">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="search" class="form-control border-input" placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <button type="submit" name="sea" class="btn btn-info btn-fill btn-wd">Search</button>
                                </div>
                            </form>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                    </thead>
                                    <tbody>
                                        <?php
										if(isset($_POST['sea']))
										{
                                            $search_value=$_POST['search'];
                                                $sql="SELECT * FROM `users` WHERE `First_name` LIKE '%$search_value%'";
                                                $result=$conn->query($sql);
                                                while($row=$result->fetch_assoc())
                                                {
                                                    echo '
                                        <tr>
                                        	<td>'.$row['First_name'].'</td>
                                        	<td>'.$row['Last_name'].'</td>
                                        	<td>'.$row['Email'].'</td>
                                        </tr>';
                                                }
										}
										else
										{
										$sql = 'SELECT  `First_name`, `Last_name`, `Email` FROM `users` WHERE Usertype_id=2';
                                                $result = $conn->query($sql);
                                                while($row = $result->fetch_assoc())
                                                {
                                                    echo '
                                        <tr>
                                        	<td>'.$row['First_name'].'</td>
                                        	<td>'.$row['Last_name'].'</td>
                                        	<td>'.$row['Email'].'</td>
                                        </tr>';
                                                }
										
										
										}
										
                                        ?>
                                </table>
                            </div>
                        </div>
                    </div>
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Registered Candidates</h4>
                                </div>

                                <div class="content table-responsive table-full-width">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sql = 'SELECT  `First_name`, `Last_name`, `Email` FROM `users` WHERE Usertype_id=1';
                                                $result = $conn->query($sql);
                                                while($row = $result->fetch_assoc())
                                                {
                                                    echo '
                                        <tr>
                                        	<td>'.$row['First_name'].'</td>
                                        	<td>'.$row['Last_name'].'</td>
                                        	<td>'.$row['Email'].'</td>
                                        </tr>';
                                                }
                                            ?>
                                    </table>
                                </div>
                            </div>


                            <footer class="footer">
                                <div class="container-fluid">
                                    <nav class="pull-left">
                                        <ul>

                                            <li>
                                                <a href="adminqu.php">
                                                    Query
                                                </a>
                                            </li>
                                        </ul>
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


                </html>