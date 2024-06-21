<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PHP_Nhom3/node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/PHP_Nhom3/public/css/base.css">
</head>

<body>
    <script src="/PHP_Nhom3/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/PHP_Nhom3/node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
    <script src="/PHP_Nhom3/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <?php
        include_once 'models/connect.php';
        $controller = isset($_GET['controller']) ? $_GET['controller'] : 'LoginController';

        switch($controller){
            case 'LogoutController':
            case 'LoginController':{
                require_once('controllers/LoginController.php');
                break;
            }
            case 'AdminController':{
                require_once('controllers/AdminController.php');
                break;
            }
            case 'HomeController':{
                require_once('controllers/HomeController.php');
                break;
            }
            case 'TourController':{
                require_once('controllers/TourController.php');
                break;
            }
            case 'ClassController':{
                require_once('controllers/ClassController.php');
                break;
            }
            case 'StudentController':{
                require_once('controllers/StudentController.php');
                break;
            }
            case 'TeacherController':{
                require_once('controllers/TeacherController.php');
                break;
            }
            case 'CompanyController':{
                require_once('controllers/CompanyController.php');
                break;
            }
            case 'AccountController':{
                require_once('controllers/AccountController.php');
                break;
            }
            case 'StudentChangePasswordController':{
                require_once('controllers/StudentChangePasswordController.php');
                break;
            }
            default:{
                require_once('controllers/LoginController.php');
                break;
            }
        }
        mysqli_close($conn);
    ?>
</body>


</html>
