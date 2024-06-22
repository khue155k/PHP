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
                        <a href="/PHP_Nhom3/index.php?controller=TeacherHomeController">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            Trang chủ
                        </a>
                    </li>
                    <li>
                        <a href="/PHP_Nhom3/index.php?controller=StudentRegisterTourController">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm.75-10.25v2.5h2.5a.75.75 0 0 1 0 1.5h-2.5v2.5a.75.75 0 0 1-1.5 0v-2.5h-2.5a.75.75 0 0 1 0-1.5h2.5v-2.5a.75.75 0 0 1 1.5 0Z" clip-rule="evenodd" />
                            </svg>
                            Đăng ký tham quan
                        </a>
                    </li>
                    <li>
                        <a href="/PHP_Nhom3/index.php?controller=StudentDeleteTourRegistrationController">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                <path d="M2 3a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3Z" />
                                <path fill-rule="evenodd" d="M13 6H3v6a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V6ZM5.72 7.47a.75.75 0 0 1 1.06 0L8 8.69l1.22-1.22a.75.75 0 1 1 1.06 1.06L9.06 9.75l1.22 1.22a.75.75 0 1 1-1.06 1.06L8 10.81l-1.22 1.22a.75.75 0 0 1-1.06-1.06l1.22-1.22-1.22-1.22a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                            </svg>
                            Hủy đăng ký TQDN
                        </a>
                    </li>
                    <li>
                        <a href="/PHP_Nhom3/index.php?controller=StudentTourHistoryController">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                <path fill-rule="evenodd" d="M15 8c0 .982-.472 1.854-1.202 2.402a2.995 2.995 0 0 1-.848 2.547 2.995 2.995 0 0 1-2.548.849A2.996 2.996 0 0 1 8 15a2.996 2.996 0 0 1-2.402-1.202 2.995 2.995 0 0 1-2.547-.848 2.995 2.995 0 0 1-.849-2.548A2.996 2.996 0 0 1 1 8c0-.982.472-1.854 1.202-2.402a2.995 2.995 0 0 1 .848-2.547 2.995 2.995 0 0 1 2.548-.849A2.995 2.995 0 0 1 8 1c.982 0 1.854.472 2.402 1.202a2.995 2.995 0 0 1 2.547.848c.695.695.978 1.645.849 2.548A2.996 2.996 0 0 1 15 8Zm-3.291-2.843a.75.75 0 0 1 .135 1.052l-4.25 5.5a.75.75 0 0 1-1.151.043l-2.25-2.5a.75.75 0 1 1 1.114-1.004l1.65 1.832 3.7-4.789a.75.75 0 0 1 1.052-.134Z" clip-rule="evenodd" />
                            </svg>
                            DSCTQ đã đi
                        </a>
                    </li>
                    <li>
                        <a href="/PHP_Nhom3/index.php?controller=StudentChangeInforController">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            Thông tin cá nhân
                        </a>
                    </li>
                    <li>
                        <a href="/PHP_Nhom3/index.php?controller=TeacherChangePasswordController">
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
            let findQuery = currentUrl.indexOf('&');
            let currentUrlNotQuery = '';
            if(findQuery > 0)
            {
                currentUrlNotQuery = currentUrl.slice(0, findQuery);
            }else{
                currentUrlNotQuery = currentUrl;
            }
            links.forEach(function(link) {
                if (link.href === currentUrlNotQuery) {
                    link.parentElement.classList.add("active");
                }
            });
        });
    </script>
</body>

</html>
