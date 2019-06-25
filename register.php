<?php
require_once('inc/db.php');
require_once('inc/sessions.php');
require_once('inc/functions.php');

if (isset($_POST['register'])) {
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    $confirm_password = test_input($_POST['confirm_password']);
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $_SESSION['ErrorMessage'] = "All fields are required.";
    } else {
        if (strlen($password) < 5 || strlen($confirm_password) < 5) {
            $_SESSION['ErrorMessage'] = 'Password should have at least 5 characters.';
        }
        if ($password !== $confirm_password) {
            $_SESSION['ErrorMessage'] = 'Passwords do not match.';
        } else {
            if (isset($_SESSION['invite_token'])) {
                $invite_token = $_SESSION['invite_token'];
                $password = password_hash($password, PASSWORD_DEFAULT);
                $query = "UPDATE media_centre_admin_registration SET username = '$username', password = '$password' WHERE invite_token = '$invite_token' ";
                $execute = $conn->query($query);
                if ($execute) {
                    $_SESSION['SuccessMessage'] = 'Account created successfully. Please login.';
                    unset($_SESSION['invite_token']);
                    redirect_to('login.php');
                } else {
                    $_SESSION['ErrorMessage'] = 'Invalid invite token.';
                }
            } else {
                redirect_to('login.php');
            }
        }
    }
} else {
    if (!isset($_GET['invite_token'])) {
        $_SESSION['ErrorMessage'] = 'Invalid token.';
        redirect_to('login.php');
    } else {
        if (empty($_GET['invite_token'])) {
            $_SESSION['ErrorMessage'] = 'Invalid token.';
            redirect_to('login.php');
        } else {
            $_SESSION['invite_token'] = $_GET['invite_token'];
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
    <meta name="description" content="au theme template" />
    <meta name="author" content="PETER CHEGE " />
    <meta name="keywords" content="" />

    <!-- Title Page-->
    <title>Register</title>

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

<body class="animsition bg-back">
    <div class="page-wrapper page-wrapper1">
        <div class="page-content--bge1">
            <div class="container">
                <div class="login-wrap ">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img class="logo1" src="images/logon.png" alt="APollo Group" />
                            </a>
                        </div>
                        <div class="login-form">
                            <?php
                            echo Message();
                            echo SuccessMessage();
                            if (!empty($errors))
                                echo display_errors($errors);
                            ?>
                            <form class="media-form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <div class="form-group">
                                    <p class="form-group">Please register your account below:</p>
                                    <label>Username</label>
                                    <input class="au-input au-input--full" type="text" name="username" placeholder="" />
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="" />
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input class="au-input au-input--full" type="password" name="confirm password" placeholder="" />
                                </div>
                                <br />
                                <br />
                                <br />
                                <button name="register" class="au-btn au-btn--block au-btn--green m-b-20" type="submit">
                                    Create Account
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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