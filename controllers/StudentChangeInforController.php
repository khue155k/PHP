<?php
$accountId = (isset($_SESSION["accountIdNow"]) && $_SESSION["accountIdNow"]) ? $_SESSION["accountIdNow"] : -1;
$getCurrentUserInfor = "SELECT * FROM student WHERE accountID = $accountId";
$curentUserInfor = mysqli_query($conn, $getCurrentUserInfor);
if($curentUserInfor)
{
    $row = mysqli_fetch_assoc($curentUserInfor);
    $code = $row['code'];
    $fullName = $row['fullName'];
    $birthDate = $row['birthDate'];
    $phoneNumber = $row['phoneNumber'];
    $email = $row['email'];
    $fullName = $row['fullName'];
}else{
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('modalMessage').innerText = 'Lấy dữ liệu người dùng thất bại';
                $('#notificationModal').modal('show');
            });
        </script>";
    header("Location: /PHP_Nhom3/index.php?controller=HomeController");
}

require_once __DIR__ . '/../views/pages/studentChangeInfor.php';
?>
