<?php
$checkRegularAminClass = isset($_SESSION['checkRegularAmin']) && $_SESSION['checkRegularAmin'] ? 'hidden' : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .zone {
            width: 250px;
            padding: 0 !important;
        }

        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            height: 100vh;
            background-color: #253444;
            box-shadow: 0 0 12px rgba(0 0 0 /10%);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 200;
        }

        .sidebar-logo {
            display: flex;
            justify-content: center;
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }

        .sidebar-nav {
            padding: 20px 0;
        }

        .sidebar-logo>img {
            width: 92px;
        }

        .sidebar-nav ul {
            list-style: none;
            padding: 0;
        }

        .sidebar-nav li {
            transition: all 0.3s linear;
        }

        .sidebar-nav li svg {
            width: 20px;
            height: 20px;
            margin-right: 8px;
        }

        .sidebar-nav li a {
            padding: 16px 24px;
            display: flex;
            align-items: center;
            width: 100%;
            color: #fff;
            text-decoration: none;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .sidebar-nav li:hover,
        .active {
            background-color: #1b242f;
            border-left: 5px solid cornflowerblue;
        }

        .btn-logout {
            margin: 0 24px 20px;
            padding: 12px 20px;
            background-color: red;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s linear;
        }

        .btn-logout a {
            display: block;
            color: #fff;
            text-decoration: none;
            text-align: center;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .btn-logout:hover {
            opacity: 0.8;
        }

        .hidden {
            display: none !important;
        }
    </style>
</head>

<body>
    <div class="zone"></div>
    <div class='sidebar'>
        <div>
            <div class="sidebar-logo">
                <img src="/PHP_NHOM3/public/images/logo.png" alt="">
            </div>
            <div class="sidebar-nav">
                <ul>
                    <li>
                        <a href="/PHP_Nhom3/index.php?controller=HomeController">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            Trang chủ
                        </a>
                    </li>
                    <li>
                        <a href="/PHP_Nhom3/index.php?controller=CompanyController">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                            </svg>
                            DSCTQ sắp diễn ra
                        </a>
                    </li>
                    <li>
                        <a href="/PHP_Nhom3/index.php?controller=TourController">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                            DSCTQ đã đăng ký
                        </a>
                    </li>
                    <li>
                        <a href="/PHP_Nhom3/index.php?controller=StudentController">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                            </svg>
                            DSCTQ đã hủy
                        </a>
                    </li>
                    <li>
                        <a href="/PHP_Nhom3/index.php?controller=StudentChangePasswordController">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            Thay đổi mật khẩu
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="btn-logout">
            <a href="/PHP_Nhom3/controllers/LogoutController.php">Đăng xuất</a>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let links = document.querySelectorAll("ul li a");

            let currentUrl = window.location.href;

            links.forEach(function(link) {
                if (link.href === currentUrl) {
                    link.parentElement.classList.add("active");
                }
            });
        });
    </script>
</body>

</html>
