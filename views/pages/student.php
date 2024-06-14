<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị sinh viên</title>
    <style>
    </style>
</head>

<body>
    <d class='flex-sb student'>
        <div class="student-left">
            <?php
                include __DIR__ . '/../components/sidebarAdmin.php';
            ?>
        </div>
        <div class="student-right flex-grow-1">
            <?php
                include __DIR__ . '/../components/header.php';
            ?>
            <div class="container pad-0-28">
                <div class="flex-sb-center pad-20-0">
                    <h1 class="h1-title">Danh sách sinh viên</h1>
                    <button type="button" class="btn btn-primary">Tạo sinh viên</button>
                </div>
            </div>
        </div>
    </d iv>
</body>


</html>
