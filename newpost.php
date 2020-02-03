<?php
require_once('inc/db.php');
require_once('inc/sessions.php');
require_once('inc/functions.php');

confirm_login();

//adding new post
if (isset($_POST['submitPost'])) {
    $title = test_input($_POST['title']);
    $title = strtoupper($title);
    $title = test_input($title);
    @$category = test_input($_POST['category']);
    $post = sanitize($_POST['post']);

    $currentTime = time();
    $dateTime = strftime("%d,%B %Y %H:%M:%S", $currentTime);
    $dateTime;
    $admin = ucfirst($_SESSION['username']);

    //image validation
    $photoFullname = $_FILES['image']['name'];
    if ($photoFullname) {
        $filetype = $_FILES['image']['type'];
        $photoFullnameExploded = explode('.', $photoFullname);
        $photoName = $photoFullnameExploded[0];
        $photoName = md5($photoName);
        $photoExt = $photoFullnameExploded[1];
        $fullPhotoName = $photoName . '.' . $photoExt;
        $photoUploadPath = 'images/posts/';
        $tmp_loc = $_FILES['image']['tmp_name'];
        if ($_SERVER['DOCUMENT_ROOT'] == 'C:/xampp/htdocs') {
            $target = $_SERVER['DOCUMENT_ROOT'] . "/cms/images/posts/" . $fullPhotoName;
        } else {
            $target = $_SERVER['DOCUMENT_ROOT'] . "/cms/images/posts/" . $fullPhotoName;
        }

        $pathandNameOfFile = $photoUploadPath . $fullPhotoName;
    }


    if (empty($title) || empty($category)) {
        $errors[] = "Title and Category can't be empty.";
    } else {
        if (strlen($title) < 2) {
            $errors[] = "Title should be at least two characters.";
        }
    }

    if (empty($photoFullname)) {
        $errors[] = "Please select a valid image.";
    } else {
        if ($filetype != 'image/jpeg' && $filetype != 'image/png' && $filetype != 'image/gif' && $filetype != 'image/jpg') {
            $errors[] = "Image must be of the type jpeg, jpg, png or gif.";
        }
    }

    if (empty($post)) {
        $errors[] = "Post content is required.";
    }
    if (empty($errors)) {
        if (move_uploaded_file($tmp_loc, $target)) {
            $query = "INSERT INTO media_centre_posts(`datetime`,title,category,author,`image`,post) 
            VALUES('$dateTime','$title','$category','$admin','$pathandNameOfFile','$post')";
            $conn->query($query);
            $_SESSION['SuccessMessage'] = "New post entered successfully.";
            redirect_to('index.php');
        } else {
            $_SESSION['ErrorMessage'] = "Error uploading file: " . $_FILES["file"]["error"];
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
    <title>Add New Post</title>

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

    <style></style>

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
                            <a class="js-arrow" href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>

                        </li>
                        <li>
                            <a href="newpost.php">
                                <i class="fas fa-chart-bar"></i>New Post</a>
                        </li>
                        <li>
                            <a href="categories.php">
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
                                <i class="fas fa-tachometer-alt"></i>Dashboard
                            </a>
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
                                        <h3 class="text-center title-2">Create Post</h3>
                                        <?php
                                        echo Message();
                                        echo SuccessMessage();
                                        if (!empty($errors)) {
                                            echo display_errors($errors);
                                        }
                                        ?>
                                    </div>
                                    <hr />
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Title</label>
                                            <input id="cc-pament" name="title" value="<?php echo ((isset($title)) ? $title : ''); ?>" type="text" class="form-control" aria-required="true" aria-invalid="false" />
                                        </div>
                                        <div class="form-group has-success">
                                            <label for="cc-name" class="control-label mb-1">Category</label>
                                            <select name="category" id="select" class="form-control" required>
                                                <option disabled selected>Please select</option>
                                                <?php
                                                //Extracting category data
                                                $extract = "SELECT * FROM media_centre_categories ORDER BY datetime desc";
                                                $run = $conn->query($extract);
                                                $SrNo = 0;
                                                ?>
                                                <?php while ($c = mysqli_fetch_assoc($run)) : ?>
                                                    <option <?php echo ((isset($category) && $category == $c['name']) ? 'selected' : ''); ?>>
                                                        <?php echo $c['name']; ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                            <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                        </div>
                                        <br />
                                        <div class="form-group">
                                            <label for="cc-number" class="control-label mb-1">Upload Post Image</label>
                                            <input type="file" id="file-input" name="image" class="form-control-file" required /> </div>
                                        <br />
                                        <div class="row">
                                            <div class="col col-md-12">
                                                <label for="textarea-input" class=" form-control-label">Post</label>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <textarea name="post" id="content" rows="20" placeholder="Content..." class="form-control ckeditor"><?php echo ((isset($post)) ? $post : '') ?></textarea>
                                            </div>
                                        </div>
                                        <div>
                                            <br />
                                            <button name="submitPost" id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount">Add New Post</span>
                                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                                            </button>
                                        </div>
                                    </form>
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
    <!-- <script src="vendor/select2/select2.min.js"></script> -->

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