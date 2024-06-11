<?php
$usernameErrorMessage = '';
$passwordErrorMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username)) {
            $usernameErrorMessage = 'Vui lòng nhập tên đăng nhập';
        } else if(empty($password)) {
            $passwordErrorMessage = 'Vui lòng nhập mật khẩu';
        } else {
            $sql = "SELECT * FROM account WHERE username = '$username' AND password = '$password'";
            $user = mysqli_query($conn, $sql);
            if ($user) 
            {
                $row = mysqli_fetch_assoc($user);
                $_SESSION["username"] = $username;
                switch ($row["role"]) {
                    case 'Tài khoản sinh viên':
                        header("Location: controllers/HomeController.php");
                        break;
                    case 'Tài khoản giáo viên':
                        header("Location: controllers/HomeController.php");
                        break;
                    case 'Toàn quyền hệ thống':
                        $_SESSION['checkRegularAmin'] = false;;
                        header("Location: controllers/AdminController.php");
                        break;
                    case 'Quản lý thông thường':
                        $_SESSION['checkRegularAmin'] = true;
                        header("Location: controllers/AdminController.php");
                        break;
                    default:
                        header("Location: controllers/LoginController.php");
                        break;
                }
            } else {
                echo "<script>";
                echo "alert('Vui lòng nhập user hoặc password')";
                echo "</script>";
            }
        }
    }
}
include_once __DIR__ . '/../views/pages/login.php';
    