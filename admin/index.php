<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/unitedpicturesblog/inc/db.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/unitedpicturesblog/inc/sessions.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/unitedpicturesblog/inc/functions.php';

    confirm_login();
    //dashboard table information
    $viewQuery="SELECT * FROM admin_panel ORDER BY id desc ";
    $execute=$conn->query($viewQuery);
    $sno=0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Peter Chege">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

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
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>

                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-chart-bar"></i>New Post</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas fa-table"></i>Categories</a>
                        </li>

                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Manage Admin</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="login.php">Login</a>
                                </li>
                                <li>
                                    <a href="register.php">Register</a>
                                </li>
                                <li>
                                    <a href="forget-pass.php">Forget Password</a>
                                </li>
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
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>

                        </li>

                        <li>
                            <a href="newpost.php">
                                <i class="fas  fa-list-alt"></i>New Post</a>
                        </li>
                        <li>
                            <a href="categories.php">
                                <i class="fas fa-tags"></i>Categories</a>
                        </li>

                        <li class="has-sub">
                            <a class="js-arrow" href="manage_admin.php">
                                <i class="far fa-user"></i>Manage Admin</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="comment.php">
                                <i class="fas fa-comment"></i>Comments</a>
                            <?php
                                    // counting unapproved comments
                                    $queryUnapproved="SELECT * FROM comments WHERE `status`='OFF' ";
                                    $executeQueryUnapproved=$conn->query($queryUnapproved);
                                ?>
                            <span class="inbox-num"><?=$rowUnapproved=mysqli_num_rows($executeQueryUnapproved);?></span>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fas  fa-rss"></i>Live Blog</a>
                        </li>
                        <li>
                            <a href="logout.php">
                                <i class="zmdi zmdi-power"></i>Log Out</a>
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
                                                    <h5 class="name">
                                                        <a href="#"><?=$_SESSION['username'];?></a>
                                                    </h5>
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
                                                <a href="logout.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
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
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <?php
                                    echo Message();
                                    echo SuccessMessage();
                                ?>
                                    <h2 class="title-1">overview</h2>
                                    <a href="newpost.php"><button class="au-btn au-btn-icon au-btn--blue2">
                                            <i class="zmdi zmdi-plus"></i>add user</button></a>
                                </div>
                            </div>

                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <h2>
                                                    <?php
                                                  $adminNo=$conn->query("SELECT * FROM admin_registration"); 
                                                echo mysqli_num_rows($adminNo);
                                                ?>
                                                </h2>
                                                <span>Number of Admins</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart1"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-shopping-cart"></i>
                                            </div>
                                            <div class="text">
                                                <h2>
                                                    <?php
                                                  $postsNo=$conn->query("SELECT * FROM admin_panel"); 
                                                echo mysqli_num_rows($postsNo);
                                                ?>
                                                </h2>
                                                <span>Number of Posts</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart2"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-calendar-note"></i>
                                            </div>
                                            <div class="text">
                                                <h2>
                                                    <?php
                                                  $categoryNo=$conn->query("SELECT * FROM categories"); 
                                                echo mysqli_num_rows($categoryNo);
                                                ?>
                                                </h2>
                                                <span>Number of Categories</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart3"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-comment"></i>
                                            </div>
                                            <div class="text">
                                                <h2>
                                                    <?php
                                                  $commentsNo=$conn->query("SELECT * FROM comments"); 
                                                echo mysqli_num_rows($commentsNo);
                                                ?>
                                                </h2>
                                                <span>Number of Comments</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart4"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35">Posts table</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-right">
                                        <a href="/unitedpicturesblog/admin/newpost.php"><button class="au-btn au-btn-icon au-btn--green au-btn--small pull-right"><i class="zmdi zmdi-plus"></i>add post</button></a>
                                    </div>
                                </div>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Post Title</th>
                                                <th>Date & Time</th>
                                                <th>Author</th>
                                                <th>Category</th>
                                                <th>Banner</th>
                                                <th>Comment</th>
                                                <th>Action</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($t=mysqli_fetch_assoc($execute)): ?>
                                            <tr class="tr-shadow">
                                                <td><?=++$sno;?></td>
                                                <td><?=$t['title'];?></td>
                                                <td><?=$t['datetime'];?></td>
                                                <td class="desc"><?=$t['author'];?></td>
                                                <td><?=$t['category'];?></td>
                                                <td>
                                                    <span class="status--process"><img style="width:200px; height:10%;" src="/../unitedpicturesblog/<?=$t['image']; ?>" /></span>
                                                </td>
                                                <td>
                                                    <?php                                                    
                                                    $id=$t['id'];
                                                    // counting approved comments
                                                    $queryApproved="SELECT * FROM comments WHERE admin_panel_id='$id' AND `status`='ON' ";
                                                    $executeQueryApproved=$conn->query($queryApproved);
                                                    
                                                    // counting unapproved comments
                                                    $queryUnapproved="SELECT * FROM comments WHERE admin_panel_id='$id' AND `status`='OFF' ";
                                                    $executeQueryUnapproved=$conn->query($queryUnapproved);
                                                    ?>

                                                    <span class="label label-danger pull-left">
                                                        <?=$rowUnapproved=mysqli_num_rows($executeQueryUnapproved);?>
                                                    </span>
                                                    <span class="label label-success pull-right">
                                                        <?=$rowApproved=mysqli_num_rows($executeQueryApproved);?>
                                                    </span>

                                                </td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <a href="editpost.php?edit=<?=$t['id'];?>"><button class="btn-success">Edit</button></a>
                                                        <a href="deletepost.php?delete=<?=$t['id'];?>"><button class="btn-danger">Delete</button></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <a href="../fullpost.php?id=<?=$t['id'];?>" target="_blank"><button class="btn-primary"><i class="fas fa-desktop"></i> &nbsp; Live Preview</button></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                                            <?php endwhile;?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2019 United Pictures. All rights reserved.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
