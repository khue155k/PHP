<?php
    define("PASSWORD","");
    $conn = mysqli_connect('localhost', 'root', PASSWORD, 'school_bussiness_tour_management');
    if (!$conn) {
        die("Kết nối không thành công: " . mysqli_connect_error());
    }
?>