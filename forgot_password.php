<?php
require_once('inc/db.php');
require_once('inc/sessions.php');
require_once('inc/functions.php');

if (isset($_POST['submitReset'])) {
    $usernameEmail = test_input($_POST['usernameEmail']);
    if (empty($usernameEmail)) {
        $errors[] = 'Email is required';
    } else {
        // check if user email exists in the database
        $emailCheckExist = $conn->query("SELECT * FROM media_centre_admin_registration WHERE email = '$usernameEmail' ");
        $resetRecepient = mysqli_fetch_assoc($emailCheckExist);
        if (mysqli_num_rows($emailCheckExist) !== 1) {
            $errors[] = 'The email you entered does not exist in our database.';
        } else {
            // generate reset token
            $token = bin2hex(openssl_random_pseudo_bytes(40));

            //insert token into database
            $updateToken = $conn->query("UPDATE media_centre_admin_registration SET password_reset_token = '$token' WHERE email = '$usernameEmail' ");

            //send reset email
            require_once 'mailer/PHPMailer.php';
            require_once 'mailer/SMTP.php';

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->isHTML(true);
            $mail->SMTPDebug = 0;
            $mail->Debugoutput = 'echo';
            $mail->Host = 'mail.apainsurance.org';
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->Username = 'apa.website@apollo.co.ke';
            $mail->Password = 'Apa321$321';

            $mail->setFrom('anthony.baru@apollo.co.ke', 'Tony Dev ');
            $mail->addAddress("{$usernameEmail}", $resetRecepient['username']);     // Add a recipient
            //$mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('no-reply@apollo.co.ke', 'No reply');
            $mail->addBCC('scarletjasmine3@gmail.com');

            //$mail->addBCC("{$email}");
            //$mail->addBCC("{$email}");
            $mail->Subject = 'Reset Account Link.';

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

            $mail->Body    = 'Please click the link to reset your password: ' . $link . $_SERVER['HTTP_HOST'] . '/cms/reset_password.php?password_reset_token=' . $token . '';

            if ($mail->send()) {
                //echo 'Email sent successfully to ' . $email;
                $_SESSION['SuccessMessage'] = 'Reset link sent successfully. Check your email (' . $usernameEmail . ').';
                redirect_to('login.php');
            } else {
                $_SESSION['ErrorMessage'] = 'Something went wrong. Please try again. Activation link not sent.';
            }
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
    <title>Forgot Password</title>

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
                            <form class="media-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <div class="form-group">
                                    <label>Enter your email address to receive reset link.</label>
                                    <br>
                                    <input class="au-input au-input--full" type="email" name="usernameEmail" placeholder="Email" required />
                                </div>
                                <br />
                                <div class="login-checkbox">
                                </div>
                                <br />
                                <br />
                                <button name="submitReset" class="au-btn au-btn--block au-btn--green m-b-20" type="submit">
                                    Send Link
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