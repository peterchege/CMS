<?php
require_once('inc/db.php');
require_once('inc/sessions.php');
require_once('inc/functions.php');


confirm_login();
if (isset($_POST['submitNewAdmin'])) {
    $email = test_input($_POST['email']);
    $currentTime = time();
    $dateTime = strftime("%d, %B %Y %H:%M:%S", $currentTime);
    $dateTime;
    $admin = $_SESSION['username'];

    //checking if admin already exists
    $adminQuery = "SELECT * FROM media_centre_admin_registration WHERE email = '$email'";
    $adminQueryExecute = $conn->query($adminQuery);

    if (empty($email)) {
        $errors[] = "Admin email is required.";
    } elseif (mysqli_num_rows($adminQueryExecute) > 0) {
        $errors[] = "The email of the admin already exists. Choose another one.";
    } else {
        //send reset email
        require_once 'mailer/PHPMailer.php';
        require_once 'mailer/SMTP.php';
        $invite_token = bin2hex(openssl_random_pseudo_bytes(40));

        $mail = new PHPMailer;
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->isHTML(true);
        $mail->Host = 'mail.apainsurance.ke';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'anthony.baru@apollo.co.ke';                 // SMTP username
            $mail->Password = 'Abaru1!';                           // SMTP password
            //$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom('anthony.baru@apollo.co.ke', 'Tony Invite ');
        $mail->addAddress("{$email}");     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo('no-reply@apollo.co.ke', 'No reply');
        $mail->addBCC('scarletjasmine3@gmail.com');

        //$mail->addBCC("{$email}");
        //$mail->addBCC("{$email}");
        $mail->Subject = 'INVITATION LINK.';

        // Program to display URL of current page.

        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $link = "https";
        } else {
            $link = "http";
        }

        // Here append the common URL characters.
        $link .= "://";

        // Append the host(domain name, ip) to the URL.
        //$link .= $_SERVER['HTTP_HOST'];

        // Append the requested resource location to the URL
        //$link .= $_SERVER['SERVER_NAME'];

        $mail->Body    = 'You have been invited to be an Admin of APA INSURANCE MEDIA CENTRE AND CSR CMS. Please click the link to create your account: </br>' . $link . $_SERVER['HTTP_HOST'] . '/cms/register.php?invite_token=' . $invite_token . '';

        if ($mail->send()) {
            $query = "INSERT INTO media_centre_admin_registration(`datetime`,`invite_token`, email,`added by`) VALUES('$dateTime','$invite_token','$email','$admin')";
            $conn->query($query);
            //echo 'Email sent successfully to ' . $email;
            $_SESSION['SuccessMessage'] = 'Activation link sent successfully to: ' . $email . '.';
        } else {
            $_SESSION['ErrorMessage'] = 'Something went wrong. Please try again. Activation link not sent.';
        }
        // {
        //     $_SESSION['ErroMessage'] = "Something went wrong. Please try again.";
        // }
    }
}

// Delete admin
if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_id = htmlentities($delete_id);
    $deleteQuery = "DELETE FROM media_centre_admin_registration WHERE id='$delete_id'";
    $deleteQueryExecute = $conn->query($deleteQuery);
    if ($deleteQueryExecute) {
        $_SESSION['SuccessMessage'] = 'Admin deleted successfully.';
    } else {
        $_SESSION['Message'] = 'Something went terribly wrong. Please try again.';
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
                        <!-- <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>Comment</a>

                        </li> -->
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

                        <li>
                            <a href="newpost.php">
                                <i class="fas  fa-list-alt"></i>New Post</a>
                        </li>

                        <li>
                            <a href="categories.php">
                                <i class="fas fa-tags"></i>Categories</a>
                        </li>

                        <li class="active has-sub">
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
                        <div class="col-md-8 offset-md-2">

                            <div class="card">
                                <div class="card-header">Add Admin</div>
                                <div class="card-body card-block">
                                    <form action="" method="post" class="new-user">
                                        <?php
                                        echo Message();
                                        echo SuccessMessage();
                                        if (!empty($errors)) {
                                            echo display_errors($errors);
                                        }
                                        ?>
                                        <div class="form-group">
                                            <label class="control-label mb-1 labd">Email</label><br>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                                <input type="email" id="email" name="email" placeholder="Email" class="form-control" value="<?php echo((isset($email)) ? $email : ''); ?>">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-actions form-group">
                                            <button name="submitNewAdmin" id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount">Invite Admin</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <!-- USER DATA-->
                            <div class="user-data m-b-30">
                                <h3 class="title-3 m-b-30">
                                    <i class="zmdi zmdi-account-calendar"></i>Manage Admins</h3>
                                <div class="table-responsive table-data">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td>Sr No.</td>
                                                <td>Date & Time Added</td>
                                                <td>Admin Credentials</td>
                                                <td>Added by</td>
                                                <td>Action</td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //Extracting admin data
                                            $extract = "SELECT * FROM media_centre_admin_registration ORDER BY datetime desc";
                                            $run = $conn->query($extract);
                                            $SrNo = 0;
                                            ?>
                                            <?php while ($a = mysqli_fetch_assoc($run)) :  ?>
                                                <tr>
                                                    <td>
                                                        <?php echo ++$SrNo; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $a['datetime']; ?>
                                                    </td>
                                                    <td>
                                                        <div class="table-data__info">
                                                            <h6><?php echo $a['username']; ?></h6>
                                                            <span>
                                                                <a><?php echo $a['email']; ?></a>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?php echo $a['added by']; ?>
                                                    </td>
                                                    <td>
                                                        <div class="table-data-feature1">
                                                            <a href="manage_admin.php?delete=<?php echo $a['id']; ?>"><button class="btn-danger"><i class="fas fa-ban"></i> Delete</button></a>
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