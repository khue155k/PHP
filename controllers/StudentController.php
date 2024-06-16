<?php
// read
$dataStudentsSql = "SELECT studentID, student.code, fullName, birthDate, address, phoneNumber, email, student.classID, class.name FROM student 
                    LEFT JOIN class on student.classID=class.classID";
$dataStudents = mysqli_query($conn, $dataStudentsSql);

$dataClassSql = "SELECT classID,name FROM class";
$dataClass = mysqli_query($conn, $dataClassSql);
$dataSelect = "";
if (mysqli_num_rows($dataClass) > 0) {
    while ($row = mysqli_fetch_assoc($dataClass)) {
        $dataSelect .= "<option value=" . $row['classID'] . ">" . $row['name'] . "</option>";
    }
} else {
    $dataSelect = "Lỗi truy vấn: " . mysqli_error($conn);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['showData'])) {
        $studentID = $_POST["studentID"];

        $dataStudentTourSql = "SELECT tour.code, name, description, startDate, availables, companyID, teacherID, presentator FROM student_tour
                    LEFT JOIN tour on tour.tourID = student_tour.tourID 
                    WHERE studentID = $studentID";
        $dataStudentTour = mysqli_query($conn, $dataStudentTourSql);
    }
}

// create
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['createStudent'])) {
        $code = $_POST["code"];
        $fullName = $_POST["fullName"];
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
            $createStudentSql = "INSERT INTO student(code, fullName, birthDate, address, phoneNumber, email, classID) VALUES('$code', '$fullName', '$birthDate', '$address', '$phoneNumber', '$email', '$classID')";
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
        $birthDate = $_POST["birthDate"];
        $address = $_POST["address"];
        $phoneNumber = $_POST["phoneNumber"];
        $email = $_POST["email"];
        $classID = $_POST["classID"];

        $checkStudentSql = "SELECT * FROM student WHERE code = '$code'";
        $checkStudentResult = mysqli_query($conn, $checkStudentSql);
        $createStudentSql = "UPDATE student SET fullName = '$fullName', birthDate = '$birthDate', address = '$address', phoneNumber = '$phoneNumber', email = '$email', classID = '$classID' 
                                WHERE studentID = $studentID";
        if (!mysqli_query($conn, $createStudentSql)) {
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
        $checkRoles = "SELECT * FROM student WHERE studentID = '$deleteId'";
        $data = mysqli_query($conn, $checkRoles);
        $row = mysqli_fetch_assoc($data);

        $deleteSql = "DELETE FROM student WHERE studentID = '$deleteId'";
        if (!mysqli_query($conn, $deleteSql)) {
            $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
            echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Xóa tài khoản thất bại: $errorMessage';
                            $('#notificationModal').modal('show');
                            setTimeout(function(){
                                window.location.href = '/PHP_Nhom3/index.php?controller=StudentController';
                            }, 2000);
                        });
                      </script>";
        } else {
            echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Tài khoản đã được xóa thành công';
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
