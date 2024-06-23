<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị chuyến tham quan du lịch</title>
</head>

<body>
    <?php
    include_once __DIR__ . '/../../controllers/TourController.php';
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
            <div class="container pad-0-28" id="listTour">
                <div class="flex-sb-center pad-20-0">
                    <h1 class="h1-title">Danh sách chuyến tham quan doanh nghiệp</h1>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createTour">Tạo thêm</button>
                </div>

                <!-- modal create -->
                <div class="modal fade" id="createTour" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tạo Chuyến tham quan doanh
                                        nghiệp mới</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <br>
                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="code" class="col-form-label">Mã Chuyến tham quan:</label>
                                        <input required type="text" class="form-control" name="code">
                                    </div>
                                    <div class="mb-3">
                                        <label for="tourName" class="col-form-label">Tên chương trình: </label>
                                        <input required type="text" class="form-control" name="tourName">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="col-form-label">Mô tả </label>
                                        <input required type="text" class="form-control" name="description">
                                    </div>
                                    <div class="mb-3">
                                        <label for="startDate" class="col-form-label">Ngày khởi hành </label>
                                        <input required type="date" class="form-control" name="startDate">
                                    </div>
                                    <div class="mb-3">
                                        <label for="presentator" class="col-form-label">Người chịu trách nhiệm </label>
                                        <input required type="text" class="form-control" name="presentator">
                                    </div>
                                    <div class="mb-3">
                                        <label for="availables" class="col-form-label">Tổng số lượng tham gia </label>
                                        <input required type="number" class="form-control" name="availables">
                                    </div>
                                    <div class="mb-3">
                                        <label for="companyId" class="col-form-label">Công ty tham gia</label>
                                        <select class="form-control form-select" name="companyId">
                                            <?php echo $dataCompanySelect ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="teacherId" class="col-form-label">Cán bộ dẫn đoàn </label>
                                        <select class="form-control form-select" name="teacherId">
                                            <?php echo $dataTeacherSelect ?>
                                        </select>
                                    </div>

                                    <br>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-primary" name="createTour">Tạo mới
                                        </button>
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
                                    <th scope="col">Mã chuyến tham quan</th>
                                    <th scope="col">Tên chương trình</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Ngày bắt đầu</th>
                                    <th scope="col">Người chịu trách nhiệm</th>
                                    <th scope="col">Tổng số lượng tham gia</th>
                                    <th scope="col">Tên công ty</th>
                                    <th scope="col">Cán bộ trường dẫn đoàn</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($dataTour) > 0) {
                                    $i = 0;
                                    while ($row = mysqli_fetch_assoc($dataTour)) {
                                        $i += 1;
                                        echo "<tr>";
                                        echo "<th scope='row'>" . $i . "</th>";
                                        echo "<td class='hiddenId'>" . $row['tourID'] . "</td>";
                                        echo "<td>" . $row['code'] . "</td>";
                                        echo "<td>" . $row['tourName'] . "</td>";
                                        echo "<td>" . $row['description'] . "</td>";
                                        // echo "<td>" . $row['startDate'] . "</td>";
                                        echo "<td>" . date("d/m/Y", strtotime($row['startDate'])) . "</td>";
                                        echo "<td>" . $row['presentator'] . "</td>";
                                        echo "<td>" . $row['availables'] . "</td>";
                                        echo "<td id='" . $row['companyID'] . "'>" . $row['companyName'] . "</td>";
                                        echo "<td id='" . $row['teacherID'] . "'>" . $row['fullName'] . "</td>";

                                        echo "<td>
                                                    <button class='update update-tour dp-block'>Sửa</button>
                                                    <button class='delete delete-tour dp-block'>Xóa</button>
                                                    <form method='POST'>
                                                    <input type='hidden' name='tourID' value='" . $row['tourID'] . "'>
                                                    <button type='submit' class='showData dp-block' name='showData'>Xem danh sách tham gia</button>
                                                </form>
                                                </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr>";
                                    echo "<td colspan='5' class='text-center'>Không có chuyến tham quan nào</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="pagination">
                            <?php
                            if ($current_page > 1 && $total_page > 1) {
                                echo '<a class="page-item" href="index.php?controller=TourController&page=' . ($current_page - 1) . '">Prev</a>';
                            }
                            for ($i = 1; $i <= $total_page; $i++) {
                                if ($i == $current_page) {
                                    echo '<span class="page-item page-active">' . $i . '</span>';
                                } else {
                                    echo '<a class="page-item" href="index.php?controller=TourController&page=' . $i . '">' . $i . '</a>';
                                }
                            }

                            if ($current_page < $total_page && $total_page > 1) {
                                echo '<a class="page-item" href="index.php?controller=TourController&page=' . ($current_page + 1) . '">Next</a>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container pad-0-28" id="showData" hidden>
                <div class="flex-sb-center pad-20-0">
                    <h1 class="h1-title">Danh sách sinh viên tham gia chuyến tham quan</h1>
                    <button type="button" class="btn btn-primary" id="showListTours">Xem danh sách chuyến tham quan</button>
                </div>

                <div class="container-body">
                    <div class="container-table">
                        <?php
                        if (isset($dataTourSelected)) {
                            mysqli_num_rows($dataTourSelected);
                            $row = mysqli_fetch_assoc($dataTourSelected);
                            echo "
                            <ul class='list-infor'>
                                <h5>Thông tin chuyến tham quan</h5>
                                <li>Mã chuyến tham quan: <b>" . $row['code'] . "</b></li>
                                <li>Tên chuyến tham quan: <b>" . $row['tourName'] . "</b></li>
                                <li>Ngày tổ chức: <b>" . date("d/m/Y", strtotime($row['startDate'])) . "</b></li>
                                <li>Người thuyết trình - chịu trách nhiệm: <b>" . $row['presentator'] . "</b></li>
                                <li>Số lượng tối đa: <b>" . $row['availables'] . "</b></li>
                                <li>Mô tả: <b>" . $row['description'] . "</b></li>
                                <hr>
                                <li>Thông tin Doanh nghiệp:</li>
                                <li>Tên doanh nghiệp: <b>" . $row['companyName'] . "</b></li>
                                <li>Mã doanh nghiệp: <b>" . $row['companyCode'] . "</b></li>
                                <hr>
                                <li>Thông tin Cán bộ phụ trách:</li>
                                <li>Tên cán bộ: <b>" . $row['fullName'] . "</b></li>
                                <li>Số điện thoại: <b>" . $row['phoneNumber'] . "</b></li>
                            </ul>";
                        }
                        ?>
                        <table class="table table-borderless table-hover table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Mã sinh viên</th>
                                    <th scope="col">Tên sinh viên</th>
                                    <th scope="col">Địa chỉ</th>
                                    <th scope="col">Số điện thoại</th>
                                    <th scope="col">Lớp học</th>
                                    <th scope="col">Điểm đánh giá</th>
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
                                            echo "<td>" . $row['fullName'] . "</td>";
                                            echo "<td>" . $row['address'] . "</td>";
                                            echo "<td>" . $row['phoneNumber'] . "</td>";
                                            echo "<td>" . $row['classCode'] . "</td>";
                                            echo "<td>" . $row['rate'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr>";
                                        echo "<td colspan='9'> Chuyến tham quan chưa có sinh viên nào tham gia</td>";
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
    <div class="modal fade" id="updateTour" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhập Chuyến tham quan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <br>
                    <form method="POST">
                        <input required type="hidden" name="tourID" id="tourID">
                        <div class="mb-3">
                            <label for="code" class="col-form-label">Mã Chuyến tham quan:</label>
                            <input required type="text" class="form-control" name="code" id="code">
                        </div>
                        <div class="mb-3">
                            <label for="tourName" class="col-form-label">Tên chương trình: </label>
                            <input required type="text" class="form-control" name="tourName" id="tourName">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="col-form-label">Mô tả </label>
                            <input required type="text" class="form-control" name="description" id="description">
                        </div>
                        <div class="mb-3">
                            <label for="startDate" class="col-form-label">Ngày khởi hành </label>
                            <input required type="date" class="form-control" name="startDate" id="startDate">
                        </div>
                        <div class="mb-3">
                            <label for="presentator" class="col-form-label">Người chịu trách nhiệm </label>
                            <input required type="text" class="form-control" name="presentator" id="presentator">
                        </div>
                        <div class="mb-3">
                            <label for="availables" class="col-form-label">Tổng số lượng tham gia </label>
                            <input required type="number" class="form-control" name="availables" id="availables">
                        </div>
                        <div class="mb-3">
                            <label for="companyId" class="col-form-label">Công ty tham gia</label>
                            <select class="form-control form-select" name="companyId" id="companyId">
                                <?php echo $dataCompanySelect ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="teacherId" class="col-form-label">Cán bộ dẫn đoàn </label>
                            <select class="form-control form-select" name="teacherId" id="teacherId">
                                <?php echo $dataTeacherSelect ?>
                            </select>
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary" name="updateTour">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal delete -->
    <div class="modal fade" id="deleteTourModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> <br>
                    Bạn có chắc chắn muốn xóa chuyến tham quan này?
                    <br> <br>
                    <form method="POST">
                        <input required type="hidden" name="deleteID" id="deleteID">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-danger">Xóa chuyến tham quan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- modal thông báo -->
    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel"
        aria-hidden="true">
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
    document.getElementById('showListTours').addEventListener('click', function() {
        document.getElementById('listTour').hidden = false;
        document.getElementById('showData').hidden = true;
    });

    $(document).ready(function() {
        $('.update-tour').on('click', function() {
            $('#updateTour').modal('show');
            $tr = $(this).closest('tr');
            let data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            $('#tourID').val(data[0]);
            $('#code').val(data[1]);
            $('#tourName').val(data[2]);
            $('#description').val(data[3]);
            // Chuyển đổi chuỗi "2024-08-07 13:44:34" thành đối tượng Date
            var dateString = "2024-08-07 13:44:34";
            var dateObject = new Date(dateString);
            // Định dạng lại ngày tháng để phù hợp với input type="date"
            var formattedDate = dateObject.toISOString().slice(0, 10);
            // Gán giá trị vào trường input "startDate"
            $('#startDate').val(formattedDate);
            $('#presentator').val(data[5]);
            $('#availables').val(Number(data[6]));
            var companyId = $(this).closest('tr').find('td[id]').attr('id');
            $('#companyId').val(companyId);
            var teacherId = $(this).closest('tr').find('td[id]').attr('id');
            $('#teacherId').val(teacherId);
            console.log(data);
        });
        $('.delete-tour').on('click', function() {
            $('#deleteTourModal').modal('show');
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
