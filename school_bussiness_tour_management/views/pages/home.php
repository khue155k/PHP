<!DOCTYPE html>
<html lang="en">

<head>
    <title>home</title>
</head>

<body>
    <h1>
        Welcome <?php session_start(); echo $_SESSION['username'] ?>
    </h1>

</body>

</html>