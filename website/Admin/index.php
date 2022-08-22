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
    <title>ADMIN - School Management System</title>
    <!-- Custom CSS -->
    <link href="../app/files/css/style.min.css" rel="stylesheet">


</head>

<body class="skin-default-dark fixed-layout">
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./index.php">
                        <img src="../app/files/images/logo-icon.png" alt="homepage" class="dark-logo" />
                        <img src="../app/files/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                        </b>
                        <span>
                            <img src="../app/files/images/logo-text.png" alt="homepage" class="dark-logo" />
                            <img src="../app/files/images/logo-light-text.png" class="light-logo" alt="homepage" />
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
                        <div><img src="../app/files/images/users/3.jpg" alt="user-img" class="img-circle"></div>
                        <a href="javascript:void(0)" class="u-dropdown link hide-menu" role="button" aria-haspopup="true" aria-expanded="false"><?php echo (ucfirst($_SESSION['user_name']) . ' ' . ucfirst($_SESSION['user_surname'])) ?></a>
                    </div>
                </div>

                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Select Option
                                </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="./schools.php">Manage Schools</a></li>
                                <li><a href="./index.php">Add - Show Schools</a></li>
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
                        <h4 class="text-themecolor">Admin Page</h4>
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


                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body bg-light">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="font-light m-t-0">Account Information</h5>
                                </div>
                            </div>
                        </div>



                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>

                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>ID :</td>
                                        <td><?php echo (ucfirst($_SESSION['user_id'])) ?></td>
                                    </tr>

                                    <tr>
                                        <td>NAME :</td>
                                        <td><?php echo (ucfirst($_SESSION['user_name'])) ?></td>

                                    </tr>
                                    <tr>
                                        <td>SURNAME :</td>
                                        <td><?php echo (ucfirst($_SESSION['user_surname'])) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="card-body bg-light">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="font-light m-t-0">Add School</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal form-material" id="addschool" action="index.php" method="post">

                                    <div class="form-group ">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="text" required="" name="school_name" placeholder="School Name">
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <div class="col-xs-12 p-b-20">
                                            <button class="btn btn-block btn-success" type="submit" name="addschool">Add New School</button>
                                        </div>
                                    </div>
                                </form>
                                <?php
                                if (isset($_POST['addschool'])) {
                                    require_once('../config.php');
                                    $conn = mysqli_connect($server, $user, $password, $database);
                                    $sql = "INSERT INTO `school` (`school_name`) VALUES ('" . $_POST['school_name'] . "');";

                                    if ($conn->query($sql) === TRUE) {
                                        echo '<div class="alert alert-success col-md-2" role="alert">School created successfully !!</div>';
                                    } else {
                                        echo '<div class="alert alert-warning" role="alert">' . $conn->error . '</div>';
                                    }
                                }
                                ?>


                                <?php
                                require_once('../config.php');
                                $conn = mysqli_connect($server, $user, $password, $database);
                                if (!$conn) {
                                    die("Connection failed " . mysqli_connect_error());
                                } else {
                                    $sql = "SELECT * FROM school";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        echo ('<table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>School ID</th>
                                        <th>School Name</th>
                                        <th>Status</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>');
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo ('<tr>
                                            <td>' . $row['school_id'] . '</td>
                                            <td>' . $row['school_name'] . '</td>
                                            <td><form class="form-horizontal form-material" id="delete" action="index.php" method="post"><button type="submit" class="btn btn-rounded btn-warning" name="delete" value="' . $row['school_id'] . '">Remove School</button></form></td>
                                            
                                        </tr>');
                                        }
                                    } else {
                                        echo "<p style='color:green;padding-left:20px;'>THERE IS NO INFORMATION ABOUT STUDENTS<br></p>";
                                    }
                                    echo ('</tbody>
                        </table>');
                                }


                                if (isset($_POST['delete'])) {
                                    $sql = "DELETE FROM `school` WHERE school_id=" . $_POST['delete'];
                                    if ($conn->query($sql) === TRUE) {
                                        echo '<div class="alert alert-success col-md-2" role="alert">School Deleted successfully !!</div>';
                                        echo "<meta http-equiv='refresh' content='0'>";
                                    } else {
                                        echo '<div class="alert alert-warning" role="alert">' . $conn->error . '</div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <script src="../app/files/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../app/files/js/custom.min.js"></script>

</body>

</html>