<?php
//pagination
$pagination = mysqli_query($conn, "SELECT COUNT(tourID) AS total FROM tour");
$row = mysqli_fetch_assoc($pagination);
$total_records = $row['total'];

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

$limit = 5;
$total_page = ceil($total_records / $limit);

if ($current_page > $total_page) $current_page = $total_page;
        else if ($current_page < 1) $current_page = 1;

$start = ($current_page - 1) * $limit >=0 ? ($current_page - 1) * $limit : 0;

// read 
$dataTourSql = "SELECT `tour`.`tourID`, `tour`.`code`, `tour`.`name` as tourName,
    `tour`.`description`, `tour`.`startDate`, `tour`.`presentator`, `tour`.`availables`,
    `company`.`name` as companyName, `teacher`.`fullName`, `company`.`companyID`, `teacher`.`teacherID`
    FROM `tour` 
    LEFT JOIN `company` ON `tour`.`companyID` = `company`.`companyID` 
    LEFT JOIN `teacher` ON `tour`.`teacherID` = `teacher`.`teacherID`
    LIMIT $start, $limit";

$dataTour = mysqli_query($conn, $dataTourSql);
// đưa code logic ifelse mysqli_num_rows($dataTour) về đây 

$dataCompanySql = "SELECT `company`.`companyID`, `company`.`name` FROM `company`";
$dataCompany = mysqli_query($conn, $dataCompanySql);
$dataCompanySelect = "";
if (mysqli_num_rows($dataCompany) > 0) {
    while ($row = mysqli_fetch_assoc($dataCompany)) {
        $dataCompanySelect .= "<option value=" . $row['companyID'] . ">" . $row['name'] . "</option>";
    }
}

$scriptShowData = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['showData'])) {
        $tourID = $_POST["tourID"];
        $dataTourSelectedSql = "SELECT `tour`.`code`, `tour`.`name` as tourName , `tour`.`description`, `tour`.`startDate`,
                                `tour`.`presentator`, `tour`.`availables`, `company`.`name` as companyName, `company`.`code` as companyCode, `teacher`.`fullName`, `teacher`.`phoneNumber` 
                                FROM `tour`  
                                LEFT JOIN `company` ON `tour`.`companyID` = `company`.`companyID` 
                                LEFT JOIN `teacher` ON `tour`.`teacherID` = `teacher`.`teacherID` 
                                WHERE tour.tourID = '2'";


        $dataTourSelected = mysqli_query($conn, $dataTourSelectedSql);

        $dataStudentTourSql = "SELECT `student`.`studentID`, `student`.`code`, `student`.`fullName`, `student`.`address`, `student`.`phoneNumber`, `class`.`code` as classCode, `student_tour`.`rate`
                            FROM `student` 
                            LEFT JOIN `class` ON `student`.`classID` = `class`.`classID` 
                            LEFT JOIN `student_tour` ON `student_tour`.`studentID` = `student`.`studentID` 
                            LEFT JOIN `tour` ON `tour`.`tourID` = `student_tour`.`tourID` 
                            WHERE `tour`.`tourID` = $tourID";
        $dataStudentTour = mysqli_query($conn, $dataStudentTourSql);
        $scriptShowData = "
            document.getElementById('listTour').hidden = true;
            document.getElementById('showData').hidden = false;";
    }
}

$dataTeacherSql = "SELECT `teacher`.`teacherID`, `teacher`.`fullName`
    FROM `teacher`";
$dataTeacher = mysqli_query($conn, $dataTeacherSql);
$dataTeacherSelect = "";
if (mysqli_num_rows($dataTeacher) > 0) {
    while ($row = mysqli_fetch_assoc($dataTeacher)) {
        $dataTeacherSelect .= "<option value=" . $row['teacherID'] . ">" . $row['fullName'] . "</option>";

    }
}
// create
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['createTour'])) {
        if (
            isset($_POST["code"]) && isset($_POST["tourName"])
            && isset($_POST["description"]) && isset($_POST["startDate"])
            && isset($_POST["presentator"]) && isset($_POST["availables"])
            && isset($_POST["companyId"]) && isset($_POST["teacherId"])
        ) {
            $code = $_POST["code"];
            $tourName = $_POST["tourName"];
            $description = $_POST["description"];
            $startDate = $_POST["startDate"];
            $presentator = $_POST["presentator"];
            $availables = $_POST["availables"];
            $companyId = $_POST["companyId"];
            $teacherId = $_POST["teacherId"];
            // đã check null trong file css nên kt trc khi post là ko cần thiết 
            $checkCodeSql = "SELECT * FROM tour WHERE code = '$code'";
            $checkCodeResult = mysqli_query($conn, $checkCodeSql);
            if (mysqli_num_rows($checkCodeResult) > 0) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Mã chuyến tham quan đã tồn tại';
                            $('#notificationModal').modal('show');
                        });
                    </script>";
            } else {
                $createTourSql = "INSERT INTO `tour`( `code`, `name`, `description`,
                        `startDate`, `presentator`, `availables`, `companyID`, `teacherID`) 
                            VALUES ('$code','$tourName','$description',
                            '$startDate','$presentator','$availables','$companyId','$teacherId')";
                if (!mysqli_query($conn, $createTourSql)) {
                    $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('modalMessage').innerText = 'Tạo chuyến tham quan thất bại: $errorMessage';
                                $('#notificationModal').modal('show');
                            });
                            </script>";
                } else {
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('modalMessage').innerText = 'Tạo chuyến tham quan thành công';
                                $('#notificationModal').modal('show');
                                setTimeout(function(){
                                    window.location.href = '/PHP_Nhom3/index.php?controller=TourController';
                                }, 2000);
                            });
                        </script>";
                }

            }
        }
    }
}
//update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['updateTour'])) {
        print('lỗi');
        if (
            isset($_POST["tourID"]) && isset($_POST["code"]) && isset($_POST["tourName"])
            && isset($_POST["description"]) && isset($_POST["startDate"])
            && isset($_POST["presentator"]) && isset($_POST["availables"])
            && isset($_POST["companyId"]) && isset($_POST["teacherId"])
        ) {
            $updateId = $_POST["tourID"];
            $code = $_POST["code"];
            $tourName = $_POST["tourName"];
            $description = $_POST["description"];
            $startDate = $_POST["startDate"];
            $presentator = $_POST["presentator"];
            $availables = $_POST["availables"];
            $companyId = $_POST["companyId"];
            $teacherId = $_POST["teacherId"];
            // đã check null trong file css nên kt trc khi post là ko cần thiết 
            $updateTourSql = "UPDATE `tour` SET `code` = '$code',
                                `name` = '$tourName', `description` = '$description',
                                `startDate` = '$startDate', `presentator` = '$presentator',
                                `availables` = '$availables', `companyId` = '$companyId',
                                `teacherId` = '$teacherId' WHERE `tour`.`tourID` = $updateId";
            if (!mysqli_query($conn, $updateTourSql)) {
                $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('modalMessage').innerText = 'Cập nhật chuyến đi thất bại: $errorMessage';
                            $('#notificationModal').modal('show');
                            });
                    s</script>";
            } else {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('modalMessage').innerText = 'Cập nhật chuyến đi thành công';
                        $('#notificationModal').modal('show');
                        setTimeout(function(){
                            window.location.href = '/PHP_Nhom3/index.php?controller=TourController';
                        }, 2000);
                    });
                    </script>";
            }
        }
    }


}

// delete
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["deleteID"])) {
        $deleteId = $_POST["deleteID"];
        $deleteSql = "DELETE FROM tour WHERE tourID = '$deleteId'";
        if (mysqli_query($conn, $deleteSql)) {
            echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Tour đã được xóa thành công';
                            $('#notificationModal').modal('show');
                            setTimeout(function(){
                                window.location.href = '/PHP_Nhom3/index.php?controller=TourController';
                            }, 2000);
                        });
                    </script>";
        } else {
            $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('modalMessage').innerText = 'Xóa tour thất bại: $errorMessage';
                        $('#notificationModal').modal('show');
                        setTimeout(function(){
                            window.location.href = '/PHP_Nhom3/index.php?controller=TourController';
                        }, 2000);
                    });
                </script>";
        }
    }
}
require_once __DIR__ . '/../views/pages/tour.php';
