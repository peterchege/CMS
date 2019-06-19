<?php
require_once('inc/db.php');
require_once('inc/sessions.php');
require_once('inc/functions.php');

if (isset($_POST['resetPassword'])) {
    $password = test_input($_POST['password']);
    $confirm_password = test_input($_POST['confirm_password']);

    if (empty($password) || empty($confirm_password)) {
        $errors[] = 'All fields are required.';
    } else {
        if (strlen($password) < 6 || strlen($confirm_password) < 6) {
            $errors[] = 'Password should be greater than 5 characters.';
        }
        if ($password != $confirm_password) {
            $errors[] = 'The passwords you entered do not match.';
        } else {
            if (empty($errors)) {
                // encrypt password
                $password = password_hash($password, PASSWORD_DEFAULT);
                // run update query
                $password_reset_token = $_SESSION['password_reset_token'];
                $updateQuery = "UPDATE media_centre_admin_registration SET `password`='$password' WHERE password_reset_token = '$password_reset_token' ";
                $query = $conn->query($updateQuery);
                unset($_SESSION['password_reset_token']);
                $_SESSION['SuccessMessage'] = 'Password updated successfully. Please Login.';
                redirect_to('login.php');
            } else {
                $errors[] = 'An error occurred. Please try again.';
            }
        }
    }
}

if (!isset($_SESSION['password_reset_token'])) {
    if (!isset($_GET['password_reset_token'])) {
        $_SESSION['ErrorMessage'] = 'Invalid Access.';
        redirect_to('login.php');
    } else {
        if (empty($_GET['password_reset_token'])) {
            $_SESSION['ErrorMessage'] = 'Invalid Access.';
            redirect_to('login.php');
        } else {
            $password_reset_token = $_GET['password_reset_token'];
            $_SESSION['password_reset_token'] = $_GET['password_reset_token'];
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
    <title>Reset Password</title>

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
                            if (!empty($errors)) {
                                echo display_errors($errors);
                            }
                            ?>
                            <form class="media-form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <div class="form-group">
                                    <label>New Password<label>
                                            <input class="au-input au-input--full" type="password" name="password" placeholder="" />
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input class="au-input au-input--full" type="password" name="confirm_password" placeholder="" />
                                </div>
                                <br />
                                <div class="login-checkbox">
                                </div>
                                <br />
                                <br />
                                <button name="resetPassword" class="au-btn au-btn--block au-btn--green m-b-20" type="submit">
                                    Update Password
                                </button>
                            </form>
                        </div>
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