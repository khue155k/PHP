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
            <div class="container pad-0-28" id="listStudents">
                <div class="flex-sb-center pad-20-0">
                    <h1 class="h1-title">Danh sách sinh viên</h1>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createStudent">Thêm sinh viên</button>
                </div>

                <!-- modal create -->
                <div class="modal fade" id="createStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm sinh viên</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <br>
                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="code" class="col-form-label">Mã sinh viên:</label>
                                        <input type="text" class="form-control" name="code" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="fullName" class="col-form-label">Họ tên:</label>
                                        <input type="text" class="form-control" name="fullName" required>
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
                                    <div class="mb-3">
                                        <label for="classID" class="col-form-label">Lớp:</label>
                                        <select class="form-control form-select" name="classID">
                                            <?php echo $dataSelect ?>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-primary" name="createStudent">Thêm sinh viên</button>
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
                                        echo "<td id='" . $row['classID'] . "'>" . $row['name'] . "</td>";
                                        echo "<td><button class='update updateStudent dp-block'>Sửa</button>
                                                <button class='delete deleteStudent dp-block'>Xóa</button>
                                                <form method='POST'>
                                                    <input type='hidden' name='studentID' value='" . $row['studentID'] . "'>
                                                    <button type='submit' class='showData dp-block' name='showData'>Xem CTQ</button>
                                                </form>
                                                </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td colspan='9'>Không có sinh viên nào</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="container pad-0-28" id="showData" hidden>
                <div class="flex-sb-center pad-20-0">
                    <h1 class="h1-title">Chuyến tham quan sinh viên tham gia</h1>
                    <button type="button" class="btn btn-primary" id="showListStudents">Xem danh sách sinh viên</button>
                </div>

                <div class="container-body">
                    <div class="container-table">
                        <?php
                        if (isset($dataStudent)) {
                            mysqli_num_rows($dataStudent);
                            $row = mysqli_fetch_assoc($dataStudent);
                            echo "
                            <ul class='list-infor'>
                                <li>Mã sinh viên: <b>" . $row['code'] . "</b></li>
                                <li>Họ tên: <b>" . $row['fullName'] . "</b></li>
                                <li>Ngày sinh: <b>" . $row['birthDate'] . "</b></li>
                                <li>Địa chỉ: <b>" . $row['address'] . "</b></li>
                                <li>Điện thoại: <b>" . $row['phoneNumber'] . "</b></li>
                                <li>Email: <b>" . $row['email'] . "</b></li>
                                <li>Lớp: <b>" . $row['name'] . "</b></li>
                            </ul>";
                        }
                        ?>
                        <table class="table table-borderless table-hover table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Mã chuyến tham quan</th>
                                    <th scope="col">Tên chuyến tham quan</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Ngày bắt đầu</th>
                                    <th scope="col">Số ghế</th>
                                    <th scope="col">Tên doanh nghiệp</th>
                                    <th scope="col">Tên giáo viên</th>
                                    <th scope="col">Người đại diện</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($dataStudentTour)) {
                                    if (mysqli_num_rows($dataStudentTour) > 0) {
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($dataStudentTour)) {
                                            $i += 1;
                                            echo "<tr>";
                                            echo "<th scope='row'>" . $i . "</th>";
                                            echo "<td>" . $row['code'] . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['description'] . "</td>";
                                            echo "<td>" . $row['startDate'] . "</td>";
                                            echo "<td>" . $row['availables'] . "</td>";
                                            echo "<td>" . $row['companyName'] . "</td>";
                                            echo "<td>" . $row['teacherName'] . "</td>";
                                            echo "<td>" . $row['presentator'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr>";
                                        echo "<td colspan='9'> Sinh viên chưa tham gia chuyến tham quan nào</td>";
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
    <div class="modal fade" id="updateStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhật sinh viên</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <br>
                    <form method="POST">
                        <input type="hidden" name="studentID" id="studentID">
                        <div class="mb-3">
                            <label for="code" class="col-form-label">Mã sinh viên:</label>
                            <input type="text" class="form-control" name="code" id="code" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="fullName" class="col-form-label">Họ tên:</label>
                            <input type="text" class="form-control" name="fullName" id="fullName" required>
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
                        <div class="mb-3">
                            <label for="classID" class="col-form-label">Lớp:</label>
                            <select class="form-control form-select" name="classID" id="classID">
                                <?php echo $dataSelect ?>
                            </select>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary" name="updateStudent">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal delete -->
    <div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa sinh viên</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> <br>
                    Bạn có chắc chắn muốn xóa sinh viên này?
                    <br> <br>
                    <form method="POST">
                        <input type="hidden" name="deleteID" id="deleteID">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-danger">Xóa sinh viên</button>
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
        document.getElementById('showListStudents').addEventListener('click', function() {
            document.getElementById('listStudents').hidden = false;
            document.getElementById('showData').hidden = true;
        });

        $(document).ready(function() {
            $('.updateStudent').on('click', function() {
                $('#updateStudentModal').modal('show');
                $tr = $(this).closest('tr');
                let data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();
                $('#studentID').val(data[0]);
                $('#code').val(data[1]);
                $('#fullName').val(data[2]);
                $('#birthDate').val(data[3]);
                $('#address').val(data[4]);
                $('#phoneNumber').val(data[5]);
                $('#email').val(data[6]);
                var classId = $(this).closest('tr').find('td[id]').attr('id');
                $('#classID').val(classId);
            });
            $('.deleteStudent').on('click', function() {
                $('#deleteStudentModal').modal('show');
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
