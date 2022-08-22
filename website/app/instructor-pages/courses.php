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
                    <a class="navbar-brand" href="../../Instructor/instructor.php">
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
                        <div><img src="../files/images/users/1.jpg" alt="user-img" class="img-circle"></div>
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
                                    <span class="badge badge-pill badge-cyan ml-auto">3</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="../instructor-pages/courses.php">Courses</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <style>
            .column {
                display: flex;
            }

            html body .m-b-20 {
                margin-bottom: 20px;
                padding-top: 20px;
            }

            .select2.form-control.custom-select {
                color: #eaeaea;
            }

            .col-xs-123 {
                max-width: 20%;
                text-align: center;
                margin: auto;
            }

            .formeleman {
                padding-left: 25px;
                padding-right: 25px;
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
        </style>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Instructor Page</h4>
                    </div>
                </div>
                <!-- ============================================================== -->
                <div class="column">
                    <div class="col-2">
                        <div class="card">
                            <div class="formeleman">
                                <form method="post" class="form-horizontal form-material" id="joinrequest" action="courses.php" enctype="multipart/form-data">
                                    <h3 class="box-title m-b-20">Available Courses</h3>
                                    <div class="form-group">

                                        <div class="col-xs-12">
                                            <select class="select2 form-control custom-select" name="course_id" style="color:black">
                                                <option value="">--Select Course--</option>
                                                <?php
                                                require_once('../../config.php');

                                                $conn = mysqli_connect($server, $user, $password, $database);

                                                if (!$conn) {
                                                    die("Connection failed " . mysqli_connect_error());
                                                }

                                                $sql = "SELECT DISTINCT course_name,course_id FROM course WHERE instructor_id =" . $_SESSION['user_id'];
                                                $result = mysqli_query($conn, $sql);

                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo '<option value="' . $row['course_id'] . '">' . $row['course_name'] . '</option>';
                                                    }
                                                } else {
                                                    echo "NO ACTIVE COURSES FOUND";
                                                }
                                                mysqli_close($conn);
                                                ?>

                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-group text-center p-b-20">
                                        <div class="col-xs-12">
                                            <button class="btn btn-block btn-info btn-rounded" type="submit" name="request">Select Course</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>




                    <div class="col-10">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Selected Course</h4>

                                <h6 class="card-subtitle">Export data to Excel, PDF </h6>
                                <div class="table-responsive m-t-40">

                                    <?php
                                    require_once('../../config.php');
                                    $conn = mysqli_connect($server, $user, $password, $database);

                                    if (isset($_POST['request'])) {
                                        $_SESSION['course_id'] = $_POST['course_id'];
                                        //echo($_POST['course_id']);
                                        if (!$conn) {
                                            die("Connection failed " . mysqli_connect_error());
                                        } else {
                                            $sql = "SELECT DISTINCT grade.student_id,student.first_name,student.last_name,course.course_name,course.course_id,grade.homework_grade ,grade.quiz_grade ,grade.midterm_grade ,grade.final_grade FROM `course` INNER JOIN grade ON grade.course_id=course.course_id INNER JOIN student ON student.student_id=grade.student_id WHERE course.course_id= " . $_POST['course_id'] . " AND course.registered_student != 'NULL'";
                                            $result = mysqli_query($conn, $sql);
                                            echo ('<table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Course ID</th>
                                                            <th>Course Name</th>
                                                            
                                                            <th>Student ID</th>
                                                            <th>Student Name</th>
                                                            <th>HWork</th>
                                                            <th>Quiz G</th>
                                                            <th>Midterm</th>
                                                            <th>Final</th>
                                                            <th>Update</th>
                                                        </tr>
                                                    </thead>
            
                                                    <tbody>');
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo ('<tr><td>' . $row['course_id'] . '</td>
                                                            <td>' . ucfirst($row['course_name']) . '</td>
                                                            
                                                            <td>' . ucfirst($row['student_id']) . '</td>
                                                            <td>' . ucfirst($row['first_name']) . ' ' . ucfirst($row['first_name']) . '</td>
                                                          
                                                            <form method="post" id="gpa" action="courses.php"> <div class="gpa">
                                                            <td><input class="form-control" type="number" min="0" max="100" name="homework_grade" value="' . ucfirst($row['homework_grade']) . '"></td>
                                                            <td><input class="form-control" type="number" min="0" max="100" name="quiz_grade" value="' . ucfirst($row['quiz_grade']) . '"></td>
                                                            <td><input class="form-control" type="number" min="0" max="100" name="midterm_grade" value="' . ucfirst($row['midterm_grade']) . '"></td>
                                                            <td><input class="form-control" type="number" min="0" max="100" name="final_grade" value="' . ucfirst($row['final_grade']) . '"></td>

                                                            <td><button class="btn btn-block btn-success" type="submit" value="' . $row['student_id'] . '" name="gpa">Update GPA</button></div></td>
                                                            </form></td>
                                                            </tr>');
                                                }
                                            } else {
                                                echo "NO ACTIVE DATA FOUND";
                                            }
                                            echo ('</tbody>
                                                    </table>');
                                            echo ('<p>Click on the "Choose File" button to upload a class material:</p>
                                                    <form method="post" class="form-horizontal form-material" id="joinrequest" action="courses.php" enctype="multipart/form-data">
                    
                                                        <div class="form-group ">
                                                            <div class="col-xs-12">
                                                                <div class="fileupload btn btn-danger btn-rounded">
                                                                    <span><i class="ion-upload m-r-5"></i>Attachment</span>
                                                                    <input type="file" class="file" name="file">
                                                                </div>
                                                            </div>
                                                        </div>
                    
                                                        <div class="form-group text-center p-b-20">
                                                            <div class="col-xs-123">
                                                                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit" name="belge">Add Course Material</button>
                                                            </div>
                                                        </div>
                                                    </form>');


                                            $sql = "SELECT * FROM files WHERE course_id=" . $_SESSION['course_id'];
                                            $result = mysqli_query($conn, $sql);
                                            echo ('<table  class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Course ID</th>
                                                            <th>File Name</th>
                                                            <th>Status</th>  
                                                        </tr>
                                                    </thead>
            
                                                    <tbody>');
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo ('<tr><td>' . $_SESSION['course_id']  . '</td>                         
                                                            <td><a class="nav-link active" data-toggle="tab" href="#../uploads/' . $row['file_name'] . '"' .
                                                        'role="tab" download><span class="hidden-sm-up"><i class="fa fa-download"></i></span> <span' .
                                                        'class="hidden-xs-down">' . ucfirst($row['file_name']) . '</span> </a></td>   
                                                            <form method="post" id="filedelete" action="courses.php">
                                                            <td><button class="btn btn-block btn-success" type="submit" value="' . $row['file_id'] . '" name="filedelete">Delete File</button></td>
                                                            </form></td>
                                                            </tr>');
                                                }
                                            } else {
                                                echo "NO ACTIVE COURSE FILE FOUND";
                                            }
                                            echo ('</tbody>
                                                    </table>');
                                        }
                                    }
                                    ?>
                                    <?php
                                    if (isset($_POST['filedelete'])) {
                                        echo($_POST['filedelete']);
                                        if (!$conn) {
                                            die("Connection failed " . mysqli_connect_error());
                                        } else {
                                            $sql = "DELETE FROM files WHERE file_id=(".$_POST['filedelete'].") AND course_id=".$_SESSION['course_id'];
                                            $result = mysqli_query($conn, $sql);
                                            
                                            if ($conn->query($sql) === TRUE) {
                                                echo '<div class="alert alert-success col-md-2" role="alert">Files deleted successfully !!</div>';
                                            } else {
                                                echo '<div class="alert alert-warning" role="alert">' . $conn->error . '</div>';
                                            }

                                            mysqli_close($conn);
                                        }
                                    }

                                    ?>



                                    <?php
                                    if (isset($_POST['gpa'])) {

                                        if (!$conn) {
                                            die("Connection failed " . mysqli_connect_error());
                                        } else {
                                            $sql = "UPDATE grade SET homework_grade=" . $_POST['homework_grade'] . " , quiz_grade=" . $_POST['quiz_grade'] . " , midterm_grade=" . $_POST['midterm_grade'] . " , final_grade=" . $_POST['final_grade'] . " WHERE course_id = " . $_SESSION['course_id'] . " AND student_id=" . $_POST['gpa'];
                                            $result = mysqli_query($conn, $sql);
                                            echo (gettype($_POST['homework_grade']));
                                            if ($conn->query($sql) === TRUE) {
                                                echo '<div class="alert alert-success col-md-2" role="alert">Grades updated successfully !!</div>';
                                            } else {
                                                echo '<div class="alert alert-warning" role="alert">' . $conn->error . '</div>';
                                            }

                                            mysqli_close($conn);
                                        }
                                    }

                                    ?>

                                </div>
                                <?php
                                require_once('../../config.php');
                                $conn = mysqli_connect($server, $user, $password, $database);
                                if (isset($_POST['belge'])) {
                                    // File upload path
                                    $targetDir = "../uploads/";
                                    $fileName = basename($_FILES["file"]["name"]);
                                    $targetFilePath = $targetDir . $fileName;
                                    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                                    if (!$conn) {
                                        die("Connection failed " . mysqli_connect_error());
                                    } else {
                                        // Allow certain file formats
                                        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf', 'zip', 'rar');
                                        if (in_array($fileType, $allowTypes)) {
                                            // Upload file to server
                                            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                                                // Insert image file name into database
                                                $insert = $conn->query("INSERT INTO files (file_name, course_id) VALUES ('" . $fileName . "', '" . $_SESSION['course_id'] . "');");
                                                if ($insert) {
                                                    echo '<div class="alert alert-success col-md-2" role="alert">The file ' . $fileName . ' has been uploaded successfully.</div>';
                                                } else {
                                                    echo '<div class="alert alert-warning col-md-2" role="alert">File upload  ' . $_SESSION['course_id'] . 'failed, please try again.</div>';
                                                }
                                            } else {
                                                echo '<div class="alert alert-warning col-md-2" role="alert">Sorry, there was an error uploading your file.</div>';
                                            }
                                        } else {

                                            echo '<div class="alert alert-warning" role="alert">File didnt add !!</div>';
                                        }
                                    }
                                }
                                ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <style>
            form {
                text-align: center;
            }

            p {
                text-align: center;
            }

            .gpa {
                display: flex;
            }
        </style>




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