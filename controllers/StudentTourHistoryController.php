<?php
$accountIDNow  = (isset($_SESSION["accountIdNow"]) && $_SESSION["accountIdNow"]) ? $_SESSION["accountIdNow"] : -1;
$getCurrentUserInfor = "SELECT * FROM student WHERE accountID = $accountIDNow";
$curentUserInfor = mysqli_query($conn, $getCurrentUserInfor);
$scriptShowData = '';
//pagination
if($curentUserInfor && mysqli_num_rows($curentUserInfor) > 0)
{
    $rowData = mysqli_fetch_assoc($curentUserInfor);
    $studentID = $rowData['studentID'];
    $paginationSql = "
    SELECT tour.startDate,COUNT(student_tour.tourID) AS total 
    FROM student_tour 
    LEFT JOIN tour ON tour.tourID = student_tour.tourID 
    WHERE
    (CASE 
        WHEN tour.startDate LIKE '%/%/%' THEN STR_TO_DATE(tour.startDate, '%d/%m/%Y')
        WHEN tour.startDate LIKE '%-%-%' THEN STR_TO_DATE(tour.startDate, '%Y-%m-%d')
        ELSE NULL
    END) < CURDATE()
    AND student_tour.studentID = $studentID";
    $pagination = mysqli_query($conn, $paginationSql);
    $row = mysqli_fetch_assoc($pagination);
    $total_records = $row['total'];
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 5;
    $total_page = ceil($total_records / $limit);

    if ($current_page > $total_page) $current_page = $total_page;
            else if ($current_page < 1) $current_page = 1;

    $start = ($current_page - 1) * $limit >=0 ? ($current_page - 1) * $limit : 0;
}

// get data
$getTourHistorySql = " SELECT 
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
FROM 
    student_tour
LEFT JOIN 
    tour ON tour.tourID = student_tour.tourID 
LEFT JOIN 
    student ON student.studentID = student_tour.studentID 
LEFT JOIN 
    teacher ON tour.teacherID = teacher.teacherID
LEFT JOIN 
    company ON tour.companyID = company.companyID
WHERE 
    (CASE 
        WHEN tour.startDate LIKE '%/%/%' THEN STR_TO_DATE(tour.startDate, '%d/%m/%Y')
        WHEN tour.startDate LIKE '%-%-%' THEN STR_TO_DATE(tour.startDate, '%Y-%m-%d')
        ELSE NULL
    END) < CURDATE() 
    AND student.accountID = $accountIDNow
LIMIT $start, $limit;
";

$getTourHistory = mysqli_query($conn, $getTourHistorySql);
if (!$getTourHistory) {
    echo "Lỗi khi thực hiện truy vấn: " . mysqli_error($conn);
}
if(mysqli_num_rows($getTourHistory) > $limit)
{
    $scriptShowData="document.getElementById('pagination').hidden = false;";
}
require_once __DIR__ . '/../views/pages/studentTourHistory.php';
?>
