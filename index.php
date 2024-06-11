<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PHP_Nhom3/node_modules/bootstrap/dist/css/bootstrap.css">
</head>

<body>
    <?php
        include_once 'models/connect.php';
        $controller = isset($_GET['controller']) ? $_GET['controller'] : 'LoginController';

        switch($controller){
            case 'LogoutController':
            case 'LoginController' :{
                require_once('controllers/LoginController.php');
                break;
            }
            case 'AdminController' :{
                require_once('controllers/AdminController.php');
                break;
            }
            case 'HomeController' :{
                require_once('controllers/HomeController.php');
                break;
            }
            default:{
                require_once('controllers/LoginController.php');
                break;
            }
        }
    ?>
    <script src="/PHP_Nhom3/node_modules/bootstrap/dist/js/bootstrap.js"></script>

</body>


</html>
