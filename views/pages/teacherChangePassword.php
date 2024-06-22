<!DOCTYPE html>
<html lang="en">

<head>
    <title>Change Password</title>
    <style>
        .user-infor .container-body {
            padding: 28px 28px;
        }

        .h2 {
            margin-bottom: 28px;
            font-size: 20px;
        }

        .span {
            color: red;
        }

        .form {
            padding: 28px;
            box-shadow: 0 0 12px rgba(0 0 0/10%);
            border-radius: 12px;
        }

        .btn-primary {
            margin-left: 12px;
        }
    </style>
</head>

<body>
    <div class='user-infor flex-sb'>
        <div class="user-infor-left">
            <?php
            include __DIR__ . '/../components/sidebarTeacher.php';
            ?>
        </div>
        <div class="user-infor-right flex-grow-1">
            <?php
            include __DIR__ . '/../components/header.php';
            ?>
            <div class="container-body">
                <div class="form" id="checkPassword" >
                    <h2 class="h2">Thay đổi mật khẩu</h2>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Tên đăng nhập:<span class="span">*</span></label>
                            <input disabled type="text" class="form-control" name="name" value="<?php echo $username; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="oldPassword" class="col-form-label">Mật khẩu cũ:<span class="span">*</span></label>
                            <input required type="password" class="form-control" name="oldPassword">
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="nextToCheckPassword">Tiếp theo</button>
                        </div>
                    </form>
                </div>
                <div class="form" id="changePassword" hidden>
                    <h2 class="h2">Thay đổi mật khẩu</h2>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Tên đăng nhập:<span class="span">*</span></label>
                            <input disabled type="text" class="form-control" name="name" value="<?php echo $username; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="col-form-label">Mật khẩu mới:<span class="span">*</span></label>
                            <input required type="password" class="form-control" name="newPassword">
                        </div>
                        <div class="mb-3">
                            <label for="repeatPassword" class="col-form-label">Nhập lại mật khẩu:<span class="span">*</span></label>
                            <input required type="password" class="form-control" name="repeatPassword">
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="changePassword">Thay đổi mật khẩu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
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
    </div>
    <script>
        <?php echo $scriptShowForm ?>
    </script>
</body>

</html>
