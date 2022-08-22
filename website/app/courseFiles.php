<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="files/images/favicon.png">
    <title>MEBIS - School Management System</title>
    <!-- Custom CSS -->
    <link href="files/css/style.min.css" rel="stylesheet">

</head>

<body class="skin-default-dark fixed-layout">
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <a class="navbar-brand" href="../Student/index.php">
                        <b>
                            <img src="files/images/logo-icon.png" alt="homepage" class="dark-logo" />
                            <img src="files/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                        </b>
                        <span>
                            <img src="files/images/logo-text.png" alt="homepage" class="dark-logo" />
                            <img src="files/images/logo-light-text.png" class="light-logo" alt="homepage" />
                        </span>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"> <a class="nav-link nav-toggler d-block d-sm-none waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>
                        <li class="nav-item">
                            <form class="app-search d-none d-md-block d-lg-block">
                                <input type="text" class="form-control" placeholder="Search & enter">
                            </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item right-side-toggle"> <a class="nav-link  waves-effect waves-light" href="../login.php"><i class="fa fa-power-off"></i></a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <div class="user-profile">
                    <div class="user-pro-body">
                        <div><img src="files/images/users/2.jpg" alt="user-img" class="img-circle"></div>
                        <div class="dropdown">
                            <a href="javascript:void(0)" class="u-dropdown link hide-menu" role="button" aria-haspopup="true" aria-expanded="false"><?php echo (ucfirst($_SESSION['user_name']) . ' ' . ucfirst($_SESSION['user_surname'])) ?></a>
                        </div>
                    </div>
                </div>
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Course
                                    Page
                                    <span class="badge badge-pill badge-cyan ml-auto">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="offeredCourses.php">Offered Courses</a></li>
                                <li><a href="../Student/index.php">Taken Courses</a></li>

                                <li><a href="courseFiles.php">Files</a></li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Student Page</h4>
                    </div>
                </div>
            </div>
            <style>
                .alert-success {
                    color: #00654c;
                    background-color: #ccf3e9;
                    border-color: #b8eee0;
                    position: fixed;
                    right: 0;
                    bottom: 0;
                    z-index: 999;
                }

                .alert-warning {
                    position: fixed;
                    right: 0;
                    bottom: 0;
                    z-index: 999;
                }
            </style>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Course Files Page</h4>
                        <h6 class="card-subtitle">This page can only be seen by students taking the course </h6>
                        <!-- Nav tabs -->


                        <?php
                        require_once('../config.php');
                        include('../database/student.php');
                        if (isset($_POST['drop'])) {
                            dropCourse($_SESSION['user_id'], $_POST['drop']);
                        }
                        $conn = mysqli_connect($server, $user, $password, $database);

                        if (!$conn) {
                            die("Connection failed " . mysqli_connect_error());
                        }

                        $sql = "SELECT DISTINCT course.course_name,course.course_id FROM files INNER JOIN course ON course.course_id=files.course_id WHERE course.registered_student=" . $_SESSION['user_id'];
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {

                                echo '<div class="vtabs customvtab">
                                        <ul class="nav nav-tabs tabs-vertical" role="tablist"><li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#' . $row['course_id'] . '"' .
                                    'role="tab"><span class="hidden-sm-up"><i class="fa fa-download"></i></span> <span' .
                                    'class="hidden-xs-down">' . ucfirst($row['course_name']) . '</span> </a> </li> </ul>';

                                echo '<div class="tab-content">
                                        <div class="tab-pane active" id="' . $row['course_id'] . '" role="tabpanel">
                                            
                                                ' .
                                    getCourseFiles($row['course_id']);
                                '.
                                            
                                        </div>
        
                                    </div>';
                            }
                            echo "</table>";
                        } else {
                            echo "NO REGISTERED COURSE FOUND";
                        }
                        mysqli_close($conn);
                        ?>
                        <!-- Tab panes -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .nav-tabs .nav-item {
            margin-bottom: -1px;
            padding-top: 20px;
        }

        .nav-tabs {
            border-bottom: 1px solid #4f5467;
            margin-bottom: 13px;
        }

        .materials1 {
            padding-left: 30px;
            color: green;
            font-size: 16px;
        }
    </style>
    </div>

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!--Menu sidebar -->
    <script src="files/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="files/js/custom.min.js"></script>
</body>

</html>