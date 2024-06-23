<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị giáo viên</title>
    <style>
    </style>
</head>

<body>
    <?php
    include_once __DIR__ . '/../../controllers/TeacherController.php';
    ?>
    <div class='flex-sb teacher'>

        <div class="teacher-left">
            <?php
            include __DIR__ . '/../components/sidebarAdmin.php';
            ?>
        </div>
        <div class="teacher-right flex-grow-1">
            <?php
            include __DIR__ . '/../components/header.php';
            ?>
            <div class="container pad-0-28" id="listTeachers">
                <div class="flex-sb-center pad-20-0">
                    <h1 class="h1-title">Danh sách giáo viên</h1>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTeacher">Thêm giáo viên</button>
                </div>

                <!-- modal create -->
                <div class="modal fade" id="createTeacher" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm giáo viên</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <br>
                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="code" class="col-form-label">Mã giáo viên:</label>
                                        <input type="text" class="form-control" name="code" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fullName" class="col-form-label">Họ tên:</label>
                                        <input type="text" class="form-control" name="fullName" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="role" class="col-form-label">Giới tính:</label>
                                        <select class="form-control form-select" name="gender">
                                            <option value="Nam">Nam</option>
                                            <option value="Nữ">Nữ</option>
                                            <option value="Khác">Khác</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="birthDate" class="col-form-label">Ngày sinh:</label>
                                        <input type="text" class="form-control" name="birthDate" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="col-form-label">Địa chỉ:</label>
                                        <input type="text" class="form-control" name="address" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phoneNumber" class="col-form-label">Điện thoại:</label>
                                        <input type="text" class="form-control" name="phoneNumber" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="col-form-label">Email:</label>
                                        <input type="text" class="form-control" name="email" required>
                                    </div>
                                    <br>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-primary" name="createTeacher">Thêm giáo viên</button>
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
                                    <th scope="col">Mã giáo viên</th>
                                    <th scope="col">Họ tên</th>
                                    <th scope="col">Giới tính</th>
                                    <th scope="col">Ngày sinh</th>
                                    <th scope="col">Địa chỉ</th>
                                    <th scope="col">Điện thoại</th>
                                    <th scope="col">Email</th>
                                    <th scope="col" class="w-10">Số lượng CTQ</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($dataTeachers) > 0) {
                                    $i = 0;
                                    while ($row = mysqli_fetch_assoc($dataTeachers)) {
                                        $i += 1;
                                        echo "<tr>";
                                        echo "<th scope='row'>" . $i . "</th>";
                                        echo "<td class='hiddenId'>" . $row['teacherID'] . "</td>";
                                        echo "<td>" . $row['code'] . "</td>";
                                        echo "<td>" . $row['fullName'] . "</td>";
                                        echo "<td>" . $row['gender'] . "</td>";
                                        echo "<td>" . $row['birthDate'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td>" . $row['phoneNumber'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['totalTourTeacher'] . "</td>";
                                        echo "<td><button class='update updateTeacher dp-block'>Sửa</button>
                                                <button class='delete deleteTeacher dp-block'>Xóa</button>
                                                <form method='POST'>
                                                    <input type='hidden' name='teacherID' value='" . $row['teacherID'] . "'>
                                                    <button type='submit' class='showData dp-block' name='showData'>Xem CTQ</button>
                                                </form>
                                                </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td colspan='10'>Không có giáo viên nào</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="pagination">
                            <?php
                            if ($current_page > 1 && $total_page > 1) {
                                echo '<a class="page-item" href="index.php?controller=TeacherController&page=' . ($current_page - 1) . '">Prev</a>';
                            }
                            for ($i = 1; $i <= $total_page; $i++) {
                                if ($i == $current_page) {
                                    echo '<span class="page-item page-active">' . $i . '</span>';
                                } else {
                                    echo '<a class="page-item" href="index.php?controller=TeacherController&page=' . $i . '">' . $i . '</a>';
                                }
                            }

                            if ($current_page < $total_page && $total_page > 1) {
                                echo '<a class="page-item" href="index.php?controller=TeacherController&page=' . ($current_page + 1) . '">Next</a>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container pad-0-28" id="showData" hidden>
                <div class="flex-sb-center pad-20-0">
                    <h1 class="h1-title">Các chuyến tham quan doanh nghiệp do giáo viên đại diện</h1>
                    <button type="button" class="btn btn-primary" id="showListTeachers">Xem danh sách giáo viên</button>
                </div>

                <div class="container-body">
                    <div class="container-table">
                        <?php
                        if (isset($dataTeacher)) {
                            mysqli_num_rows($dataTeacher);
                            $row = mysqli_fetch_assoc($dataTeacher);
                            echo "
                            <ul class='list-infor'>
                                <li>Mã giáo viên: <b>" . $row['code'] . "</b></li>
                                <li>Họ tên: <b>" . $row['fullName'] . "</b></li>
                                <li>Giới tính: <b>" . $row['gender'] . "</b></li>
                                <li>Ngày sinh: <b>" . $row['birthDate'] . "</b></li>
                                <li>Địa chỉ: <b>" . $row['address'] . "</b></li>
                                <li>Điện thoại: <b>" . $row['phoneNumber'] . "</b></li>
                                <li>Email: <b>" . $row['email'] . "</b></li>
                            </ul>";
                        }
                        ?>
                        <table class="table table-borderless table-hover table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Mã chuyến tham quan</th>
                                    <th scope="col">Tên chuyến tham quan</th>
                                    <th scope="col">Ngày tham quan</th>
                                    <th scope="col">Tên doanh nghiệp</th>
                                    <th scope="col">Số lượng sinh viên tham gia</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($dataTeacherTour)) {
                                    if (mysqli_num_rows($dataTeacherTour) > 0) {
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($dataTeacherTour)) {
                                            $i += 1;
                                            echo "<tr>";
                                            echo "<th scope='row'>" . $i . "</th>";
                                            echo "<td>" . $row['code'] . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['startDate'] . "</td>";
                                            echo "<td>" . $row['companyName'] . "</td>";
                                            echo "<td>" . $row['totalStudentTour'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr>";
                                        echo "<td colspan='9'> Giáo viên chưa có chuyến tham quan nào</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal update -->
    <div class="modal fade" id="updateTeacherModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhật giáo viên</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <br>
                    <form method="POST">
                        <input type="hidden" name="teacherID" id="teacherID">
                        <div class="mb-3">
                            <label for="code" class="col-form-label">Mã giáo viên:</label>
                            <input type="text" class="form-control" name="code" id="code" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="fullName" class="col-form-label">Họ tên:</label>
                            <input type="text" class="form-control" name="fullName" id="fullName" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="col-form-label">Giới tính:</label>
                            <select class="form-control form-select" name="gender" id="gender">
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                                <option value="Khác">Khác</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="birthDate" class="col-form-label">Ngày sinh:</label>
                            <input type="text" class="form-control" name="birthDate" id="birthDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="col-form-label">Địa chỉ:</label>
                            <input type="text" class="form-control" name="address" id="address" required>
                        </div>
                        <div class="mb-3">
                            <label for="phoneNumber" class="col-form-label">Điện thoại:</label>
                            <input type="text" class="form-control" name="phoneNumber" id="phoneNumber" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="text" class="form-control" name="email" id="email" required>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary" name="updateTeacher">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal delete -->
    <div class="modal fade" id="deleteTeacherModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa giáo viên</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> <br>
                    Bạn có chắc chắn muốn xóa giáo viên này?
                    <br> <br>
                    <form method="POST">
                        <input type="hidden" name="deleteID" id="deleteID">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-danger">Xóa giáo viên</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal thông báo -->
    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
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
        <?php echo $scriptShowData ?>
        document.getElementById('showListTeachers').addEventListener('click', function() {
            document.getElementById('listTeachers').hidden = false;
            document.getElementById('showData').hidden = true;
        });

        $(document).ready(function() {
            $('.updateTeacher').on('click', function() {
                $('#updateTeacherModal').modal('show');
                $tr = $(this).closest('tr');
                let data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();
                $('#teacherID').val(data[0]);
                $('#code').val(data[1]);
                $('#fullName').val(data[2]);
                $('#gender').val(data[3]);
                $('#birthDate').val(data[4]);
                $('#address').val(data[5]);
                $('#phoneNumber').val(data[6]);
                $('#email').val(data[7]);
                var classId = $(this).closest('tr').find('td[id]').attr('id');
                $('#classID').val(classId);
            });
            $('.deleteTeacher').on('click', function() {
                $('#deleteTeacherModal').modal('show');
                $tr = $(this).closest('tr');
                let data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();
                $('#deleteID').val(data[0]);
            });
        });
    </script>
</body>


</html>
