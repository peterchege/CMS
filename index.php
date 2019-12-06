<?php
require_once 'inc/db.php';
require_once 'inc/sessions.php';
require_once 'inc/functions.php';

confirm_login();
// show/hiding posts
// showing
if (isset($_GET['show'])) {
    $show_id = sanitize($_GET['show']);
    $conn->query("UPDATE media_centre_posts SET status = 1 WHERE id = '$show_id' ");
    if ($conn) {
        $_SESSION['SuccessMessage'] = 'Post shown successfully.';
    } else {
        $_SESSION['ErrorMessage'] = 'An error occurred. Please try again.';
    }
}

if (isset($_GET['hide'])) {
    $hide_id = sanitize($_GET['hide']);
    $conn->query("UPDATE media_centre_posts SET status = 0 WHERE id ='$hide_id' ");
    if ($conn) {
        $_SESSION['SuccessMessage'] = 'Post hidden successfully.';
    } else {
        $_SESSION['ErrorMessage'] = 'An error occurred. Please try again.';
    }
}
//dashboard table information
$viewQuery = "SELECT * FROM media_centre_posts ORDER BY id desc ";
$execute = $conn->query($viewQuery);
$sno = 0;

//image preview display
if ($_SERVER['DOCUMENT_ROOT'] == 'C:/xampp/htdocs') {
    $preview_path = 'http://localhost/apainsurance';
} else {
    $preview_path = 'http://63.33.193.137';
}

//deleting irrelevant images
$images = glob("images/posts/*.*");
foreach ($images as $image) {
    $sql = mysqli_query($conn, "SELECT `image` FROM media_centre_posts WHERE `image`='$image' ");
    if (mysqli_num_rows($sql) == 0) {
        unlink($image);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Peter Chege">
    <meta name="keywords" content="">

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
                            <a class="js-arrow" href="manage_admin.php">
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
                <a href="index.php">
                    <img style="width:40%; margin-left:40px; margin-top:0px;" src="images/logon.png" alt="apollo group" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
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
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <?php
                                    echo Message();
                                    echo SuccessMessage();
                                    ?>
                                    <h2 class="title-1">overview</h2>
                                    <a href="manage_admin.php"><button class="au-btn au-btn-icon au-btn--blue2">
                                            <i class="zmdi zmdi-plus"></i>add user</button></a>
                                </div>
                            </div>

                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <h2>
                                                    <?php
                                                    $adminNo = $conn->query("SELECT * FROM media_centre_admin_registration");
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
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-shopping-cart"></i>
                                            </div>
                                            <div class="text">
                                                <h2>
                                                    <?php
                                                    $postsNo = $conn->query("SELECT * FROM media_centre_posts");
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
                            <div class="col-sm-6 col-lg-4">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-calendar-note"></i>
                                            </div>
                                            <div class="text">
                                                <h2>
                                                    <?php
                                                    $categoryNo = $conn->query("SELECT * FROM media_centre_categories");
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
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <h3 class="title-5 m-b-35">Posts table</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-right">
                                        <a href="<?php echo 'newpost.php'; ?>"><button class="au-btn au-btn-icon au-btn--green au-btn--small pull-right"><i class="zmdi zmdi-plus"></i>add post</button></a>
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
                                                <th>Action</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php while ($t = mysqli_fetch_assoc($execute)) : ?>
                                                <tr class="tr-shadow">
                                                    <td><?php echo ++$sno; ?></td>
                                                    <td><?php echo $t['title']; ?></td>
                                                    <td><?php echo $t['datetime']; ?></td>
                                                    <td class="desc"><?php echo $t['author']; ?></td>
                                                    <td><?php echo $t['category']; ?></td>
                                                    <td>
                                                        <span class="status--process"><img style="max-width:20vh; max-height:10%;" src="<?php echo $t['image']; ?>" /></span>
                                                    </td>
                                                    <td>
                                                        <div class="table-data-feature">
                                                            <?php if ($t['status'] == 0) : ?>
                                                                <a href="index.php?show=<?php echo $t['id']; ?>"><button class="btn-success">Show</button></a>
                                                            <?php else : ?>
                                                                <a href="index.php?hide=<?php echo $t['id']; ?>"><button class="btn-primary">Hide</button></a>
                                                            <?php endif; ?>
                                                            <a href="editpost.php?edit=<?php echo $t['id']; ?>"><button class="btn-success">Edit</button></a>
                                                            <a href="deletepost.php?delete=<?php echo $t['id']; ?>"><button class="btn-danger">Delete</button></a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="table-data-feature">
                                                            <a href="<?php echo $preview_path . '/media_centre_detail.php?post=' . $t['id']; ?>" target="_blank"><button class="btn-primary"><i class="fas fa-desktop"></i> &nbsp; Live Preview</button></a>
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
                        </div><br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © <?php echo date('Y'); ?> APA INSURANCE. All rights reserved.</p>
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
    <?php
    $month = array();
    $row_result = array();
    $posts_results = array();
    $category_results = array();
    for ($m = 1; $m <= date('m'); ++$m) {
        $month_names = date('F', mktime(0, 0, 0, $m, 1));
        $month_nums = date('m', mktime(0, 0, 0, $m, 1));
        $admin = mysqli_query($conn, "SELECT * FROM media_centre_admin_registration  WHERE MONTH(date_added) = '$month_nums' ");
        $posts = mysqli_query($conn, "SELECT * FROM media_centre_posts  WHERE MONTH(date_added) = '$month_nums' ");
        $categories = mysqli_query($conn, "SELECT * FROM media_centre_categories  WHERE MONTH(date_added) = '$month_nums'");
        $rows = mysqli_num_rows($admin);
        $posts_rows = mysqli_num_rows($posts);
        $category_rows = mysqli_num_rows($categories);
        $month_array = " ' " . $month_names . " ' ";
        $rows_array = "  " . $rows . "  ";
        $posts_rows_array = "  " . $posts_rows . "  ";
        $category_array = "  " . $category_rows . "  ";
        array_push($month, $month_array);
        array_push($row_result, $rows_array);
        array_push($posts_results, $posts_rows_array);
        array_push($category_results, $category_array);
    }
    $month_implode = implode(',', $month);
    $row_result_implode = implode(',', $row_result);
    $posts_row_results_implode = implode(',', $posts_results);
    $category_row_implode = implode(',', $category_results);

    ?>
    <script>
        //WidgetChart 1
        var ctx = document.getElementById("widgetChart1");
        if (ctx) {
            ctx.height = 130;
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [<?php echo $month_implode; ?>],
                    type: 'line',
                    datasets: [{
                        data: [<?php echo $row_result_implode; ?>],
                        label: 'Admins added',
                        backgroundColor: 'rgba(255,255,255,.1)',
                        borderColor: 'rgba(255,255,255,.55)',
                    }, ]
                },
                options: {
                    maintainAspectRatio: true,
                    legend: {
                        display: false
                    },
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 0,
                            bottom: 0
                        }
                    },
                    responsive: true,
                    scales: {
                        xAxes: [{
                            gridLines: {
                                color: 'transparent',
                                zeroLineColor: 'transparent'
                            },
                            ticks: {
                                fontSize: 2,
                                fontColor: 'transparent'
                            }
                        }],
                        yAxes: [{
                            display: false,
                            ticks: {
                                display: false,
                            }
                        }]
                    },
                    title: {
                        display: false,
                    },
                    elements: {
                        line: {
                            borderWidth: 0
                        },
                        point: {
                            radius: 0,
                            hitRadius: 10,
                            hoverRadius: 4
                        }
                    }
                }
            });
        }

        //WidgetChart 2
        var ctx = document.getElementById("widgetChart2");
        if (ctx) {
            ctx.height = 130;
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [<?php echo $month_implode; ?>],
                    type: 'line',
                    datasets: [{
                        data: [<?php echo $posts_row_results_implode ?>],
                        label: 'Posts added',
                        backgroundColor: 'transparent',
                        borderColor: 'rgba(255,255,255,.55)',
                    }, ]
                },
                options: {

                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    responsive: true,
                    tooltips: {
                        mode: 'index',
                        titleFontSize: 12,
                        titleFontColor: '#000',
                        bodyFontColor: '#000',
                        backgroundColor: '#fff',
                        titleFontFamily: 'Montserrat',
                        bodyFontFamily: 'Montserrat',
                        cornerRadius: 3,
                        intersect: false,
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                color: 'transparent',
                                zeroLineColor: 'transparent'
                            },
                            ticks: {
                                fontSize: 2,
                                fontColor: 'transparent'
                            }
                        }],
                        yAxes: [{
                            display: false,
                            ticks: {
                                display: false,
                            }
                        }]
                    },
                    title: {
                        display: false,
                    },
                    elements: {
                        line: {
                            tension: 0.00001,
                            borderWidth: 1
                        },
                        point: {
                            radius: 4,
                            hitRadius: 10,
                            hoverRadius: 4
                        }
                    }
                }
            });
        }


        //WidgetChart 3
        var ctx = document.getElementById("widgetChart3");
        if (ctx) {
            ctx.height = 130;
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [<?php echo $month_implode; ?>],
                    type: 'line',
                    datasets: [{
                        data: [<?php echo $category_row_implode; ?>],
                        label: 'Categories added',
                        backgroundColor: 'transparent',
                        borderColor: 'rgba(255,255,255,.55)',
                    }, ]
                },
                options: {

                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    responsive: true,
                    tooltips: {
                        mode: 'index',
                        titleFontSize: 12,
                        titleFontColor: '#000',
                        bodyFontColor: '#000',
                        backgroundColor: '#fff',
                        titleFontFamily: 'Montserrat',
                        bodyFontFamily: 'Montserrat',
                        cornerRadius: 3,
                        intersect: false,
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                color: 'transparent',
                                zeroLineColor: 'transparent'
                            },
                            ticks: {
                                fontSize: 2,
                                fontColor: 'transparent'
                            }
                        }],
                        yAxes: [{
                            display: false,
                            ticks: {
                                display: false,
                            }
                        }]
                    },
                    title: {
                        display: false,
                    },
                    elements: {
                        line: {
                            borderWidth: 1
                        },
                        point: {
                            radius: 4,
                            hitRadius: 10,
                            hoverRadius: 4
                        }
                    }
                }
            });
        }
    </script>


</body>

</html>
<!-- end document-->