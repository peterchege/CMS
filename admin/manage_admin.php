<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/unitedpicturesblog/inc/db.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'/unitedpicturesblog/inc/sessions.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'/unitedpicturesblog/inc/functions.php';

    confirm_login();
    if(isset($_POST['submitNewAdmin'])){
        $username=test_input($_POST['username']);
        $password=test_input($_POST['password']);
        $email=test_input($_POST['email']);
        $confirm_password=test_input($_POST['confirm_password']);
        date_default_timezone_set("Africa/Nairobi");
        $currentTime=time();
        $dateTime=strftime("%d, %B %Y %H:%M:%S",$currentTime);
        $dateTime;
        $admin=$_SESSION['username'];

        //checking if admin already exists
        $adminQuery="SELECT * FROM admin_registration WHERE username='$username'";
        $adminQueryExecute=$conn->query($adminQuery);

        if(empty($username) || empty($password) || empty($confirm_password)){
            $_SESSION['ErrorMessage']="All fields required";
            //redirect_to("categories.php");
        }elseif(strlen($username)<4){
            $_SESSION['ErrorMessage']="The name of the admin you entered is too short. At least 4 characters required";
            //redirect_to("categories.php");
        }elseif(mysqli_num_rows($adminQueryExecute)>0){
            $_SESSION['ErrorMessage']="The name of the admin already exists. Choose another name";
            //redirect_to("categories.php");
        }elseif($password!==$confirm_password){
            $_SESSION['ErrorMessage']="The passwords don't match";
        }else{
            $password=md5($password);
            $confirm_password=md5($confirm_password);
            $query="INSERT INTO admin_registration(`datetime`, `username`,`password`,email,`added by`) VALUES('$dateTime','$username','$confirm_password','$email','$admin')";
            $conn->query($query);
            $_SESSION['SuccessMessage']="New admin entered successfully";
        }
    }

    // Delete admin
    if(isset($_GET['delete'])){
        $delete_id=$_GET['delete'];
        $delete_id=htmlentities($delete_id);        
        $deleteQuery="DELETE FROM admin_registration WHERE id='$delete_id'";            
        $deleteQueryExecute=$conn->query($deleteQuery);
        
        if($deleteQueryExecute){
            $_SESSION['SuccessMessage']='Admin deleted successfully';
        }else{
            $_SESSION['Message']='Something went terribly wrong. Please try again';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="au theme template" />
    <meta name="author" content="Peter Chege" />
    <meta name="keywords" content="au theme template" />

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all" />
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all" />
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all" />
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all" />

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all" />

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all" />
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all" />
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all" />
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all" />
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all" />
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all" />
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all" />

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all" />
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.php">
                            <img style="width:50%; margin-top:10px;" src="images/logo1.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="#"> <i class="fas fa-chart-bar"></i>New Post</a>
                        </li>
                        <li>
                            <a href="#"> <i class="fas fa-table"></i>Categories</a>
                        </li>

                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Manage Admin</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li><a href="login.php">Login</a></li>
                                <li><a href="register.php">Register</a></li>
                                <li><a href="forget-pass.php">Forget Password</a></li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>Comment</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img style="width:80%; margin-top:10px;" src="images/logo1.png" alt="United Pictures" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a class="js-arrow" href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>

                        <li>
                            <a href="newpost.php">
                                <i class="fas  fa-list-alt"></i>New Post</a>
                        </li>
                        <li class="has-sub">
                            <a href="categories.php">
                                <i class="fas fa-tags"></i>Categories</a>
                        </li>

                        <li class="active has-sub">
                            <a class="js-arrow" href="manage_admin.php">
                                <i class="fas fa-desktop"></i>Manage Admin</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="comment.php">
                                <i class="fas fa-comment"></i>Comments</a>
                        </li>
                        <li>
                            <a href="#"> <i class="fas  fa-rss"></i>Live Blog</a>
                        </li>
                        <li>
                            <a href="logout.php"> <i class="zmdi zmdi-power"></i>Log Out</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/icon/peter.jpg" alt="John Doe" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?=$_SESSION['username'];?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/icon/peter.jpg" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name"><a href="#"><?=$_SESSION['username'];?></a></h5>
                                                    <span class="email"><?=$_SESSION['email'];?></span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-money-box"></i>Billing</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="#"> <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">

                            <div class="card">
                                <div class="card-header">Add User</div>
                                <div class="card-body card-block">
                                    <form action="" method="post" class="new-user">
                                        <?php
                                            echo Message();
                                            echo SuccessMessage();
                                        ?>
                                        <div class="form-group">
                                            <label class="control-label mb-1 labd">Username</label><br>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                                <input type="text" id="username" name="username" placeholder="Username" class="form-control" value="<?= ((isset($username))?$username:''); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1 labd">Email</label><br>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                                <input type="email" id="email" name="email" placeholder="Email" class="form-control" value="<?= ((isset($email))?$email:''); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1 labd">Password</label><br>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-asterisk"></i>
                                                </div>
                                                <input type="password" id="password" name="password" placeholder="Password" class="form-control" value="<?= ((isset($password))?$password:''); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1 labd">Confirm Password</label><br>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-asterisk"></i>
                                                </div>
                                                <input type="password" id="password" name="confirm_password" placeholder="Retype same password" class="form-control" value="<?= ((isset($confirm_password))?$confirm_password:''); ?>">
                                            </div>
                                        </div><br>

                                        <div class="form-actions form-group">
                                            <button name="submitNewAdmin" id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount">Add New Admin</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <!-- USER DATA-->
                            <div class="user-data m-b-30">
                                <h3 class="title-3 m-b-30">
                                    <i class="zmdi zmdi-account-calendar"></i>Manage Admins</h3>
                                <div class="filters m-b-45">
                                    <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
                                        <select class="js-select2" name="property">
                                            <option selected="selected">All Properties</option>
                                            <option value="">Products</option>
                                            <option value="">Services</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                    <div class="rs-select2--dark rs-select2--sm rs-select2--border">
                                        <select class="js-select2 au-select-dark" name="time">
                                            <option selected="selected">All Time</option>
                                            <option value="">By Month</option>
                                            <option value="">By Day</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="table-responsive table-data">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>Sr No.</td>
                                                <td>Date & Time</td>
                                                <td>Admin Name</td>
                                                <td>Added by</td>
                                                <td>Action</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //Extracting admin data
                                             $extract="SELECT * FROM admin_registration ORDER BY datetime desc";
                                             $run=$conn->query($extract);
                                             $SrNo=0;
                                            ?>
                                            <?php while($a=mysqli_fetch_assoc($run)):  ?>
                                            <tr>
                                                <td>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <?= ++$SrNo; ?>
                                                </td>
                                                <td>
                                                    <?= $a['datetime']; ?>
                                                </td>
                                                <td>
                                                    <div class="table-data__info">
                                                        <h6><?= $a['username']; ?></h6>
                                                        <span>
                                                            <a><?= $a['email']; ?></a>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?= $a['added by']; ?>
                                                </td>
                                                <td>
                                                    <div class="table-data-feature1">
                                                        <a href="manage_admin.php?delete=<?=$a['id']; ?>"><button class="btn-danger"><i class="fas fa-ban"></i> Delete</button></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- END USER DATA-->

                        </div>
                    </div>



                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js"></script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
</body>

</html>
<!-- end document-->
