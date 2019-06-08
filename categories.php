<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/unitedpicturesblog/inc/db.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/unitedpicturesblog/inc/sessions.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/unitedpicturesblog/inc/functions.php';
    
    confirm_login();
    if(isset($_POST['submitCategory'])){
      $category=test_input($_POST['categoryName']);
      date_default_timezone_set("Africa/Nairobi");
      $currentTime=time();
      $dateTime=strftime("%d,%B %Y %H:%M:%S",$currentTime);
      $dateTime;
      $admin=$_SESSION['username'];
        $admin_email=$_SESSION['email'];
      if(empty($category)){
          $_SESSION['ErrorMessage']="Please enter a category. It can't be empty";
          //redirect_to("categories.php");
      }elseif(strlen($category)>99){
          $_SESSION['ErrorMessage']="The name of the category you entered is too long";
          //redirect_to("categories.php");
      }else{
          $query="INSERT INTO categories(`datetime`,`name`,creatorname,email) VALUES('$dateTime','$category','$admin','$admin_email')";
          $conn->query($query);
          $_SESSION['SuccessMessage']="New category entered successfully";
      }
  }

  // Delete  category
  if(isset($_GET['delete'])){
    $delete_id=$_GET['delete'];
    $deleteQuery="DELETE FROM categories WHERE id='$delete_id'";
    $deleteQueryExecute=$conn->query($deleteQuery);
    if($deleteQueryExecute){        
        $_SESSION['SuccessMessage']='Category deleted successfully';
    }else{
        $_SESSION['Message']='Something went terribly wrong. Please try again';
    }
}

  //Extracting category data
 $extract="SELECT * FROM categories ORDER BY datetime desc";
 $run=$conn->query($extract);
 $SrNo=0;
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
                            <a href="newpost.php"> <i class="fas fa-chart-bar"></i>New Post</a>
                        </li>
                        <li>
                            <a href="categories.php"> <i class="fas fa-table"></i>Categories</a>
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
                        <li class="active has-sub">
                            <a href="categories.php"> <i class="fas fa-tags"></i>Categories</a>
                        </li>

                        <li class="has-sub">
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
                                                <a href="logout.php"> <i class="zmdi zmdi-power"></i>Logout</a>
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
                                <div class="card-header overview-item--c5">
                                    <h1>Add Category </h1>
                                </div>
                                <div class="card-body">
                                    <div class="card-title">

                                    </div>
                                    <form action="categories.php" method="post" novalidate="novalidate">
                                        <div class="form-group">
                                            <?php
                                          echo Message();
                                          echo SuccessMessage();
                                        ?>
                                            <label for="cc-payment" class="control-label mb-1">Name</label><br>
                                            <input id="cc-pament" name="categoryName" type="text" class="form-control" aria-required="true" aria-invalid="false" value="<?=((isset($category))?$category:''); ?>" />
                                        </div>
                                        <br>

                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block" name="submitCategory">
                                            <span id="payment-button-amount">Add New category</span>
                                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <!-- USER DATA-->
                                <div class="user-data m-b-30">
                                    <h3 class="title-3 m-b-30"><i class="zmdi zmdi-account-calendar"></i>Manage Category</h3>
                                    <div class="table-responsive table-data">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>Sr No.</td>
                                                    <td>Date & Time</td>
                                                    <td>Category Name</td>
                                                    <td> Creator Name</td>
                                                    <td>Action</td>
                                                    <td></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  while($t=mysqli_fetch_assoc($run)): ?>
                                                <tr>
                                                    <td>
                                                        <?=++$SrNo?>
                                                    </td>
                                                    <td>
                                                        <?=$t['datetime'];?>
                                                    </td>
                                                    <td>
                                                        <?=$t['name'];?>
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6><?=$t['creatorname'];?></h6>
                                                            <span>
                                                                <a href=""><?= $t['email']; ?> </a>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="table-data-feature1">
                                                            <a href="categories.php?delete=<?=test_input($t['id']);?>"><button class="btn-danger"><i class="fas fa-ban flex-left"></i> Delete</button></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="user-data__footer">
                                        <button class="au-btn au-btn-load">load more</button>
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
