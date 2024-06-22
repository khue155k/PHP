<?php
$accountIDNow  = (isset($_SESSION["accountIdNow"]) && $_SESSION["accountIdNow"]) ? $_SESSION["accountIdNow"] : -1;
$getCurrentUserInfor = "SELECT * FROM teacher WHERE accountID = $accountIDNow";
$curentUserInfor = mysqli_query($conn, $getCurrentUserInfor);
$scriptShowData = '';
//pagination
if($curentUserInfor && mysqli_num_rows($curentUserInfor) > 0)
{
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

    $start = ($current_page - 1) * $limit >=0 ? ($current_page - 1) * $limit : 0;

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
    if(mysqli_num_rows($getTourHistory) > 1)
    {
        $scriptShowData="document.getElementById('pagination').hidden = false;";
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
require_once __DIR__ . '/../views/pages/evaluateStudent.php';
?>
