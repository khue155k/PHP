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
        .gender{
            display: flex;
            justify-content: start;
        }
        .gender > div{
            display: flex;
            align-items: center;
        }
        .gender > div > input{
            margin: 0 8px;
        }
        .gender > div:nth-child(2){
            margin: 0 16px;
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
                <div class="form" id="checkPassword">
                    <h2 class="h2">Thông tin cá nhân</h2>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="code" class="col-form-label">Mã sinh viên:<span class="span">*</span></label>
                            <input disabled type="text" class="form-control" name="code" value="<?php echo $code; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="fullName" class="col-form-label">Họ và tên:<span class="span">*</span></label>
                            <input required type="text" class="form-control" name="fullName" value="<?php echo $fullName; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="col-form-label">Giới tính:<span class="span">*</span></label> <br>
                            <div class="gender">
                                <div>
                                    <input required type="radio" id="gender_male" name="gender" value="Nam" <?php echo ($gender == 'Nam') ? 'checked' : ''; ?>>
                                    <label for="gender_male">Nam</label>
                                </div>
                                <div>
                                    <input required type="radio" id="gender_female" name="gender" value="Nữ" <?php echo ($gender == 'Nữ') ? 'checked' : ''; ?>>
                                    <label for="gender_female">Nữ</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="birthDate" class="col-form-label">Ngày sinh:<span class="span">*</span></label>
                            <input required type="date" class="form-control" name="birthDate" value="<?php echo $formattedDate; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="phoneNumber" class="col-form-label">Số điện thoại:<span class="span">*</span></label>
                            <input required type="text" class="form-control" name="phoneNumber" value="<?php echo $phoneNumber; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email:<span class="span">*</span></label>
                            <input required type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="changeInfor">Cập nhập thông tin</button>
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
