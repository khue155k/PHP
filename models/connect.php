<?php
    $conn = mysqli_connect("localhost", "root", "", "school_bussiness_tour_management");
    if (!$conn) {
        die("Kết nối không thành công: " . mysqli_connect_error());
    }
?>