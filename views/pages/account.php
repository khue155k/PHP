<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị tài khoản</title>
    <style>
    </style>
</head>

<body>
    <div class='flex-sb account'>
        <div class="account-left">
            <?php
                include __DIR__ . '/../components/sidebarAdmin.php';
            ?>
        </div>
        <div class="account-right flex-grow-1">
            <?php
                include __DIR__ . '/../components/header.php';
            ?>
            <div class="container pad-0-28">
                <div class="flex-sb-center pad-20-0">
                    <h1 class="h1-title">Danh sách tài khoản</h1>
                    <button type="button" class="btn btn-primary">Tạo tài khoản</button>
                </div>
            </div>
        </div>
    </div>
</body>


</html>