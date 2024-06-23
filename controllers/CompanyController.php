<?php
    // require_once __DIR__ . '/../views/pages/company.php';

// read
$dataCompanysSql = "SELECT companyID, code, name, description, email, phoneNumber, address FROM company";
$dataCompanys = mysqli_query($conn, $dataCompanysSql);

// $dataClassSql = "SELECT classID,name FROM class";
// $dataClass = mysqli_query($conn, $dataClassSql);
// $dataSelect = "";
// if (mysqli_num_rows($dataClass) > 0) {
//     while ($row = mysqli_fetch_assoc($dataClass)) {
//         $dataSelect .= "<option value=" . $row['classID'] . ">" . $row['name'] . "</option>";
//     }
// }
$scriptShowData="";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['showData'])) {
        $companyID = $_POST["companyID"];

        $dataCompanySql = "SELECT companyID, code, name, description, email, phoneNumber, address FROM company
                           WHERE companyID = $companyID";
        $dataCompany = mysqli_query($conn, $dataCompanySql);

        // $dataCompanyTourSql = "SELECT tour.code, tour.name, tour.description, startDate, availables, company.name AS companyName, teacher.fullName AS teacherName, presentator FROM company_tour
        //             LEFT JOIN tour on tour.tourID = company_tour.tourID 
        //             INNER JOIN company on company.companyID = tour.companyID 
        //             INNER JOIN teacher on teacher.teacherID = tour.teacherID
        //             WHERE companyID = $companyID";
        // $dataCompanyTour = mysqli_query($conn, $dataCompanyTourSql);
        $scriptShowData = "
            document.getElementById('listCompanys').hidden = true;
            document.getElementById('showData').hidden = false;";
    }
}
$dataClassesSql = "SELECT class.*, COUNT(student.studentID) AS numStudents
                  FROM class
                  LEFT JOIN student ON class.classID = student.classID
                  GROUP BY class.classID";
$dataClasses = mysqli_query($conn, $dataClassesSql);
$scriptShowData="";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['showData'])) {
        $classIDShow = $_POST["classIDToShowStudents"];
        echo "<script>console.log('". $classIDShow ."')</script>" ;
        $dataClassSql = "SELECT class.*, COUNT(student.studentID) AS numStudents
                  FROM class
                  LEFT JOIN student ON class.classID = student.classID
                  WHERE class.classID = $classIDShow
                  GROUP BY class.classID";
        $dataClass = mysqli_query($conn, $dataClassSql);    
        $dataStudentSql = "SELECT code, fullName, gender, birthDate, address, phoneNumber, email
                           FROM student
                           WHERE classID = $classIDShow";
        $dataStudents = mysqli_query($conn, $dataStudentSql);
        $scriptShowData = "
            document.getElementById('listClass').hidden = true;
            document.getElementById('showData').hidden = false;";
    }}
// create
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['createCompany'])) {
        $code = $_POST["code"];
        $fullName = $_POST["fullName"];
        $gender = $_POST["gender"];
        $birthDate = $_POST["birthDate"];
        $address = $_POST["address"];
        $phoneNumber = $_POST["phoneNumber"];
        $email = $_POST["email"];
        $classID = $_POST["classID"];

        $checkCompanySql = "SELECT * FROM company WHERE code = '$code'";
        $checkCompanyResult = mysqli_query($conn, $checkCompanySql);
        if (mysqli_num_rows($checkCompanyResult) > 0) {
            echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Mã sinh viên đã tồn tại';
                            $('#notificationModal').modal('show');
                        });
                    </script>";
        } else {
            $createCompanySql = "INSERT INTO company(code, fullName, gender, birthDate, address, phoneNumber, email, classID) VALUES('$code', '$fullName', '$gender', '$birthDate', '$address', '$phoneNumber', '$email', '$classID')";
            if (!mysqli_query($conn, $createCompanySql)) {
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
                                    window.location.href = '/PHP_Nhom3/index.php?controller=CompanyController';
                                }, 2000);
                            });
                        </script>";
            }
        }
    }
}

// update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['updateCompany'])) {
        $companyID = $_POST["companyID"];
        $code = $_POST["code"];
        $name = $_POST["name"];
        $description = $_POST["description"];
        $email = $_POST["email"];
        $phoneNumber = $_POST["phoneNumber"];
        $address = $_POST["address"];  
        $checkCompanySql = "SELECT * FROM company WHERE code = '$code'";
        $checkCompanyResult = mysqli_query($conn, $checkCompanySql);
        $createCompanySql = "UPDATE company SET name = '$name', description = '$description',email = '$email', phoneNumber = '$phoneNumber', address = '$address'
                                WHERE companyID = $companyID";
        // if (!mysqli_query($conn, $createCompanySql)) {
        //     $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
        //     echo "<script>
        //             document.addEventListener('DOMContentLoaded', function() {
        //                 document.getElementById('modalMessage').innerText = 'Sửa doanh nghiệp thất bại: $errorMessage';
        //                     $('#notificationModal').modal('show');
        //                 });
        //             </script>";
        // } else {
        //     echo "<script>
        //             document.addEventListener('DOMContentLoaded', function() {
        //                  document.getElementById('modalMessage').innerText = 'Sửa doanh nghiệp thành công';
        //                 $('#notificationModal').modal('show');
        //                 setTimeout(function(){
        //                     window.location.href = '/PHP_Nhom3/index.php?controller=CompanyController';
        //                 }, 2000);
        //             });
        //         </script>";
        // }
        if (!mysqli_query($conn, $createCompanySql)) {
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
        $checkRoles = "SELECT * FROM company WHERE companyID = '$deleteId'";
        $data = mysqli_query($conn, $checkRoles);
        $row = mysqli_fetch_assoc($data);

        $deleteSql = "DELETE FROM company WHERE companyID = '$deleteId'";
        if (!mysqli_query($conn, $deleteSql)) {
            $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
            echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Xóa tài khoản thất bại: $errorMessage';
                            $('#notificationModal').modal('show');
                            setTimeout(function(){
                                window.location.href = '/PHP_Nhom3/index.php?controller=CompanyController';
                            }, 2000);
                        });
                      </script>";
        } else {
            echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Tài khoản đã được xóa thành công';
                            $('#notificationModal').modal('show');
                            setTimeout(function(){
                                window.location.href = '/PHP_Nhom3/index.php?controller=CompanyController';
                            }, 2000);
                        });
                      </script>";
        }
    }
}


require_once __DIR__ . '/../views/pages/company.php';

    
    
    