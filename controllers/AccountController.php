<?php
$dataAcountsSql = "SELECT * FROM account"; 
$dataAcounts = mysqli_query($conn, $dataAcountsSql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST["role"])) {
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $role = mysqli_real_escape_string($conn, $_POST["role"]);

        if (empty($name)) {
            echo "<script>";
            echo "alert('Bạn chưa nhập tên đăng nhập');";
            echo "</script>";
        } else if (empty($password)) {
            echo "<script>";
            echo "alert('Bạn chưa nhập mật khẩu');";
            echo "</script>";
        } else {
            $checkUserSql = "SELECT * FROM account WHERE username = '$name'";
            $checkUserResult = mysqli_query($conn, $checkUserSql);
            if (mysqli_num_rows($checkUserResult) > 0) {
                echo "<script>";
                echo "alert('Tên đăng nhập đã tồn tại');";
                echo "</script>";
            } else {
                $createAccountSql = "INSERT INTO account(username, password, role) VALUES('$name', '$password', '$role')";
                if (!mysqli_query($conn, $createAccountSql)) {
                    echo "<script>";
                    echo "alert('Tạo tài khoản thất bại: " . mysqli_error($conn) . "');";
                    echo "</script>";
                } else {
                    echo "<script>";
                    echo "window.location.href = '/PHP_Nhom3/index.php?controller=AccountController';";
                    echo "</script>";
                }
            }
        }
    }
}

// xóa
if (isset($_GET['deleteAccountId'])) {
    $deleteId = mysqli_real_escape_string($conn, $_GET['deleteAccountId']);
    $checkAllRoles = "SELECT * FROM account WHERE accountID = '$deleteId'";
    $dataAll = mysqli_query($conn, $checkAllRoles);
    $rowAll = mysqli_fetch_assoc($dataAll);
    if ($rowAll['role'] == "Toàn quyền hệ thống") {
        echo "<script>";
        echo "alert('Không thể xóa tài khoản này');";
        echo "window.location.href = '/PHP_Nhom3/index.php?controller=AccountController';";
        echo "</script>";
    } else {
        $deleteSql = "DELETE FROM account WHERE accountID = '$deleteId'";
        if (!mysqli_query($conn, $deleteSql)) {
            echo "<script>";
            echo "alert('Xóa tài khoản thất bại: " . mysqli_error($conn) . "');";
            echo "window.location.href = '/PHP_Nhom3/index.php?controller=AccountController';";
            echo "</script>";
        } else {
            echo "<script>";
            echo "window.location.href = '/PHP_Nhom3/index.php?controller=AccountController';";
            echo "</script>";
        }
    }
}

// sửa
$rowUpdate = null;

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $updateId = $_GET['id'];
    $dataUpdate = "SELECT * FROM account WHERE accountID = '$updateId'";
    $data = mysqli_query($conn, $dataUpdate);

    if ($data && mysqli_num_rows($data) > 0) {
        $rowUpdate = mysqli_fetch_assoc($data);
        echo json_encode($rowUpdate);
        exit;
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Không tìm thấy tài khoản: " . $updateId));
        exit;
    }
}
require_once __DIR__ . '/../views/pages/account.php';
?>
