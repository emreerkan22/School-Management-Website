<?php
require_once('config.php');
$conn = mysqli_connect($server, $user, $password, $database);
if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];
    $styled_radio = $_POST['styled_radio'];
    $registered_school = $_POST['registered_school'];

    if (!$conn) {
        die("Connection failed " . mysqli_connect_error());
    } else {
        if ($styled_radio == 'instructor') {
            $sql = ("INSERT INTO instructor ( username, first_name, last_name, phone, email, registered_school, password) 
            VALUES ('".$username."', '".$name."', '".$surname."', '".$phone."', '".$mail."', '".$registered_school."', '".$password."');");
            if ($conn->query($sql) === TRUE) {
                echo '<div class="alert alert-success col-md-2" role="alert">Account created successfully !!</div>';
            } else {
                echo '<div class="alert alert-warning" role="alert">' . $conn->error . '</div>';
            }
        } else if($styled_radio == 'manager')  {
            $sql = ("INSERT INTO manager ( username, first_name, last_name, phone, email, managed_school, password) 
            VALUES ('".$username."', '".$name."', '".$surname."', '".$phone."', '".$mail."', '".$registered_school."', '".$password."');");
            if ($conn->query($sql) === TRUE) {
                echo '<div class="alert alert-success col-md-2" role="alert">Account created successfully !!</div>';
            } else {
                echo '<div class="alert alert-warning" role="alert">' . $conn->error . '</div>';
            }
        }else if($styled_radio == 'student')  {
            $sql = ("INSERT INTO student ( username, first_name, last_name, phone, email, registered_school, password) 
            VALUES ('".$username."', '".$name."', '".$surname."', '".$phone."', '".$mail."', '".$registered_school."', '".$password."');");
            if ($conn->query($sql) === TRUE) {
                echo '<div class="alert alert-success col-md-2" role="alert">Account created successfully !!</div>';
            } else {
                echo '<div class="alert alert-warning" role="alert">' . $conn->error . '</div>';
            }
        }
    }
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MEBIS - School Management System</title>

    <!-- page css -->
    <link href="app/files/css/external.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="app/files/css/style.min.css" rel="stylesheet">

</head>
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
.login-register {
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    height: 100%;
    width: 100%;
    padding: 5% 0;
        padding-top: 5%;
        padding-right: 0px;
        padding-bottom: 5%;
        padding-left: 0px;
    position: fixed;
}

</style>
<body class="skin-default-dark card-no-border">

    <section id="wrapper">
        <div class="login-register">
            <div class="login-box card">
                <div class="card-body">



                    <form method="post" class="form-horizontal form-material" id="loginform" action="register.php">
                        <h3 class="box-title m-b-20">Sign Up</h3>
                        <form>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text" required="" placeholder="Name" name="name">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text" required="" placeholder="Surname" name="surname">
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text" required="" placeholder="Username" name="username">
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" required="" placeholder="Password" name="password">
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" type="number" required="" placeholder="Phone" name="phone">
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text" required="" placeholder="Mail" name="mail">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <select class="select2 form-control custom-select" name="registered_school" style="color:white">
                                        <option style="color:red;" value="">Please Select School</option>
                                        <?php
                                        include('./config.php');

                                        $conn = mysqli_connect($server, $user, $password, $database);

                                        if (!$conn) {
                                            die("Connection failed " . mysqli_connect_error());
                                        }

                                        $sql = "SELECT * FROM school";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['school_id'] . '">' . $row['school_name'] . '</option>';
                                            }
                                        } else {
                                            echo "NO ACTIVE INSTRUCTOR FOUND";
                                        }
                                        mysqli_close($conn);
                                        ?>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Who Are You ? <span class="text-danger">*</span></h5>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" value="instructor" name="styled_radio" required id="styled_radio1" class="custom-control-input">
                                        <label class="custom-control-label" for="styled_radio1">Instructor</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input type="radio" value="student" name="styled_radio" id="styled_radio2" class="custom-control-input">
                                        <label class="custom-control-label" for="styled_radio2">Student</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input type="radio" value="manager" name="styled_radio" id="styled_radio3" class="custom-control-input">
                                        <label class="custom-control-label" for="styled_radio3">Manager</label>
                                    </div>


                                </div>
                            </div>
                            <div class="form-group text-center p-b-20">
                                <div class="col-xs-12">
                                    <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit" name="create">Sign Up</button>
                                </div>
                            </div>
                        </form>



                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                Already have an account? <a href="login.php" class="text-info m-l-5"><b>Sign In</b></a>
                            </div>
                        </div>
                </div>
            </div>

        </div>
    </section>
</body>

</html>