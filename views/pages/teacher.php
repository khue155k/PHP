<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị giáo viên</title>
    <style>
    </style>
</head>

<body>
    <div class='flex-sb teacher'>
        <div class="teacher-left">
            <?php
                include __DIR__ . '/../components/sidebarAdmin.php';
            ?>
        </div>
        <div class="teacher-right flex-grow-1">
            <?php
                include __DIR__ . '/../components/header.php';
            ?>
            <div class="container pad-0-28">
                <div class="flex-sb-center pad-20-0">
                    <h1 class="h1-title">Danh sách giáo viên</h1>
                    <button type="button" class="btn btn-primary">Thêm giáo viên</button>
                </div>
            </div>
        </div>
    </div>
</body>


</html>