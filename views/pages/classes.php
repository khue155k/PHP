<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị lớp học</title>
    <style>
    </style>
</head>

<body>
    <d class='flex-sb classes'>
        <div class="classes-left">
            <?php
                include __DIR__ . '/../components/sidebarAdmin.php';
            ?>
        </div>
        <div class="classes-right flex-grow-1">
            <?php
                include __DIR__ . '/../components/header.php';
            ?>
            <div class="container pad-0-28">
                <div class="flex-sb-center pad-20-0">
                    <h1 class="h1-title">Danh sách lớp học</h1>
                    <button type="button" class="btn btn-primary">Tạo lớp học</button>
                </div>
            </div>
        </div>
    </d iv>
</body>


</html>