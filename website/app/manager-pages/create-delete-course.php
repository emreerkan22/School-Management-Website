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
    <link rel="icon" type="image/png" sizes="16x16" href="../files/images/favicon.png">
    <title>MEBIS - School Management System</title>
    <!-- Custom CSS -->
    <link href="../files/css/style.min.css" rel="stylesheet">

</head>

<body class="skin-default-dark fixed-layout">
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <a class="navbar-brand" href="../../Manager/manager.php">
                        <b>
                            <img src="../files/images/logo-icon.png" alt="homepage" class="dark-logo" />
                            <img src="../files/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                        </b>
                        <span>
                            <img src="../files/images/logo-text.png" alt="homepage" class="dark-logo" />
                            <img src="../files/images/logo-light-text.png" class="light-logo" alt="homepage" />
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
                        <li class="nav-item right-side-toggle"> <a class="nav-link  waves-effect waves-light" href="../../login.php"><i class="fa fa-power-off"></i></a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User Profile-->
                <div class="user-profile">
                    <div class="user-pro-body">
                        <div><img src="../files/images/users/3.jpg" alt="user-img" class="img-circle"></div>
                        <div class="dropdown">
                            <a href="javascript:void(0)" class="u-dropdown link hide-menu" role="button" aria-haspopup="true" aria-expanded="false"><?php echo (ucfirst($_SESSION['user_name']) . ' ' . ucfirst($_SESSION['user_surname'])) ?></a>
                        </div>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Course
                                    Page
                                </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="../secretary-pages/create-delete-course.php">Create&Delete a Course</a>

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
                        <h4 class="text-themecolor">Manager Page</h4>
                    </div>
                </div>
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                require_once('../../config.php');
                                $conn = mysqli_connect($server, $user, $password, $database);
                                if (isset($_POST['addcourse'])) {
                                    $course_id = $_POST['course_id'];
                                    $course_name = $_POST['course_name'];
                                    $instructor_id = $_POST['instructor_id'];

                                    if (!$conn) {
                                        die("Connection failed " . mysqli_connect_error());
                                    }
                                    $error_message = 'You have already create course';
                                    $sql = "INSERT INTO course (course_id,course_name,  instructor_id) VALUES ('" . $course_id . "','" . $course_name . "','" . $instructor_id . "' )";
                                    if ($conn->query($sql) === TRUE) {
                                        echo '<div class="alert alert-success col-md-2" role="alert">Course created successfully !!</div>';
                                    } else {
                                        echo '<div class="alert alert-warning" role="alert">' . $conn->error . '</div>';
                                    }
                                }
                                ?>
                                <form method="post" class="form-horizontal form-material" id="addcourse" action="create-delete-course.php">
                                    <h3 class="box-title m-b-20">Create Course</h3>

                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <select class="select2 form-control custom-select" name="instructor_id">
                                                <option value="">Select Instructor</option>
                                                <?php
                                                require('../../config.php');

                                                $conn = mysqli_connect($server, $user, $password, $database);

                                                if (!$conn) {
                                                    die("Connection failed " . mysqli_connect_error());
                                                } else {

                                                    $sql = "SELECT instructor.first_name, instructor_id, instructor.last_name, instructor.registered_school, manager.managed_school FROM instructor INNER JOIN manager ON instructor.registered_school = managed_school WHERE managed_school = " . $_SESSION['school'];
                                                    $result = mysqli_query($conn, $sql);

                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo '<option value="' . $row['instructor_id'] . '">' . $row['instructor_id'] . ' - ' . $row['first_name'] . " " . $row['last_name'] . '</option>';
                                                        }
                                                    } else {
                                                        echo "NO ACTIVE INSTRUCTOR FOUND";
                                                    }
                                                }
                                                mysqli_close($conn);

                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="number" required="" placeholder="Course ID" name="course_id">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <input class="form-control" type="text" required="" placeholder="Course Name" name="course_name">
                                        </div>
                                    </div>
                                    <br>
                                    <br>

                                    <div class="form-group text-center p-b-20">
                                        <div class="col-xs-12">
                                            <button class="btn btn-lg btn-info btn-rounded" type="submit" name="addcourse">Add Course</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <style>
                                .tablo {
                                    padding: 0px;
                                }
                            </style>
                            <style>
                                .custom-control {
                                    position: relative;
                                    display: block;
                                    min-height: 1.5rem;
                                    padding-left: 0px;
                                }

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
                                .row {
                                    padding: 20px;
                                }
                            </style>
                            <div class="tablo">
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                        <h4 class="card-title">Course List</h4>
                                        <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                                        <div class="table-responsive m-t-40">
                                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>NAME</th>
                                                        <th>INSTRUCTOR NAME</th>
                                                        <th>DELETE</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    include_once('../../config.php');
                                                    include('../../database/courses.php');
                                                    if (isset($_POST['delete'])) {
                                                        deleteCourse($_POST['delete']);
                                                    }
                                                    // Connect to database
                                                    $conn = mysqli_connect($server, $user, $password, $database);

                                                    // Check connection
                                                    if (!$conn) {
                                                        die("Connection failed " . mysqli_connect_error());
                                                    }
                                                    $sql = "SELECT DISTINCT course.course_id, course.course_name, course.instructor_id, instructor.registered_school,instructor.first_name,instructor.last_name,manager.managed_school FROM course INNER JOIN instructor ON course.instructor_id = instructor.instructor_id INNER JOIN manager ON manager.managed_school=instructor.registered_school WHERE instructor.registered_school = " . $_SESSION['school'];
                                                    $result = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        // Output data of each row
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo "<tr>" .
                                                                "<td>" . $row['course_id'] . "</td>" .
                                                                "<td>" . ucfirst($row['course_name']) . "</td>" .
                                                                "<td>" . ucfirst($row['first_name']) . " " . ucfirst($row['last_name']) . "</td>" .
                                                                "<td><form method='POST'><button type='delete' class='btn btn-rounded btn-success' name='delete' value='" . $row['course_id'] . "'>Delete</button></form></td>" .
                                                                "</tr>";
                                                        }
                                                        echo "</table>";
                                                    } else {
                                                        echo "No results";
                                                    }

                                                    mysqli_close($conn);
                                                    ?>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../files/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Menu sidebar -->
    <script src="../files/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../files/js/custom.min.js"></script>
    <!-- This is data table -->

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../files/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Menu sidebar -->
    <script src="../files/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../files/js/custom.min.js"></script>
    <!-- This is data table -->

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            $(document).ready(function() {
                var table = $('#example').DataTable({
                    "columnDefs": [{
                        "visible": false,
                        "targets": 2
                    }],
                    "order": [
                        [2, 'asc']
                    ],
                    "displayLength": 25,
                    "drawCallback": function(settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;
                        api.column(2, {
                            page: 'current'
                        }).data().each(function(group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                                last = group;
                            }
                        });
                    }
                });
                // Order by the grouping
                $('#example tbody').on('click', 'tr.group', function() {
                    var currentOrder = table.order()[0];
                    if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                        table.order([2, 'desc']).draw();
                    } else {
                        table.order([2, 'asc']).draw();
                    }
                });
            });
        });
        $('#example23').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'pdf', 'print'
            ]
        });
    </script>
</body>

</html>