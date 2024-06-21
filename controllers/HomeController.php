<?php
$getQualityTourSql = "SELECT COUNT(tourID) AS qofTour FROM tour";
$getQualityTour = mysqli_query($conn, $getQualityTourSql);

$getQualityTeacherSql = "SELECT COUNT(teacherID) AS qofTeacher FROM teacher";
$getQualityTeacher = mysqli_query($conn, $getQualityTeacherSql);

$getQualityStudentSql = "SELECT COUNT(studentID) AS qofStudent FROM student";
$getQualityStudent = mysqli_query($conn, $getQualityStudentSql);

$getQualityCompanySql = "SELECT COUNT(companyID) AS qofCompany FROM company";
$getQualityCompany = mysqli_query($conn, $getQualityCompanySql);

$qofTour = 0;
$qofTeacher = 0;
$qofStudent = 0;
$qofCompany = 0;

if ($getQualityTour && $getQualityTeacher && $getQualityStudent && $getQualityCompany) {
    $row1 = mysqli_fetch_assoc($getQualityTour);
    $qofTour = $row1['qofTour'];

    $row2 = mysqli_fetch_assoc($getQualityCompany);
    $qofCompany = $row2['qofCompany'];

    $row3 = mysqli_fetch_assoc($getQualityStudent);
    $qofStudent = $row3['qofStudent'];

    $row4 = mysqli_fetch_assoc($getQualityTeacher);
    $qofTeacher = $row4['qofTeacher'];
} else {
    echo "Lỗi khi thực hiện truy vấn: " . mysqli_error($conn);
}

$accountIDNow = $_SESSION['accountIdNow'];
echo "<script>console.log(" . $accountIDNow . ")</script>";
$getTourNowSql = " SELECT 
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
    END) = CURDATE() 
    AND student.accountID = $accountIDNow;
";


$getTourNow = mysqli_query($conn, $getTourNowSql);
if (!$getTourNow) {
    echo "Lỗi khi thực hiện truy vấn: " . mysqli_error($conn);
}

require_once __DIR__ . '/../views/pages/home.php';
