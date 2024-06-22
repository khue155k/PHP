<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <link rel="stylesheet" href="/PHP_Nhom3/public/css/login.css">
</head>

<body>
    <?php
        include_once __DIR__ . '/../../controllers/LoginController.php';    
    ?>
    <div class="auth flex-center">
        <div class="auth-container flex-center">
            <div class="auth-img">
                <img src="/PHP_Nhom3/public/images/bg-login.jpg" alt="login image">
            </div>
            <form method="POST" class="auth-form">
                <h3>Đăng nhập</h3>
                <div class="mb-3 row">
                    <label for="username" class="col-form-label">Tên đăng nhập<span>*</span> </label>
                    <div class="col-sm-12">
                        <input required type="text" class="form-control" id="username" name="username">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-form-label">Mật khẩu<span>*</span></label>
                    <div class="col-sm-12">
                        <input required type="password" class="form-control" id="password" name="password">
                    </div>
                </div>
                <button type="submit" class="btn-login">Đăng nhập</button>
            </form>
        </div>
    </div>
    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog"
        aria-labelledby="notificationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Thông báo</h5>
                </div>
                <div class="modal-body" id="modalMessage">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</body>


</html>
