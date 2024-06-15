<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị lớp học</title>
</head>

<body>
    <?php
        include_once __DIR__ . '/../../controllers/ClassController.php';  
    ?>
    <div class='flex-sb classes'>
        <div class="classes-left">
            <?php
                include __DIR__ . '/../components/sidebarAdmin.php';
            ?>
        </div>
        <div class="classes-right flex-grow-1">
            <?php
                include __DIR__ . '/../components/header.php';
            ?>
            <div class="container pad-0-28">
                <div class="flex-sb-center pad-20-0">
                    <h1 class="h1-title">Danh sách lớp học</h1>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createClass">Tạo lớp học</button>
                </div>

                <!-- modal create -->
                <div class="modal fade" id="createClass" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tạo lớp học</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <br>
                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="code" class="col-form-label">Mã lớp:</label>
                                        <input type="text" class="form-control" name="code">
                                    </div>
                                    <div class="mb-3">
                                        <label for="classname" class="col-form-label">Tên lớp: </label>
                                        <input type="text" class="form-control" name="classname">
                                    </div>
                                    <br>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-primary" name="createClass">Tạo lớp học</button>
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
                                    <th scope="col">Mã lớp</th>
                                    <th scope="col">Tên lớp</th>
                                    <th scope="col">Số lượng sinh viên</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(mysqli_num_rows($dataClasses) > 0)
                                    {
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($dataClasses)) {
                                            $i += 1;
                                            echo "<tr>";
                                            echo "<th scope='row'>". $i ."</th>";
                                            echo "<td class='hiddenId'>" . $row['classID'] . "</td>"; 
                                            echo "<td>" . $row['code'] . "</td>"; 
                                            echo "<td>" . $row['name'] . "</td>"; 
                                            echo "<td>" . $row['numStudents'] . "</td>";
                                            echo "<td>
                                                    <button class='update update-class'>Sửa</button>
                                                    <button class='delete delete-class'>Xóa</button>
                                                    <button class='showData'>Xem danh sách sinh viên</button>
                                                </td>";
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
    <!-- modal update -->
    <div class="modal fade" id="updateClass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhập tài khoản</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <br>
                    <form method="POST">
                        <input type="hidden" name="classID" id="classID">
                        <div class="mb-3">
                            <label for="code" class="col-form-label">Mã lớp:</label>
                            <input type="text" class="form-control" name="code" id="code">
                        </div>
                        <div class="mb-3">
                            <label for="classname" class="col-form-label">Tên lớp:</label>
                            <input type="text" class="form-control" name="classname" id="classname">
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary" name="updateClass">Cập nhập</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal delete -->
    <div class="modal fade" id="deleteClassModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa lớp học</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> <br>
                    Bạn có chắc chắn muốn xóa lớp học này?
                    <br> <br>
                    <form method="POST">
                        <input type="hidden" name="deleteID" id="deleteID">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-danger">Xóa lớp học</button>
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
        $('.update-class').on('click', function() {
            $('#updateClass').modal('show');
            $tr = $(this).closest('tr');
            let data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            $('#classID').val(data[0]);
            $('#code').val(data[1]);
            $('#classname').val(data[2]);
        });
        $('.delete-class').on('click', function() {
            $('#deleteClassModal').modal('show');
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
