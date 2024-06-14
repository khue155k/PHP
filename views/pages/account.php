    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Quản trị tài khoản</title>
        <style>

        </style>
    </head>

    <body>
        <script>
         function loadAccount(accountID) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/PHP_Nhom3/controllers/AccountController.php?id=' + accountID, true);
            xhr.send();
        }
        </script>
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
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="col-form-label">Mật khẩu:</label>
                                            <input type="text" class="form-control" name="password">
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
                                            <button type="submit" class="btn btn-primary">Tạo tài khoản</button>
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
                                                echo "<td>" . $row['username'] . "</td>"; 
                                                echo "<td>" . $row['password'] . "</td>"; 
                                                echo "<td>" . $row['role'] . "</td>"; 
                                                echo "<td><button class='update' data-bs-toggle='modal' data-bs-target='#updateAccount' onclick='loadAccount(\"".$row['accountID']."\")'>Sửa</button>
                                                    <button class='delete'><a class='delete-link' onclick='(e) => e.preventDefault();' href='/PHP_Nhom3/index.php?controller=AccountController&deleteAccountId=".$row['accountID']."'>Xóa</a></button></td>";
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                            <div class="mb-3">
                                <label for="name" class="col-form-label">Tên đăng nhập:</label>
                                <input type="text" class="form-control" name="name"
                                    value="<?php echo isset($rowUpdate['username']) ? $rowUpdate['username'] : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="col-form-label">Mật khẩu:</label>
                                <input type="text" class="form-control" name="password"
                                    value="<?php echo isset($rowUpdate['password']) ? $rowUpdate['password'] : '' ?>">
                            </div>
                            <div class="mb-3">
                                <label for="role" class="col-form-label">Vai trò:</label>
                                <select class="form-control form-select" name="role">
                                    <option value="Quản lý thông thường"
                                        <?php echo isset($rowUpdate['role']) && $rowUpdate['role'] == "Quản lý thông thường" ? 'selected' : '' ?>>
                                        Quản lý thông thường</option>
                                    <option value="Toàn quyền hệ thống"
                                        <?php echo isset($rowUpdate['role']) && $rowUpdate['role'] == "Toàn quyền hệ thống" ? 'selected' : '' ?>>
                                        Toàn quyền hệ thống</option>
                                    <option value="Tài khoản sinh viên"
                                        <?php echo isset($rowUpdate['role']) && $rowUpdate['role'] == "Tài khoản sinh viên" ? 'selected' : '' ?>>
                                        Tài khoản sinh viên</option>
                                    <option value="Tài khoản giáo viên"
                                        <?php echo isset($rowUpdate['role']) && $rowUpdate['role'] == "Tài khoản giáo viên" ? 'selected' : '' ?>>
                                        Tài khoản giáo viên</option>
                                </select>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-primary">Cập nhập</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </body>



    </html>
