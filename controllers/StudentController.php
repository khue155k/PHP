<?php
// read
$dataStudentsSql = "SELECT studentID, student.code, fullName, birthDate, address, phoneNumber, email, student.classID, class.name FROM student 
                    LEFT JOIN class on student.classID=class.classID";
$dataStudents = mysqli_query($conn, $dataStudentsSql);

require_once __DIR__ . '/../views/pages/student.php';
