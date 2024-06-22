<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change User Information</title>
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
            include __DIR__ . '/../components/sidebarUser.php';
            ?>
        </div>
        <div class="user-infor-right flex-grow-1">
            <?php
            include __DIR__ . '/../components/header.php';
            ?>
            <div class="container-body">
                <div class="form" id="checkPassword" >
                    <h2 class="h2">Thông tin cá nhân</h2>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="code" class="col-form-label">Mã sinh viên:<span class="span">*</span></label>
                            <input disabled type="text" class="form-control" name="code" value="<?php echo $username; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="fullName" class="col-form-label">Họ và tên:<span class="span">*</span></label>
                            <input required type="text" class="form-control" name="fullName" value="<?php echo $username; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="birthDate" class="col-form-label">Ngày sinh:<span class="span">*</span></label>
                            <input required type="text" class="form-control" name="birthDate" value="<?php echo $username; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="phoneNumber" class="col-form-label">Số điện thoại:<span class="span">*</span></label>
                            <input required type="text" class="form-control" name="phoneNumber" value="<?php echo $username; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email:<span class="span">*</span></label>
                            <input required type="text" class="form-control" name="email" value="<?php echo $username; ?>">
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="nextToCheckPassword">Thay đổi</button>
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
</body>

</html>
