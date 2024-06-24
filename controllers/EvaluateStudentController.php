<?php
$accountIDNow  = (isset($_SESSION["accountIdNow"]) && $_SESSION["accountIdNow"]) ? $_SESSION["accountIdNow"] : -1;
$getCurrentUserInfor = "SELECT * FROM teacher WHERE accountID = $accountIDNow";
$curentUserInfor = mysqli_query($conn, $getCurrentUserInfor);
$scriptShowData = '';
$scriptShowPage2 = '';
//pagination
if ($curentUserInfor && mysqli_num_rows($curentUserInfor) > 0) {
    $rowData = mysqli_fetch_assoc($curentUserInfor);
    $teacherID = $rowData['teacherID'];
    $paginationSql = "
    SELECT tour.startDate,COUNT(tour.tourID) AS total 
    FROM tour 
    WHERE
    (CASE 
        WHEN tour.startDate LIKE '%/%/%' THEN STR_TO_DATE(tour.startDate, '%d/%m/%Y')
        WHEN tour.startDate LIKE '%-%-%' THEN STR_TO_DATE(tour.startDate, '%Y-%m-%d')
        ELSE NULL
    END) < CURDATE()
    AND tour.teacherID = $teacherID";
    $pagination = mysqli_query($conn, $paginationSql);
    $row = mysqli_fetch_assoc($pagination);
    $total_records = $row['total'];
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 5;
    $total_page = ceil($total_records / $limit);

    if ($current_page > $total_page) $current_page = $total_page;
    else if ($current_page < 1) $current_page = 1;

    $start = ($current_page - 1) * $limit >= 0 ? ($current_page - 1) * $limit : 0;

    // get data
    $getTourHistorySql = "SELECT 
        tour.tourID,
        tour.code,
        tour.name,
        tour.description,
        tour.startDate,
        tour.presentator,
        tour.availables,
        tour.companyID,
        tour.teacherID,
        teacher.fullName AS teacherName,
        company.name AS companyName
    FROM tour
    INNER JOIN teacher ON tour.teacherID = teacher.teacherID
    INNER JOIN company ON tour.companyID = company.companyID
    WHERE 
    (CASE 
        WHEN tour.startDate LIKE '%/%/%' THEN STR_TO_DATE(tour.startDate, '%d/%m/%Y')
        WHEN tour.startDate LIKE '%-%-%' THEN STR_TO_DATE(tour.startDate, '%Y-%m-%d')
        ELSE NULL
    END) < CURDATE() 
    AND tour.teacherID = $teacherID
    GROUP BY tour.tourID
    LIMIT $start, $limit;";

    $getTourHistory = mysqli_query($conn, $getTourHistorySql);
    if (!$getTourHistory) {
        echo "Lỗi khi thực hiện truy vấn: " . mysqli_error($conn);
    }
    if (mysqli_num_rows($getTourHistory) > 1) {
        $scriptShowData = "document.getElementById('pagination').hidden = false;";
    }
} else {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('modalMessage').innerText = 'Lỗi, không thể lấy dữ liệu, vui lòng quay lại sau một ít thời gian';
            $('#notificationModal').modal('show');
            $('#notificationModal').on('hidden.bs.modal', function () {
                window.location.href = '/PHP_Nhom3/index.php?controller=HomeController';
            });
        });
    </script>";
}
$rowDataTour = '';
$getDataStudents = "";
function loadDataPage2($conn, $tourID)
{
    global $rowDataTour, $getDataStudents, $scriptShowPage2;
    $getDataTourSql = "
        SELECT tour.*, 
            teacher.fullName AS teacherName,
            company.name AS companyName 
        FROM tour 
        INNER JOIN 
            teacher ON tour.teacherID = teacher.teacherID
        INNER JOIN 
            company ON tour.companyID = company.companyID
        WHERE tourID = $tourID";
    $getDataTour = mysqli_query($conn, $getDataTourSql);
    if ($getDataTour && mysqli_num_rows($getDataTour) > 0) {
        $rowDataTour = mysqli_fetch_assoc($getDataTour);
    }

    $getDataStudentsSql = "
            SELECT student.*, class.name AS classname, student_tour.rate
            FROM student_tour
            INNER JOIN student ON student.studentID = student_tour.studentID
            INNER JOIN class on student.classID = class.classID
            WHERE student_tour.tourID =  $tourID
            ORDER BY student_tour.rate
            ";
    $getDataStudents = mysqli_query($conn, $getDataStudentsSql);
    $scriptShowPage2 = "
            document.getElementById('notShowStudents').hidden = true;
            document.getElementById('showStudents').hidden = false;";
}
// show dssv
$tourIDToEvaluate = -1;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['tourIDToEvaluate']) && isset($_POST['evaluateTour'])) {
        $tourIDToEvaluate = $_POST['tourIDToEvaluate'];
        $_SESSION['tourIDToEvaluateAllStudent'] = $tourIDToEvaluate;
        loadDataPage2($conn, $tourIDToEvaluate);
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        isset($_POST['evaluateAllStudent'])
        && isset($_POST['rate-1'])
        && isset($_POST['rate-2'])
        && isset($_POST['rate-3'])
        && isset($_POST['rate-4'])
        && isset($_POST['rate-5'])
        && isset($_POST['rate-6'])
    ) {
        $tourID = $_SESSION['tourIDToEvaluateAllStudent'];
        $rate = $_POST['rate-1'] + $_POST['rate-2'] + $_POST['rate-3'] + $_POST['rate-4'] + $_POST['rate-5'] + $_POST['rate-6'];
        $evaluateAllStudentSql = "UPDATE student_tour SET rate = $rate WHERE tourID = $tourID";
        $dataAll = mysqli_query($conn, $evaluateAllStudentSql);
        if ($dataAll) {
            loadDataPage2($conn, $tourID);
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('modalMessage').innerText = 'Đánh giá thành công';
                    $('#notificationModal').modal('show');
                });
            </script>";
        } else {
            echo "<script>
                $(document).ready(function() {
                    $('#modalMessage').text('Đánh giá sinh viên thất bại');
                    $('#notificationModal').modal('show');
                });
            </script>";
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        isset($_POST['evaluateEachStudent']) 
        && isset($_POST['studentIDToRate'])
        && isset($_POST['rate-1'])
        && isset($_POST['rate-2'])
        && isset($_POST['rate-3'])
        && isset($_POST['rate-4'])
        && isset($_POST['rate-5'])
        && isset($_POST['rate-6'])
    ) {
        $tourID = $_SESSION['tourIDToEvaluateAllStudent'];
        $studentIDToRate = $_POST['studentIDToRate'];
        $rate = $_POST['rate-1'] + $_POST['rate-2'] + $_POST['rate-3'] + $_POST['rate-4'] + $_POST['rate-5'] + $_POST['rate-6'];
        $evaluateEachStudentSql = "UPDATE student_tour SET rate = $rate WHERE tourID = $tourID AND studentID = $studentIDToRate";
        $dataEach = mysqli_query($conn, $evaluateEachStudentSql);
        if ($dataEach) {
            loadDataPage2($conn, $tourID);
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('modalMessage').innerText = 'Đánh giá thành công';
                    $('#notificationModal').modal('show');
                });
            </script>";
        } else {
            echo "<script>
                $(document).ready(function() {
                    $('#modalMessage').text('Đánh giá sinh viên thất bại');
                    $('#notificationModal').modal('show');
                });
            </script>";
        }
    }
}
require_once __DIR__ . '/../views/pages/evaluateStudents.php';
