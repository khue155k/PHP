<?php
//pagination
$pagination = mysqli_query($conn, "SELECT COUNT(teacherID) AS total FROM teacher");
$row = mysqli_fetch_assoc($pagination);
$total_records = $row['total'];

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 3;
$total_page = ceil($total_records / $limit);

if ($current_page > $total_page) $current_page = $total_page;
else if ($current_page < 1) $current_page = 1;

$start = ($current_page - 1) * $limit >= 0 ? ($current_page - 1) * $limit : 0;

//read
$dataTeachersSql = "SELECT teacher.teacherID, teacher.code, fullName, gender, birthDate, address, phoneNumber, email, COUNT(tourID) AS totalTourTeacher FROM teacher 
                    LEFT JOIN tour on tour.teacherID = teacher.teacherID
                    GROUP BY tour.teacherID
                        LIMIT $start, $limit";
$dataTeachers = mysqli_query($conn, $dataTeachersSql);

// $dataClassSql = "SELECT classID,name FROM class";
// $dataClass = mysqli_query($conn, $dataClassSql);
// $dataSelect = "";
// if (mysqli_num_rows($dataClass) > 0) {
//     while ($row = mysqli_fetch_assoc($dataClass)) {
//         $dataSelect .= "<option value=" . $row['classID'] . ">" . $row['name'] . "</option>";
//     }
// }
$scriptShowData = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['showData'])) {
        $teacherID = $_POST["teacherID"];

        $dataTeacherSql = "SELECT teacher.code, fullName, gender, birthDate, address, phoneNumber, email FROM teacher 
                               WHERE teacherID = $teacherID";
        $dataTeacher = mysqli_query($conn, $dataTeacherSql);

        $dataTeacherTourSql = "SELECT tour.code, tour.name, startDate, company.name AS companyName, COUNT(studentID) AS totalStudentTour FROM student_tour
                        LEFT JOIN tour on tour.tourID = student_tour.tourID 
                        INNER JOIN company on company.companyID = tour.companyID 
                        INNER JOIN teacher on teacher.teacherID = tour.teacherID
                        WHERE teacher.teacherID = $teacherID
                        GROUP BY student_tour.tourId";

        $dataTeacherTour = mysqli_query($conn, $dataTeacherTourSql);

        $scriptShowData = "
                document.getElementById('listTeachers').hidden = true;
                document.getElementById('showData').hidden = false;";
    }
}

// create
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['createTeacher'])) {
        $code = $_POST["code"];
        $fullName = $_POST["fullName"];
        $gender = $_POST["gender"];
        $birthDate = $_POST["birthDate"];
        $address = $_POST["address"];
        $phoneNumber = $_POST["phoneNumber"];
        $email = $_POST["email"];

        $checkTeacherSql = "SELECT * FROM teacher WHERE code = '$code'";
        $checkTeacherResult = mysqli_query($conn, $checkTeacherSql);
        if (mysqli_num_rows($checkTeacherResult) > 0) {
            echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('modalMessage').innerText = 'Mã giáo viên đã tồn tại';
                                $('#notificationModal').modal('show');
                            });
                        </script>";
        } else {
            $createTeacherSql = "INSERT INTO teacher(code, fullName, gender, birthDate, address, phoneNumber, email) VALUES('$code', '$fullName', '$gender', '$birthDate', '$address', '$phoneNumber', '$email')";
            if (!mysqli_query($conn, $createTeacherSql)) {
                $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
                echo "<script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    document.getElementById('modalMessage').innerText = 'Thêm giáo viên thất bại: $errorMessage';
                                    $('#notificationModal').modal('show');
                                });
                              </script>";
            } else {
                echo "<script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    document.getElementById('modalMessage').innerText = 'Thêm giáo viên thành công';
                                    $('#notificationModal').modal('show');
                                    setTimeout(function(){
                                        window.location.href = '/PHP_Nhom3/index.php?controller=TeacherController';
                                    }, 2000);
                                });
                            </script>";
            }
        }
    }
}

// update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['updateTeacher'])) {
        $teacherID = $_POST["teacherID"];
        $code = $_POST["code"];
        $fullName = $_POST["fullName"];
        $gender = $_POST["gender"];
        $birthDate = $_POST["birthDate"];
        $address = $_POST["address"];
        $phoneNumber = $_POST["phoneNumber"];
        $email = $_POST["email"];

        $checkTeacherSql = "SELECT * FROM teacher WHERE code = '$code'";
        $checkTeacherResult = mysqli_query($conn, $checkTeacherSql);
        $updateTeacherSql = "UPDATE teacher SET fullName = '$fullName', gender = '$gender', birthDate = '$birthDate', address = '$address', phoneNumber = '$phoneNumber', email = '$email'
                                    WHERE teacherID = $teacherID";
        if (!mysqli_query($conn, $updateTeacherSql)) {
            $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
            echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Sửa giáo viên thất bại: $errorMessage';
                                $('#notificationModal').modal('show');
                            });
                        </script>";
        } else {
            echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                             document.getElementById('modalMessage').innerText = 'Sửa giáo viên thành công';
                            $('#notificationModal').modal('show');
                            setTimeout(function(){
                                window.location.href = '/PHP_Nhom3/index.php?controller=TeacherController';
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
        $checkRoles = "SELECT * FROM teacher WHERE teacherID = '$deleteId'";
        $data = mysqli_query($conn, $checkRoles);
        $row = mysqli_fetch_assoc($data);

        $deleteSql = "DELETE FROM teacher WHERE teacherID = '$deleteId'";
        if (!mysqli_query($conn, $deleteSql)) {
            $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
            echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('modalMessage').innerText = 'Xóa tài khoản thất bại: $errorMessage';
                                $('#notificationModal').modal('show');
                                setTimeout(function(){
                                    window.location.href = '/PHP_Nhom3/index.php?controller=TeacherController';
                                }, 2000);
                            });
                          </script>";
        } else {
            echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('modalMessage').innerText = 'Tài khoản đã được xóa thành công';
                                $('#notificationModal').modal('show');
                                setTimeout(function(){
                                    window.location.href = '/PHP_Nhom3/index.php?controller=TeacherController';
                                }, 2000);
                            });
                          </script>";
        }
    }
}

require_once __DIR__ . '/../views/pages/teacher.php';
