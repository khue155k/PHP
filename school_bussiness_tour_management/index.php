<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="public/css/base.css">
</head>

<body>
    <?php
    // connect DB
    include 'models/database.php';
    $db =  new Database;
    $db->__construct();
    
    // config route
    if(isset($_GET['controller']))
    {
        $controller = $_GET['controller'];
    }else{
        $controller = '';
    }

    switch($controller){
        case 'login' :{
            require_once('controllers/LoginController.php');
            break;
        }
        case 'admin' :{
            require_once('controllers/AdminController.php');
            break;
        }
        case 'home' :{
            require_once('controllers/HomeController.php');
            break;
        }
        default:{
            require_once('controllers/LoginController.php');
            break;
        }
    }
?>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>

</body>

</html>