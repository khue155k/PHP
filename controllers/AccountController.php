<?php
//pagination
$pagination = mysqli_query($conn, "SELECT COUNT(accountID) AS total FROM account");
$row = mysqli_fetch_assoc($pagination);
$total_records = $row['total'];

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;
$total_page = ceil($total_records / $limit);

if ($current_page > $total_page) $current_page = $total_page;
        else if ($current_page < 1) $current_page = 1;

$start = ($current_page - 1) * $limit >=0 ? ($current_page - 1) * $limit : 0;

// read
$dataAcountsSql = "SELECT * FROM account LIMIT $start, $limit";
$dataAcounts = mysqli_query($conn, $dataAcountsSql);

// create
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['createAccount'])) {
        if (isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST["role"])) {
            $name = $_POST["name"];
            $password = $_POST["password"];
            $role = $_POST["role"];

            if (empty($name)) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Bạn chưa nhập tên đăng nhập';
                            $('#notificationModal').modal('show');
                        });
                      </script>";
            } else if (empty($password)) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Bạn chưa nhập mật khẩu';
                            $('#notificationModal').modal('show');
                        });
                      </script>";
            } else {
                $checkUserSql = "SELECT * FROM account WHERE username = '$name'";
                $checkUserResult = mysqli_query($conn, $checkUserSql);
                if (mysqli_num_rows($checkUserResult) > 0) {
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('modalMessage').innerText = 'Tên đăng nhập đã tồn tại';
                                $('#notificationModal').modal('show');
                            });
                          </script>";
                } else {
                    $createAccountSql = "INSERT INTO account(username, password, role) VALUES('$name', '$password', '$role')";
                    if (!mysqli_query($conn, $createAccountSql)) {
                        $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
                        echo "<script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    document.getElementById('modalMessage').innerText = 'Tạo tài khoản thất bại: $errorMessage';
                                    $('#notificationModal').modal('show');
                                });
                              </script>";
                    } else {
                        echo "<script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    document.getElementById('modalMessage').innerText = 'Tạo tài khoản thành công';
                                    $('#notificationModal').modal('show');
                                    setTimeout(function(){
                                        window.location.href = '/PHP_Nhom3/index.php?controller=AccountController';
                                    }, 2000);
                                });
                              </script>";
                    }
                }
            }
        }
    }
}

// update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['updateAccount'])) {
        if (isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST["role"]) && isset($_POST["accountID"])) {
            $updateId = $_POST["accountID"];
            $name = $_POST["name"];
            $password = $_POST["password"];
            $role = $_POST["role"];
            if (empty($name)) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Bạn chưa nhập tên đăng nhập';
                            $('#notificationModal').modal('show');
                        });
                      </script>";
            } else if (empty($password)) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Bạn chưa nhập mật khẩu';
                            $('#notificationModal').modal('show');
                        });
                      </script>";
            } else {
                $checkUserSql = "SELECT * FROM account WHERE username = '$name'";
                $checkUserResult = mysqli_query($conn, $checkUserSql);
                $updateAccountSql = "UPDATE account SET username = '$name', password = '$password', role = '$role' WHERE accountID = '$updateId'";
                if (!mysqli_query($conn, $updateAccountSql)) {
                    $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('modalMessage').innerText = 'Cập nhật tài khoản thất bại: $errorMessage';
                                $('#notificationModal').modal('show');
                            });
                          </script>";
                } else {
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('modalMessage').innerText = 'Cập nhật tài khoản thành công';
                                $('#notificationModal').modal('show');
                                setTimeout(function(){
                                    window.location.href = '/PHP_Nhom3/index.php?controller=AccountController';
                                }, 2000);
                            });
                          </script>";
                }
            }
        }
    }
}

// delete
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["deleteID"])) {
        $deleteId = $_POST["deleteID"];
        $checkAllRoles = "SELECT * FROM account WHERE accountID = '$deleteId'";
        $dataAll = mysqli_query($conn, $checkAllRoles);
        $rowAll = mysqli_fetch_assoc($dataAll);
        if ($rowAll['role'] == "Toàn quyền hệ thống") {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('modalMessage').innerText = 'Không thể xóa tài khoản này';
                        $('#notificationModal').modal('show');
                        setTimeout(function(){
                            window.location.href = '/PHP_Nhom3/index.php?controller=AccountController';
                        }, 2000);
                    });
                  </script>";
        } else {
            $deleteSql = "DELETE FROM account WHERE accountID = '$deleteId'";
            if (!mysqli_query($conn, $deleteSql)) {
                $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Xóa tài khoản thất bại: $errorMessage';
                            $('#notificationModal').modal('show');
                            setTimeout(function(){
                                window.location.href = '/PHP_Nhom3/index.php?controller=AccountController';
                            }, 2000);
                        });
                      </script>";
            } else {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Tài khoản đã được xóa thành công';
                            $('#notificationModal').modal('show');
                            setTimeout(function(){
                                window.location.href = '/PHP_Nhom3/index.php?controller=AccountController';
                            }, 2000);
                        });
                      </script>";
            }
        }
    }
}

require_once __DIR__ . '/../views/pages/account.php';
