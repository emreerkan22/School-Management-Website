<?php


function nameSurname($username)
{
    require_once('../config.php');
    $conn = mysqli_connect($server, $user, $password, $database);
    if (!$conn) {
        die("Connection failed " . mysqli_connect_error());
    } else {
        $sql = "SELECT * FROM student";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($username == $row['username']) {
                    echo (strtoupper($row['name']) . ' ' . strtoupper($row['surname']));
                }
            }
        } else {
            echo "No results";
        }
    }
    mysqli_close($conn);
}

function registerCourse($student_id, $course_id)
{
    include('../config.php');
    $course_name;
    $instructor_id;
    $conn = mysqli_connect($server, $user, $password, $database);
    if (!$conn) {
        die("Connection failed " . mysqli_connect_error());
    } else {
        $sql = 'SELECT * FROM course WHERE course_id=' . $course_id;
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $sayi = 0;
            while ($sayi == 0 and $row = mysqli_fetch_assoc($result)) {

                $course_name = $row['course_name'];
                $instructor_id = $row['instructor_id'];
                $sayi = $sayi + 1;
            }
        } else {
            echo "THERE IS NO FILE IN THIS COURSE";
        }
    }
    $conn1 = mysqli_connect($server, $user, $password, $database);
    if (!$conn) {
        die("Connection failed " . mysqli_connect_error());
    } else {
        $sql1 = "INSERT INTO course (course_id, course_name, registered_student, instructor_id) VALUES ('" . $course_id . "', '" . $course_name . "', '" . $student_id . "', '" . $instructor_id . "');";
        if ($conn1->query($sql1) === TRUE) {

            $conn2 = mysqli_connect($server, $user, $password, $database);
            $sql2 = "INSERT INTO grade (homework_grade, quiz_grade, midterm_grade, final_grade, student_id, course_id) VALUES ('0', '0', '0', '0', '" . $student_id . "', '" . $course_id . "');";
            if ($conn2->query($sql2) === TRUE) {
                echo '<div class="alert alert-success col-md-2" role="alert">Course Grade =' . $course_id . ' Added successfully !!</div>';
            } else {
                echo '<div class="alert alert-warning" role="alert">GRADE DIDNT CREATED ' . $conn2->error . '</div>';
            }
        } else {
            echo '<div class="alert alert-warning" role="alert">WARNING REGISTRATION FAILED' . $conn1->error . '</div>';
        }
    }
}

function dropCourse($student_id, $course_id)
{
    include('../config.php');
    $conn = mysqli_connect($server, $user, $password, $database);
    if (!$conn) {
        die("Connection failed " . mysqli_connect_error());
    } else {
        $sql = "DELETE FROM course WHERE course_id = " . $course_id . " AND registered_student = " . $student_id;
        
        if ($conn->query($sql) === TRUE) {
            $conn2 = mysqli_connect($server, $user, $password, $database);
            $sql2 = "DELETE FROM grade WHERE course_id = " . $course_id . " AND student_id = " . $student_id;
            if ($conn2->query($sql2) === TRUE) {
                echo '<div class="alert alert-success col-md-2" role="alert">Course Grade =' . $course_id . ' Added successfully !!</div>';
            } else {
                echo '<div class="alert alert-warning" role="alert">GRADE DIDNT CREATED ' . $conn2->error . '</div>';
            }
        } else {
            echo '<div class="alert alert-warning" role="alert">' . $conn->error . '</div>';
        }
    }
}
function getCourseFiles($course_id)
{
    include('../config.php');


    $conn = mysqli_connect($server, $user, $password, $database);
    if (!$conn) {
        die("Connection failed " . mysqli_connect_error());
    } else {
        $sql = "SELECT DISTINCT file_name,course.course_name ,files.course_id FROM files INNER JOIN course ON course.course_id=files.course_id WHERE course.course_id=" . $course_id;
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="materials1"><li><a href="uploads/' . $row['file_name'] . '" target="_blank" download>' . $row['file_name'] . '</a>
            </li></div>';
            }
        } else {
            echo "THERE IS NO FILE IN THIS COURSE";
        }
    }
    mysqli_close($conn);
}
