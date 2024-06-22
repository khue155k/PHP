<?php
$scriptShowData = '';
$accountIDNow  = (isset($_SESSION["accountIdNow"]) && $_SESSION["accountIdNow"]) ? $_SESSION["accountIdNow"] : -1;
$getCurrentUserInfor = "SELECT * FROM student WHERE accountID = $accountIDNow";
$curentUserInfor = mysqli_query($conn, $getCurrentUserInfor);

if($curentUserInfor && mysqli_num_rows($curentUserInfor) > 0)
{
    $rowData = mysqli_fetch_assoc($curentUserInfor);
    $studentID = $rowData['studentID'];
    //pagination
    $paginationSql = "
    SELECT 
        tour.startDate,
        COUNT(tour.tourID) AS total
    FROM 
        tour
    LEFT JOIN 
        student_tour ON tour.tourID = student_tour.tourID AND student_tour.studentID = $studentID
    WHERE 
        student_tour.studentID IS NULL
        AND (
            (tour.startDate LIKE '%/%/%' AND STR_TO_DATE(tour.startDate, '%d/%m/%Y') > DATE_ADD(CURDATE(), INTERVAL 2 DAY))
            OR
            (tour.startDate LIKE '%-%-%' AND STR_TO_DATE(tour.startDate, '%Y-%m-%d') > DATE_ADD(CURDATE(), INTERVAL 2 DAY))
        )
    ";
    $pagination = mysqli_query($conn, $paginationSql);
    $row = mysqli_fetch_assoc($pagination);
    $total_records = $row['total'];
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 3;
    $total_page = ceil($total_records / $limit);

    if ($current_page > $total_page) $current_page = $total_page;
    else if ($current_page < 1) $current_page = 1;

    $start = ($current_page - 1) * $limit >= 0 ? ($current_page - 1) * $limit : 0;

    // get data
    $getTourFutureSql = "SELECT 
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
    LEFT JOIN student_tour ON tour.tourID = student_tour.tourID AND student_tour.studentID = $studentID
    WHERE 
        student_tour.studentID IS NULL
        AND (
            (tour.startDate LIKE '%/%/%' AND STR_TO_DATE(tour.startDate, '%d/%m/%Y') > DATE_ADD(CURDATE(), INTERVAL 2 DAY))
            OR
            (tour.startDate LIKE '%-%-%' AND STR_TO_DATE(tour.startDate, '%Y-%m-%d') > DATE_ADD(CURDATE(), INTERVAL 2 DAY))
        )
    GROUP BY tour.tourID
    LIMIT $start, $limit;";
    $getTourFuture = mysqli_query($conn, $getTourFutureSql);
    if (!$getTourFuture) {
    echo "Lỗi khi thực hiện truy vấn: " . mysqli_error($conn);
    }
    if (mysqli_num_rows($getTourFuture) > 1) {
        $scriptShowData = "document.getElementById('pagination').hidden = false;";
    }

    // đăng ký
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if(isset($_POST['tourIDToRegister']) && isset($_POST['registerTour']))
        {
            $tourIDToRegister = $_POST['tourIDToRegister'];
            $registerSql = "INSERT INTO student_tour(tourID, studentID, rate) VALUES($tourIDToRegister, $studentID, 0)";
            $registerQuery = mysqli_query($conn,$registerSql);
            if($registerQuery)
            {
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('modalMessage').innerText = 'Đăng ký tham quan thành công';
                        $('#notificationModal').modal('show');
                        $('#notificationModal').on('hidden.bs.modal', function () {
                            window.location.href = '/PHP_Nhom3/index.php?controller=StudentRegisterTourController';
                        });
                    });
                </script>";
            }else{
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('modalMessage').innerText = 'Đăng ký tham quan thất bại';
                        $('#notificationModal').modal('show');
                    });
                </script>";
            }
        }
    }
}else{
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
require_once __DIR__ . '/../views/pages/studentRegisterTour.php';
