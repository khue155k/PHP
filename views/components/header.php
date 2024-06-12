<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    .zone {
        height: 76px;
    }

    .header {
        display: flex;
        padding: 20px 28px;
        justify-content: end;
        box-shadow: 1px 1px 12px rgba(0 0 0 /10%);
        height: 76px;
        position: fixed;
        background-color: #fff;
        top: 0;
        right: 0;
        left: 0;
    }

    .header>div {
        display: flex;
        align-items: center !important;
    }

    .header>div p {
        margin-bottom: 0 !important;
    }

    .user {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 8px;
    }

    .user img {
        width: 100%;
    }
    </style>
</head>

<body>
    <?php
        $username = (isset($_SESSION['username']) && $_SESSION['username']) ? ucfirst($_SESSION['username']) : '';
    ?>
    <div class="zone"></div>
    <div class="header">
        <div class="center">
            <div class="user">
                <img src="/PHP_Nhom3/public/images/user-avatar.png" alt="avatar">
            </div>
            <p>
                Xin chào, <?php echo $username  ?>
            </p>
        </div>
    </div>
</body>


</html>
