<?php
// read
$dataClassesSql = "SELECT class.*, COUNT(student.studentID) AS numStudents
                  FROM class
                  LEFT JOIN student ON class.classID = student.classID
                  GROUP BY class.classID";
$dataClasses = mysqli_query($conn, $dataClassesSql);

// create
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['createClass'])) {
        if (isset($_POST["code"]) && isset($_POST["classname"])) {
            $code = $_POST["code"];
            $classname = $_POST["classname"];
            if (empty($code)) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Bạn chưa nhập mã lớp';
                            $('#notificationModal').modal('show');
                        });
                      </script>";
            } else if (empty($classname)) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Bạn chưa nhập tên lớp';
                            $('#notificationModal').modal('show');
                        });
                      </script>";
            } else {
                $checkCodeSql = "SELECT * FROM class WHERE code = '$code'";
                $checkCodeResult = mysqli_query($conn, $checkCodeSql);
                if (mysqli_num_rows($checkCodeResult) > 0) {
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('modalMessage').innerText = 'Mã lớp đã tồn tại';
                                $('#notificationModal').modal('show');
                            });
                          </script>";
                } else {
                    $createClassSql = "INSERT INTO class(code, name) VALUES('$code', '$classname')";
                    if (!mysqli_query($conn, $createClassSql)) {
                        $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
                        echo "<script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    document.getElementById('modalMessage').innerText = 'Tạo lớp học thất bại: $errorMessage';
                                    $('#notificationModal').modal('show');
                                });
                              </script>";
                    } else {
                        echo "<script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    document.getElementById('modalMessage').innerText = 'Tạo lớp học thành công';
                                    $('#notificationModal').modal('show');
                                    setTimeout(function(){
                                        window.location.href = '/PHP_Nhom3/index.php?controller=ClassController';
                                    }, 2000);
                                });
                              </script>";
                    }
                }
            }
        }
    }
}

// update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['updateClass'])) {
        if (isset($_POST["classname"]) && isset($_POST["code"]) && isset($_POST["classID"])) {
            $updateId = $_POST["classID"];
            $code = $_POST["code"];
            $classname = $_POST["classname"];
            if (empty($code)) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Bạn chưa nhập mã lớp';
                            $('#notificationModal').modal('show');
                        });
                      </script>";
            } else if (empty($classname)) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Bạn chưa nhập tên lớp';
                            $('#notificationModal').modal('show');
                        });
                      </script>";
            } else {
                $updateClassSql = "UPDATE class SET code = '$code', name = '$classname' WHERE classID = '$updateId'";
                if (!mysqli_query($conn, $updateClassSql)) {
                    $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('modalMessage').innerText = 'Cập nhật lớp học thất bại: $errorMessage';
                                $('#notificationModal').modal('show');
                            });
                          </script>";
                } else {
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('modalMessage').innerText = 'Cập nhật lớp học thành công';
                                $('#notificationModal').modal('show');
                                setTimeout(function(){
                                    window.location.href = '/PHP_Nhom3/index.php?controller=ClassController';
                                }, 2000);
                            });
                          </script>";
                }
            }
        }
    }
}

// delete
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["deleteID"])) {
        $deleteId = $_POST["deleteID"];
        
        // Truy vấn để kiểm tra số lượng sinh viên của lớp học
        $getQualityStudent = "SELECT COUNT(studentID) AS numStudents FROM student WHERE classID = '$deleteId'";
        $dataAll = mysqli_query($conn, $getQualityStudent);
        
        if ($dataAll) {
            $rowAll = mysqli_fetch_assoc($dataAll);
            
            if ($rowAll['numStudents'] > 0) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Không thể xóa lớp học này vì lớp học này vẫn còn sinh viên, hãy chuyển sinh viên sang lớp khác trước khi xóa';
                            $('#notificationModal').modal('show');
                            setTimeout(function(){
                                window.location.href = '/PHP_Nhom3/index.php?controller=ClassController';
                            }, 2000);
                        });
                    </script>";
            } else {
                // Xóa lớp học nếu không còn sinh viên
                $deleteSql = "DELETE FROM class WHERE classID = '$deleteId'";
                
                if (mysqli_query($conn, $deleteSql)) {
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('modalMessage').innerText = 'Lớp học đã được xóa thành công';
                                $('#notificationModal').modal('show');
                                setTimeout(function(){
                                    window.location.href = '/PHP_Nhom3/index.php?controller=ClassController';
                                }, 2000);
                            });
                        </script>";
                } else {
                    $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('modalMessage').innerText = 'Xóa lớp học thất bại: $errorMessage';
                                $('#notificationModal').modal('show');
                                setTimeout(function(){
                                    window.location.href = '/PHP_Nhom3/index.php?controller=ClassController';
                                }, 2000);
                            });
                        </script>";
                }
            }
        } else {
            // Xử lý trường hợp có lỗi trong quá trình truy vấn
            $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('modalMessage').innerText = 'Đã xảy ra lỗi khi kiểm tra số lượng sinh viên: $errorMessage';
                        $('#notificationModal').modal('show');
                        setTimeout(function(){
                            window.location.href = '/PHP_Nhom3/index.php?controller=ClassController';
                        }, 2000);
                    });
                </script>";
        }
    }
}
require_once __DIR__ . '/../views/pages/classes.php';
