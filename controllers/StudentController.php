<?php
//pagination
$pagination = mysqli_query($conn, "SELECT COUNT(studentID) AS total FROM student");
$row = mysqli_fetch_assoc($pagination);
$total_records = $row['total'];

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 3;
$total_page = ceil($total_records / $limit);

if ($current_page > $total_page) $current_page = $total_page;
        else if ($current_page < 1) $current_page = 1;

$start = ($current_page - 1) * $limit >=0 ? ($current_page - 1) * $limit : 0;

//read
$dataStudentsSql = "SELECT studentID, student.code, fullName, gender, birthDate, address, phoneNumber, email, student.classID, class.name FROM student 
                    LEFT JOIN class on student.classID=class.classID
                    LIMIT $start, $limit";
$dataStudents = mysqli_query($conn, $dataStudentsSql);

$dataClassSql = "SELECT classID,name FROM class";
$dataClass = mysqli_query($conn, $dataClassSql);
$dataSelect = "";
if (mysqli_num_rows($dataClass) > 0) {
    while ($row = mysqli_fetch_assoc($dataClass)) {
        $dataSelect .= "<option value=" . $row['classID'] . ">" . $row['name'] . "</option>";
    }
}
$scriptShowData = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['showData'])) {
        $studentID = $_POST["studentID"];

        $dataStudentSql = "SELECT student.code, fullName, gender, birthDate, address, phoneNumber, email, name FROM student 
                           LEFT JOIN class on student.classID=class.classID
                           WHERE studentID = $studentID";
        $dataStudent = mysqli_query($conn, $dataStudentSql);

        $dataStudentTourSql = "SELECT tour.code, tour.name, tour.description, startDate, availables, company.name AS companyName, teacher.fullName AS teacherName, presentator FROM student_tour
                    LEFT JOIN tour on tour.tourID = student_tour.tourID 
                    INNER JOIN company on company.companyID = tour.companyID 
                    INNER JOIN teacher on teacher.teacherID = tour.teacherID
                    WHERE studentID = $studentID";

        $dataStudentTour = mysqli_query($conn, $dataStudentTourSql);

        $scriptShowData = "
            document.getElementById('listStudents').hidden = true;
            document.getElementById('showData').hidden = false;";
    }
}

// create
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['createStudent'])) {
        $code = $_POST["code"];
        $fullName = $_POST["fullName"];
        $gender = $_POST["gender"];
        $birthDate = $_POST["birthDate"];
        $address = $_POST["address"];
        $phoneNumber = $_POST["phoneNumber"];
        $email = $_POST["email"];
        $classID = $_POST["classID"];

        $checkStudentSql = "SELECT * FROM student WHERE code = '$code'";
        $checkStudentResult = mysqli_query($conn, $checkStudentSql);
        if (mysqli_num_rows($checkStudentResult) > 0) {
            echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Mã sinh viên đã tồn tại';
                            $('#notificationModal').modal('show');
                        });
                    </script>";
        } else {
            $createStudentSql = "INSERT INTO student(code, fullName, gender, birthDate, address, phoneNumber, email, classID) VALUES('$code', '$fullName', '$gender', '$birthDate', '$address', '$phoneNumber', '$email', '$classID')";
            if (!mysqli_query($conn, $createStudentSql)) {
                $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
                echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('modalMessage').innerText = 'Thêm sinh viên thất bại: $errorMessage';
                                $('#notificationModal').modal('show');
                            });
                          </script>";
            } else {
                echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('modalMessage').innerText = 'Thêm sinh viên thành công';
                                $('#notificationModal').modal('show');
                                setTimeout(function(){
                                    window.location.href = '/PHP_Nhom3/index.php?controller=StudentController';
                                }, 2000);
                            });
                        </script>";
            }
        }
    }
}

// update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['updateStudent'])) {
        $studentID = $_POST["studentID"];
        $code = $_POST["code"];
        $fullName = $_POST["fullName"];
        $gender = $_POST["gender"];
        $birthDate = $_POST["birthDate"];
        $address = $_POST["address"];
        $phoneNumber = $_POST["phoneNumber"];
        $email = $_POST["email"];
        $classID = $_POST["classID"];

        $updateStudentSql = "UPDATE student SET fullName = '$fullName', gender = '$gender', birthDate = '$birthDate', address = '$address', phoneNumber = '$phoneNumber', email = '$email', classID = '$classID' 
                                WHERE studentID = $studentID";
        if (!mysqli_query($conn, $updateStudentSql)) {
            $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('modalMessage').innerText = 'Sửa sinh viên thất bại: $errorMessage';
                            $('#notificationModal').modal('show');
                        });
                    </script>";
        } else {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                         document.getElementById('modalMessage').innerText = 'Sửa sinh viên thành công';
                        $('#notificationModal').modal('show');
                        setTimeout(function(){
                            window.location.href = '/PHP_Nhom3/index.php?controller=StudentController';
                        }, 2000);
                    });
                </script>";
        }
    }
}

// delete
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["deleteID"])) {
        $deleteId = $_POST["deleteID"];

        $deleteSql = "DELETE FROM student WHERE studentID = '$deleteId'";
        if (!mysqli_query($conn, $deleteSql)) {
            $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
            echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Xóa sinh viên thất bại: $errorMessage';
                            $('#notificationModal').modal('show');
                            setTimeout(function(){
                                window.location.href = '/PHP_Nhom3/index.php?controller=StudentController';
                            }, 2000);
                        });
                      </script>";
        } else {
            echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Sinh viên đã được xóa thành công';
                            $('#notificationModal').modal('show');
                            setTimeout(function(){
                                window.location.href = '/PHP_Nhom3/index.php?controller=StudentController';
                            }, 2000);
                        });
                      </script>";
        }
    }
}

require_once __DIR__ . '/../views/pages/student.php';
