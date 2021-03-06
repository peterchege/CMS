<?php
require_once('inc/db.php');
require_once('inc/sessions.php');
require_once('inc/functions.php');

confirm_login();

if (!isset($_GET['delete']) || empty($_GET['delete'])) {
    $_SESSION['Message'] = 'Invalid request.';
    redirect_to('index.php');
} else {
    $delete_id = $_GET['delete'];
    //Delete selected post
    if (isset($_POST['deletePost'])) {
        $deleteImage = $conn->query("SELECT * FROM media_centre_posts WHERE id = '$delete_id' ");
        $deleteImage = mysqli_fetch_assoc($deleteImage);
        unlink($deleteImage['image']);
        $query = "DELETE FROM media_centre_posts WHERE id='$delete_id'";
        $delete = $conn->query($query);
        if ($delete) {
            $_SESSION['SuccessMessage'] = "Post deleted successfully.";
            redirect_to('index.php');
        } else {
            $_SERVER['errorMessage'] = 'Post already deleted.';
            redirect_to('index.php');
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="Peter Chege" />
    <meta name="keywords" content="" />

    <!-- Title Page-->
    <title>Delete Post</title>

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

    <!-- ckeditor -->
    <script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
</head>

<body class="">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.php">
                            <img style="width:25%; margin-top:10px;" src="images/logon.png" alt="apallo group" />
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
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img style="width:40%; margin-left:40px; margin-top:0px;" src="images/logon.png" alt="apollo group" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a class="js-arrow" href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>

                        <li class="active has-sub">
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
                                <!-- <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                    <button class="au-btn--submit" type="submit">
                                        <i class="zmdi zmdi-search"></i>
                                    </button> -->
                            </form>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/apa_insurance_image_facebook.png" alt="John Doe" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $_SESSION['username']; ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/apa_insurance_image_facebook.png" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name"><a href="#"><?php echo $_SESSION['username']; ?></a></h5>
                                                    <span class="email"><?php echo $_SESSION['email']; ?></span>
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
                        <div class="col-md-10 offset-md-1">
                            <div class="card">

                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Delete Post</h3>
                                        <?php
                                        echo Message();
                                        echo SuccessMessage();
                                        ?>
                                    </div>
                                    <hr />
                                    <!-- Getting info based on edit id -->
                                    <?php
                                    $delete_id = $_GET['delete'];
                                    $searchQuery = "SELECT * FROM media_centre_posts where id='$delete_id' ";
                                    $runn = $conn->query($searchQuery);
                                    ?>
                                    <?php while ($e = mysqli_fetch_assoc($runn)) : ?>
                                        <form action="deletepost.php?delete=<?php echo $delete_id; ?>" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Title</label>
                                                <input id="cc-pament" name="title" value="<?php echo $e['title']; ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" />
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">Category</label>
                                                <select name="category" id="select" class="form-control">
                                                    <option disabled selected value="0">Please select</option>
                                                    <?php
                                                        // extracting category data
                                                        $queryCategory = "SELECT * from media_centre_categories";
                                                        $run = $conn->query($queryCategory);
                                                        ?>
                                                    <?php while ($c = mysqli_fetch_assoc($run)) : ?>
                                                        <option <?php echo (($c['name'] == $e['category']) ? 'selected' : ''); ?>>
                                                            <?php echo $c['name']; ?>
                                                        </option>
                                                    <?php endwhile; ?>
                                                </select>
                                                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                                <br />
                                                <div class="form-group">
                                                    <label for="cc-number" class="control-label mb-1">Existing Image</label>
                                                    <img src="<?php echo $e['image']; ?>" id="file-input" name="image" class="form-control-file" style="width:30vw; height:50vh;" />
                                                </div>
                                                <br />
                                                <br />
                                                <div class="row">
                                                    <div class="col col-md-12">
                                                        <label for="textarea-input" class=" form-control-label">Post</label>
                                                    </div>
                                                    <div class="col-12 col-md-12">
                                                        <textarea name="post" id="content" rows="9" placeholder="Content..." class="form-control"><?php echo $e['post']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div>
                                                    <br />
                                                    <button name="deletePost" id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                        <span id="payment-button-amount">Delete Post</span>
                                                    </button>
                                                </div>
                                        </form>
                                    <?php endwhile; ?>
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

    <!-- ckeditor -->
    <script>
        CKEDITOR.replace('content', {
            height: 300,
            filebrowserUploadUrl: "upload.php"
        });
    </script>
</body>

</html>
<!-- end document-->