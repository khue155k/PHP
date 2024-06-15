<?php
$usernameErrorMessage = '';
$passwordErrorMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username)) {
            $usernameErrorMessage = 'Vui lòng nhập tên đăng nhập';
        } else if (empty($password)) {
            $passwordErrorMessage = 'Vui lòng nhập mật khẩu';
        } else {
            $stmt = $conn->prepare("SELECT * FROM account WHERE username = ? AND password = ?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if ($result->num_rows > 0) {
                $sql = "SELECT * FROM account WHERE username = '$username' AND password = '$password'";
                $user = mysqli_query($conn, $sql);
                if ($user) {
                    $row = mysqli_fetch_assoc($user);
                    $_SESSION["username"] = $username;
                    switch ($row["role"]) {
                        case 'Tài khoản sinh viên':
                            header("Location: /PHP_Nhom3/index.php?controller=HomeController");
                            break;
                        case 'Tài khoản giáo viên':
                            header("Location: /PHP_Nhom3/index.php?controller=HomeController");
                            break;
                        case 'Toàn quyền hệ thống':
                            $_SESSION['checkRegularAmin'] = false;;
                            header("Location: /PHP_Nhom3/index.php?controller=AdminController");
                            break;
                        case 'Quản lý thông thường':
                            $_SESSION['checkRegularAmin'] = true;
                            header("Location: /PHP_Nhom3/index.php?controller=AdminController");
                            break;
                        default:
                            header("Location: /PHP_Nhom3/index.php?controller=LoginController");
                            break;
                    }
                } 
            } else {
                echo "<script>";
                echo "alert('Sai tên đăng nhập hoặc mật khẩu')";
                echo "</script>";
            }
        }
    }
}
include_once __DIR__ . '/../views/pages/login.php';
