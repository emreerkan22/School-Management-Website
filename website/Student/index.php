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
    <title>SEE - School Management System</title>
    <!-- Custom CSS -->
    <link href="../app/files/css/style.min.css" rel="stylesheet">

</head>

<body class="skin-default-dark fixed-layout">
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
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
                        <div><img src="../app/files/images/users/2.jpg" alt="user-img" class="img-circle"></div>
                        <a href="javascript:void(0)" class="u-dropdown link hide-menu" role="button" aria-haspopup="true" aria-expanded="false"><?php echo (ucfirst($_SESSION['user_name']) . ' ' . ucfirst($_SESSION['user_surname'])) ?></a>
                    </div>
                </div>

                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Course
                                    Page
                                    <span class="badge badge-pill badge-cyan ml-auto">4</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="../app/offeredCourses.php">Offered Courses</a></li>
                                <li><a href="index.php">Taken Courses</a></li>
                                <li><a href="../app/courseFiles.php">Files</a></li>
                            </ul>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <style>
            .alert-success {
                color: #00654c;
                background-color: #ccf3e9;
                border-color: #b8eee0;
                position: fixed;
                right: 0;
                bottom: 0;
            }

            .alert-warning {
                position: fixed;
                right: 0;
                bottom: 0;
            }
        </style>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Student Page |
                            <?php
                            include("../config.php");
                            $conn = mysqli_connect($server, $user, $password, $database);
                            $sql = "SELECT * FROM school WHERE school_id=" . $_SESSION['school'];
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo ($row['school_name']);
                                }
                            } else {
                                echo "No results";
                            }


                            ?>
                        </h4>
                    </div>
                </div>
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">TAKEN COURSES</h4>
                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Course ID</th>
                                                <th>Course Name</th>
                                                <th>Instructor Name</th>
                                                <th>Midterm</th>
                                                <th>Quiz</th>
                                                <th>Homework</th>
                                                <th>Final</th>
                                                <th>Drop</th>
                                            </tr>
                                        </thead>
                                        <tbody>

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

                                            $sql = "SELECT DISTINCT course.course_name,instructor.first_name,instructor.last_name,grade.homework_grade,grade.quiz_grade,grade.midterm_grade,grade.final_grade,course.course_id FROM `grade` INNER JOIN course ON course.course_id = grade.course_id INNER JOIN instructor ON instructor.instructor_id=course.instructor_id WHERE student_id = " . $_SESSION['user_id'];
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>" .
                                                        "<td>" . ucfirst($row['course_id']) . "</td>" .
                                                        "<td>" . ucfirst($row['course_name']) . "</td>" .
                                                        "<td>" . ucfirst($row['first_name']) . " " . ucfirst($row['last_name']) . "</td>" .
                                                        "<th>" . ucfirst($row['midterm_grade']) . "</th>" .
                                                        "<th>" . ucfirst($row['quiz_grade']) . "</th>" .
                                                        "<th>" . ucfirst($row['homework_grade']) . "</th>" .
                                                        "<th>" . ucfirst($row['final_grade']) . "</th>" .
                                                        "<td><form method='POST'><button type='drop' class='btn btn-rounded btn-success' name='drop' value='" . $row['course_id'] . "'>Drop Course</button></form></td>" .
                                                        "</tr>";
                                                }
                                                echo "</table>";
                                            } else {
                                                echo "NO REGISTERED COURSE FOUND";
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

            table {
                border-collapse: collapse;
                text-align: center;
                font-size: 16px;
                font-style: bold;
                font-weight: bold;
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
    <script src="../app/files/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../app/files/js/custom.min.js"></script>
    <script src="files/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="files/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Menu sidebar -->
    <script src="files/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="files/js/custom.min.js"></script>
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
</body>
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

</html>