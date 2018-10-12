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
        
        <?php 
            if(isset($_SESSION['error_msg'])){
                print_r($_SESSION['error_msg']);
                unset($_SESSION['error_msg']);
            }
        ?>
        
        
        
        

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
                            <a href="admin.php">
                                <i class="ti-home"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="active">
                            <a href="adminre.php">
                                <i class="ti-user"></i>
                                <p>Registration</p>
                            </a>
                        </li>
                        <li>
                            <a href="adminqu.php">
                                <i class="ti-view-list-alt"></i>
                                <p>Query</p>
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
                                <h4 class="title">Bulk Registration</h4>
                            </div>
                            <form action="bulk_registration/upload.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="file" class="form-control border-input" name="file">
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info btn-fill btn-wd">Register</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card">
                            <div class="header">
                                <h4 class="title">Individual Voter Registration</h4>
                            </div>
                            <form>
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">First Name</label>
                                            <input type="text" class="form-control border-input" placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Last Name</label>
                                            <input type="text" class="form-control border-input" placeholder="Last Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="text" class="form-control border-input" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Year of Admission</label>
                                            <input type="text" class="form-control border-input" placeholder="Year of Admission">
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-6"></div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">Register</button>
                                </div>
                                </div>
                                
                            </form>
                        </div>



                            <footer class="footer">
                                <div class="container-fluid">
                                    <nav class="pull-left">
                                        <ul>

                                            <li>
                                                <a href="#">
                                                    Registration
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <div class="copyright pull-right">
                                    </div>
                                </div>
                            </footer>

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