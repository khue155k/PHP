<?php
$usernameErrorMessage = '';
$passwordErrorMessage = '';
$errorMessage='';

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
            $user = $db->select($sql);
            if ($user) 
            {
                $_SESSION["username"] = $username;
                switch ($user["role"]) {
                    case 'Tài khoản sinh viên':
                        header("Location: controllers/HomeController.php");
                        break;
                    case 'Tài khoản giáo viên':
                        header("Location: controllers/HomeController.php");
                        break;
                    case 'Toàn quyền hệ thống':
                        header("Location: controllers/HomeController.php");
                        break;
                    case 'Quản lý thông thường':
                        header("Location: controllers/HomeController.php");
                        break;
                    default:
                        header("Location: controllers/LoginController.php");
                        break;
                }
            } else {
                $errorMessage = "Tên đăng nhập hoặc mật khẩu sai";
            }
        }
    }
    
}
require_once('views/pages/login.php');