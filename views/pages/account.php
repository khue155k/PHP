<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị tài khoản</title>
    <style>
    .hiddenId {
        display: none;
    }
    </style>
</head>

<body>
    <?php
        include_once __DIR__ . '/../../controllers/AccountController.php';  
    ?>
    <div class='flex-sb account'>
        <div class="account-left">
            <?php
                include __DIR__ . '/../components/sidebarAdmin.php';
            ?>
        </div>
        <div class="account-right flex-grow-1">
            <?php
                include __DIR__ . '/../components/header.php';
            ?>
            <div class="container pad-0-28">
                <div class="flex-sb-center pad-20-0 mt-12">
                    <h1 class="h1-title">Danh sách tài khoản</h1>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createAccount">Tạo tài khoản</button>
                </div>

                <!-- modal create -->
                <div class="modal fade" id="createAccount" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tạo tài khoản</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <br>
                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="name" class="col-form-label">Tên đăng nhập:</label>
                                        <input required type="text" class="form-control" name="name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="col-form-label">Mật khẩu:</label>
                                        <input required type="text" class="form-control" name="password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="role" class="col-form-label">Vai trò:</label>
                                        <select class="form-control form-select" name="role">
                                            <option value="Quản lý thông thường">Quản lý thông thường</option>
                                            <option value="Toàn quyền hệ thống">Toàn quyền hệ thống</option>
                                            <option value="Tài khoản sinh viên">Tài khoản sinh viên</option>
                                            <option value="Tài khoản giáo viên"> Tài khoản giáo viên</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-primary" name="createAccount">Tạo tài
                                            khoản</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-body pad-12-0">
                    <div class="container-table">
                        <table class="table table-borderless table-hover table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên đăng nhập</th>
                                    <th scope="col">Mật khẩu</th>
                                    <th scope="col">Vai trò</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(mysqli_num_rows($dataAcounts) > 0)
                                    {
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($dataAcounts)) {
                                            $i += 1;
                                            echo "<tr>";
                                            echo "<th scope='row'>". $i ."</th>";
                                            echo "<td class='hiddenId'>" . $row['accountID'] . "</td>"; 
                                            echo "<td>" . $row['username'] . "</td>"; 
                                            echo "<td>" . $row['password'] . "</td>"; 
                                            echo "<td>" . $row['role'] . "</td>"; 
                                            echo "<td><button class='update update-account'>Sửa</button>
                                                <button class='delete deleteAccount'>Xóa</button></td>";
                                            echo "</tr>";
                                        }
                                    }else{
                                        echo "<tr>";
                                        echo "<td colspan='5'> Lỗi truy vấn: " . mysqli_error($conn). "</td>"; 
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                        <div class="pagination">
                            <?php
                            if ($current_page > 1 && $total_page > 1) {
                                echo '<a href="index.php?controller=AccountController&page=' . ($current_page - 1) . '">Prev</a> | ';
                            }
                            for ($i = 1; $i <= $total_page; $i++) {
                                if ($i == $current_page) {
                                    echo '<span>' . $i . '</span> | ';
                                } else {
                                    echo '<a href="index.php?controller=AccountController&page=' . $i . '">' . $i . '</a> | ';
                                }
                            }

                            if ($current_page < $total_page && $total_page > 1) {
                                echo '<a href="index.php?controller=AccountController&page=' . ($current_page + 1) . '">Next</a> | ';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal update -->
    <div class="modal fade" id="updateAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhập tài khoản</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <br>
                    <form method="POST">
                        <input required type="hidden" name="accountID" id="accountID">
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Tên đăng nhập:</label>
                            <input required type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="col-form-label">Mật khẩu:</label>
                            <input required type="text" class="form-control" name="password" id="password">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="col-form-label">Vai trò:</label>
                            <select class="form-control form-select" name="role" id="role">
                                <option value="Quản lý thông thường">Quản lý thông thường</option>
                                <option value="Toàn quyền hệ thống">Toàn quyền hệ thống</option>
                                <option value="Tài khoản sinh viên">Tài khoản sinh viên</option>
                                <option value="Tài khoản giáo viên">Tài khoản giáo viên</option>
                            </select>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary" name="updateAccount">Cập nhập</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal delete -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa tài khoản</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> <br>
                    Bạn có chắc chắn muốn xóa tài khoản này?
                    <br> <br>
                    <form method="POST">
                        <input required type="hidden" name="deleteID" id="deleteID">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-danger">Xóa tài khoản</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal thông báo -->
    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog"
        aria-labelledby="notificationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Thông báo</h5>
                </div>
                <div class="modal-body" id="modalMessage">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $('.update-account').on('click', function() {
            $('#updateAccount').modal('show');
            $tr = $(this).closest('tr');
            let data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            $('#accountID').val(data[0]);
            $('#name').val(data[1]);
            $('#password').val(data[2]);
            $('#role').val(data[3]);
        });
        $('.deleteAccount').on('click', function() {
            $('#deleteAccountModal').modal('show');
            $tr = $(this).closest('tr');
            let data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            console.log(data);
            $('#deleteID').val(data[0]);
        });
    });
    </script>
</body>

</html>
