<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/unitedpicturesblog/inc/db.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/unitedpicturesblog/inc/sessions.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/unitedpicturesblog/inc/functions.php';
    confirm_login();
    //approve comment
    if(isset($_GET['approveComment'])){
       $comment_id=$_GET['approveComment'];
       $admin='Tony admin'; //$_SESSION['username'];
       $query="UPDATE comments SET status='ON', approved_by='$admin' WHERE id='$comment_id' ";
       $execute=$conn->query($query); 

       if($execute){
       	$_SESSION['SuccessMessage']='Comment approved successfully';
       //	echo "<script>window.open('comments.php','_SELF');</script>";
       }else{
       	$_SESSION['ErrorMessage']='Something went terribly wrong. Please try again';
       //	echo "<script>window.open('comments.php','_SELF');</script>";
       }
    }
    
    //delete comment
    if (isset($_GET['deleteComment'])) {
	$deleteComment_id=$_GET['deleteComment'];
	$query="DELETE FROM comments WHERE id='$deleteComment_id'";
	$execute=$conn->query($query);
	if($execute){
		$_SESSION['SuccessMessage']='Comment deleted successfully';
		//echo "<script>window.open('comments.php','_SELF');</script>";

	}else{
		$_SESSION['Message']='Something went wrong';
		//echo "<script>window.open('comments.php','_SELF');</script>";
	}
}
    
    //disapprove comment
    if (isset($_GET['disApprove'])) {
        $disapprove_id=$_GET['disApprove'];
        $query="UPDATE comments SET status='OFF' WHERE id='$disapprove_id'";
        $execute=$conn->query($query);
	if($execute){
		$_SESSION['SuccessMessage']='Comment disapproved successfully';
		//echo "<script>window.open('comments.php','_SELF');</script>";

	}else{
		$_SESSION['Message']='Something went wrong';
		//echo "<script>window.open('comments.php','_SELF');</script>";
	}
}
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
                        <li class="has-sub">
                            <a class="js-arrow" href="index.php">
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
                        <li class="active has-sub">
                            <a class="js-arrow" href="comment.php">
                                <i class="fas fa-comment"></i>Comments</a>
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


                        <!-- UN-Approved Comments -->
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                    echo Message();
                                    echo SuccessMessage();
                                ?>
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35">UN-APPROVED COMMENTS</h3>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>

                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Date & Time</th>
                                                <th>Comment</th>
                                                <th>Approve</th>
                                                <th>Delete Comment</th>
                                                <th>Detail</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!--                                            fetching comments-->
                                            <?php
                                            $querySql="SELECT * FROM comments WHERE status='OFF' ORDER BY datetime desc ";
                                            $executequery=$conn->query($querySql);
                                            $sno=0;
                                            ?>
                                            <?php while($c=mysqli_fetch_assoc($executequery)): ?>
                                            <tr class="tr-shadow">
                                                <td><?= ++$sno; ?></td>
                                                <td class="desc"><?=$c['name'];?></td>
                                                <td><?=$c['datetime'];?></td>
                                                <td><?=((strlen($c['comment'])>1)?substr($c['comment'],0,110).'[..]':$c['comment']);?></td>
                                                <td>
                                                    <div class="table-data-feature1">
                                                        <a href="comment.php?approveComment=<?=$c['id']; ?>"><button class="btn-success"><i class="fas fa-check-square"></i> &nbsp;Approve</button></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="table-data-feature1">
                                                        <a href="comment.php?deleteComment=<?= $c['id'];?>"><button class="btn-danger">Delete</button></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="table-data-feature1">
                                                        <a href="../fullpost.php?id=<?=$c['admin_panel_id'];?>" target="_blank"><button class="btn-primary"><i class="fas fa-desktop"></i> &nbsp; Live Preview</button></a>
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
                        <br><br><br>

                        <!-- Approved Comments -->

                        <div class="row">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35">APPROVED COMMENTS</h3>
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Date & Time</th>
                                                <th>Comment</th>
                                                <th>Approved By</th>
                                                <th>Revert Approve</th>
                                                <th>Delet Comment</th>
                                                <th>Details</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php                                                
                                                $querySql="SELECT * FROM comments WHERE status='on' ORDER BY datetime desc";
                                                $executequery=$conn->query($querySql);
                                                $sno=0;
                                                $admin='Tonydis'; //$_SESSION['username'];
                                            ?>
                                            <?php while($a=mysqli_fetch_assoc($executequery)): ?>
                                            <tr class="tr-shadow">
                                                <td><?=++$sno;?></td>
                                                <td class="desc"><?= $a['name']; ?></td>
                                                <td><?=$a['datetime']; ?></td>
                                                <td><?= ((strlen($a['comment'])>1)?substr($a['comment'],0,150).'[..]':$c['comment']) ; ?></td>
                                                <td><?=$a['approved_by']; ?></td>
                                                <td>
                                                    <div class="table-data-feature1">
                                                        <a href="comment.php?disApprove=<?= $a['id']; ?>"><button class="btn-warning"><i class="fas  fa-minus-square"></i> &nbsp; Dis-Approve</button></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="table-data-feature1">
                                                        <a href="comment.php?deleteComment=<?= $a['id']; ?>"> <button class="btn-danger">Delete</button></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="table-data-feature1">
                                                        <a href="../fullpost.php?id=<?= $a['admin_panel_id']; ?>" target="_blank"><button class="btn-primary"><i class="fas fa-desktop"></i> &nbsp; Live Preview</button></a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>
                        </div>

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
