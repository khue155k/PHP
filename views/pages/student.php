<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị sinh viên</title>
    <style>
    </style>
</head>

<body>
    <?php
        include_once __DIR__ . '/../../controllers/StudentController.php';  
    ?>
    <div class='flex-sb student'>
        
        <div class="student-left">
            <?php
            include __DIR__ . '/../components/sidebarAdmin.php';
            ?>
        </div>
        <div class="student-right flex-grow-1">
            <?php
            include __DIR__ . '/../components/header.php';
            ?>
            <div class="container pad-0-28">
                <div class="flex-sb-center pad-20-0">
                    <h1 class="h1-title">Danh sách sinh viên</h1>
                    <button type="button" class="btn btn-primary">Tạo sinh viên</button>
                </div>

                <!-- modal create -->
                <div class="modal fade" id="createStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tạo sinh viên</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                            <option value="Sinh viên sinh viên">Sinh viên sinh viên</option>
                                            <option value="Sinh viên giáo viên"> Sinh viên giáo viên</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-primary" name="createStudent">Tạo tài
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
                                    <th scope="col">Mã sinh viên</th>
                                    <th scope="col">Họ tên</th>
                                    <th scope="col">Ngày sinh</th>
                                    <th scope="col">Địa chỉ</th>
                                    <th scope="col">Điện thoại</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Lớp</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($dataStudents) > 0) {
                                    $i = 0;
                                    while ($row = mysqli_fetch_assoc($dataStudents)) {
                                        $i += 1;
                                        echo "<tr>";
                                        echo "<th scope='row'>" . $i . "</th>";
                                        echo "<td class='hiddenId'>" . $row['studentID'] . "</td>";
                                        echo "<td>" . $row['code'] . "</td>";
                                        echo "<td>" . $row['fullName'] . "</td>";
                                        echo "<td>" . $row['birthDate'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td>" . $row['phoneNumber'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td><button class='update update-student'>Sửa</button>
                                                <button class='delete deleteStudent'>Xóa</button></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td colspan='5'> Lỗi truy vấn: " . mysqli_error($conn) . "</td>";
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

</body>
</html>