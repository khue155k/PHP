<?php
$scriptShowForm  = '';
$username = (isset($_SESSION['username']) && $_SESSION['username']) ? ucfirst($_SESSION['username']) : '';
$accountId = (isset($_SESSION["accountIdNow"]) && $_SESSION["accountIdNow"]) ? $_SESSION["accountIdNow"] : -1;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['oldPassword']) && isset($_POST['nextToCheckPassword'])) {
        $password = $_POST['oldPassword'];
        $checkPasswordSql = "SELECT * FROM account WHERE username = '$username' AND password = '$password' AND accountID = $accountId";
        $data = mysqli_query($conn, $checkPasswordSql);
        if ($data) {
            if (mysqli_num_rows($data) > 0) {
                $scriptShowForm = "
                    document.getElementById('checkPassword').hidden = true;
                    document.getElementById('changePassword').hidden = false;";
            }else{
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('modalMessage').innerText = 'Mật khẩu sai!!!';
                        $('#notificationModal').modal('show');
                    });
                    </script>";
            }
        } else {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('modalMessage').innerText = 'Lỗi! Không truy cập vào server, vui lòng thử lại sau ít phút';
                        $('#notificationModal').modal('show');
                    });
                    </script>";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['newPassword']) && isset($_POST['changePassword']) && isset($_POST['repeatPassword'])) {
        $newPassword = $_POST['newPassword'];
        $repeatPassword = $_POST['repeatPassword'];
        if($newPassword !== $repeatPassword)
        {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('modalMessage').innerText = 'Nhập lại mật khẩu không khớp với mật khẩu mới';
                        $('#notificationModal').modal('show');
                    });
                  </script>";
            $scriptShowForm = "
                document.getElementById('checkPassword').hidden = true ;
                document.getElementById('changePassword').hidden = false;";
        }else {
            $changePasswordSql = "UPDATE account SET password = '$newPassword' WHERE username = '$username' AND accountID = $accountId";
            $data = mysqli_query($conn, $changePasswordSql);
            if ($data) {
                $scriptShowForm = "
                    document.getElementById('checkPassword').hidden = false;
                    document.getElementById('changePassword').hidden = true;";
                echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('modalMessage').innerText = 'Thay đổi mật khẩu thành công';
                        $('#notificationModal').modal('show');
                    });
                    </script>";
            } else {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Thay đổi mật khẩu thất bại, vui lòng thử lại sau ít phút';
                            $('#notificationModal').modal('show');
                        });
                        </script>";
            }
        }
    }
}

require_once __DIR__ . '/../views/pages/teacherChangePassword.php';
