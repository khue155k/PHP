<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <link rel="stylesheet" href="public/css/login.css">
</head>

<body>
    <?php
        require_once('controllers/LoginController.php');
        if($errorMessage)
        {
            echo "<div class='alert alert-warning' role='alert'>". $errorMessage . "</div>";
        }
    ?>
    <div class="auth flex-center">
        <div class="auth-container flex-center">
            <div class="auth-img">
                <img src="public/images/bg-login.jpg" alt="login image">
            </div>
            <form action="" method="POST" class="auth-form" novalidate>
                <h3>Đăng nhập</h3>
                <div class="mb-3 row">
                    <label for="username" class="col-form-label">Tên đăng nhập<span>*</span> </label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <?php
                        require_once('controllers/LoginController.php');
                        if($usernameErrorMessage)
                        {
                            echo "<span class='error'>". $usernameErrorMessage . "</span>";
                        }
                    ?>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-form-label">Mật khẩu<span>*</span></label>
                    <div class="col-sm-12">
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <?php
                        require_once('controllers/LoginController.php');
                        if($passwordErrorMessage)
                        {
                            echo "<span class='error'>". $passwordErrorMessage . "</span>";
                        }
                    ?>
                </div>
                <button type="submit" class="btn-login">Đăng nhập</button>
            </form>
        </div>
    </div>
</body>


</html>
