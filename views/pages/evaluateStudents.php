<!DOCTYPE html>
<html lang="en">

<head>
    <title>teacher tours history</title>
    <style>
        .title {
            text-align: center;
            font-size: 32px;
            color: #333;
            margin: 28px 0 40px;
            color: darkorange;
        }

        .btn:nth-child(1) {
            margin-right: 20px;
        }

        .h1-title {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class='flex-sb'>
        <div class="left">
            <?php
            include __DIR__ . '/../components/sidebarTeacher.php';
            ?>
        </div>
        <div class="right flex-grow-1">
            <?php
            include __DIR__ . '/../components/header.php';
            ?>
            <div class="container-body pad-12-0" id="notShowStudents">
                <h1 class='title'>Danh sách chuyến tham quan bạn đã tham gia</h1>
                <div class="container-table pad-0-28">
                    <table class="table table-borderless table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Mã chuyến</th>
                                <th scope="col">Tên chuyến</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Công ty</th>
                                <th scope="col">Giáo viên</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($getTourHistory) > 0) {
                                $i = 0;
                                while ($row = mysqli_fetch_assoc($getTourHistory)) {
                                    $i += 1;
                                    echo "<tr>";
                                    echo "<th scope='row'>" . $i . "</th>";
                                    echo "<td>" . $row['code'] . "</td>";
                                    echo "<td class='w-25'>" . $row['name'] . "</td>";
                                    echo "<td class='w-25'>" . $row['description'] . "</td>";
                                    echo "<td>" . $row['availables'] . "</td>";
                                    echo "<td>" . $row['companyName'] . "</td>";
                                    echo "<td>" . $row['teacherName'] . "</td>";
                                    echo "<td>
                                        <form method='POST' class='form-inline'>
                                            <input type='hidden' name='tourIDToEvaluate' value='" . $row['tourID'] . "'>
                                            <button type='submit' class='showData' name='evaluateTour'>Đánh giá</button>
                                        </form>
                                    </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr>";
                                echo "<td colspan='8' class='text-center'>Bạn chưa tham gia chuyến tham quan nào</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="pagination" id="pagination" hidden>
                        <?php
                        if ($current_page > 1 && $total_page > 1) {
                            echo '<a class="page-item" href="index.php?controller=StudentTourHistoryController&page=' . ($current_page - 1) . '">Prev</a>';
                        }
                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $current_page) {
                                echo '<span class=" page-item page-active">' . $i . '</span>';
                            } else {
                                echo '<a class="page-item" href="index.php?controller=StudentTourHistoryController&page=' . $i . '">' . $i . '</a> ';
                            }
                        }

                        if ($current_page < $total_page && $total_page > 1) {
                            echo '<a class="page-item" href="index.php?controller=StudentTourHistoryController&page=' . ($current_page + 1) . '">Next</a>';
                        }
                        ?>
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
            <div class="container-body pad-12-0" id="showStudents" hidden>
                <div class="container-table table-pad pad-0-28">
                    <div class="flex-sb-center pad-20-0">
                        <h1 class="h1-title">Danh sách sinh viên của chuyến tham quan cần đánh giá</h1>
                        <div>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#evaluteAll">Đánh giá tất cả sinh viên</button>
                            <button type="button" class="btn btn-primary" id="showDataToutNow">DS CTQ ngày hôm nay</button>
                        </div>
                    </div>
                    <?php
                    if ($rowDataTour != '') {
                        echo "
                            <ul class='list-infor list-infor-2'>
                                <div>
                                    <li>Mã chuyến tham quan: <b>" . $rowDataTour['code'] . "</b></li>
                                    <li>Tên chuyến: <b>" . $rowDataTour['name'] . "</b></li>
                                    <li>Số lượng: <b>" . $rowDataTour['availables'] . "</b></li>
                                    </div>
                                    <div>
                                    <li>Công ty: <b>" . $rowDataTour['companyName'] . "</b></li>
                                    <li>Mô tả: <b>" . $rowDataTour['description'] . "</b></li>
                                    <li>Giáo viên: <b>" . $rowDataTour['teacherName'] . "</b></li>
                                </div>
                            </ul>";
                    }
                    ?>
                    <table class="table table-borderless table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">MSV</th>
                                <th scope="col">Họ và tên</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Email</th>
                                <th scope="col">Lớp</th>
                                <th scope="col">Điểm đánh giá</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($getDataStudents) > 0) {
                                $i = 0;
                                while ($rowDataStudent = mysqli_fetch_assoc($getDataStudents)) {
                                    $i += 1;
                                    echo "<tr>";
                                    echo "<th scope='row'>" . $i . "</th>";
                                    echo "<td class='hiddenId'>" . $rowDataStudent['studentID'] . "</td>";
                                    echo "<td>" . $rowDataStudent['code'] . "</td>";
                                    echo "<td>" . $rowDataStudent['fullName'] . "</td>";
                                    echo "<td>" . $rowDataStudent['address'] . "</td>";
                                    echo "<td>" . $rowDataStudent['phoneNumber'] . "</td>";
                                    echo "<td>" . $rowDataStudent['email'] . "</td>";
                                    echo "<td>" . $rowDataStudent['classname'] . "</td>";
                                    echo "<td>" . $rowDataStudent['rate'] . "</td>";
                                    if ($rowDataStudent['rate'] == 0) {
                                        echo "<td>
                                            <button type='submit' class='showData evaluateOneStudent'>Đánh giá</button>
                                        </td>";
                                    } else {
                                        echo "<td>
                                            <button type='submit' class='update evaluateOneStudent'>Đánh giá lại</button>
                                        </td>";
                                    }
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr>";
                                echo "<td colspan='9' class='text-center'>Không thể lấy dữ liệu sinh viên</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- modal đánh giá tất cả sinh viên -->
    <div class="modal fade" id="evaluteAll" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Đánh giá sinh viên</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <br>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="rate-1" class="col-form-label">Hiểu biết của sinh viên về doanh nghiệp(0 - 20đ) </label>
                            <input type="number" class="form-control" name="rate-1" required min="0" max="20">
                        </div>
                        <div class="mb-3">
                            <label for="rate-2" class="col-form-label">Tương tác với nhân viên và đại diện doanh nghiệp(0 - 10đ) </label>
                            <input type="number" class="form-control" name="rate-2" required min="0" max="10">
                        </div>
                        <div class="mb-3">
                            <label for="rate-3" class="col-form-label">Đánh giá và phân tích môi trường làm việc(0 - 20đ): </label>
                            <input type="number" class="form-control" name="rate-3" required min="0" max="20">
                        </div>
                        <div class="mb-3">
                            <label for="rate-4" class="col-form-label">Giao tiếp linh hoạt và chân thực(0 - 20đ)</label>
                            <input type="number" class="form-control" name="rate-4" required min="0" max="20">
                        </div>
                        <div class="mb-3">
                            <label for="rate-5" class="col-form-label">Chấp hành đầy đủ quy định nhà trường(0 - 10đ)</label>
                            <input type="number" class="form-control" name="rate-5" required min="0" max="10">
                        </div>
                        <div class="mb-3">
                            <label for="rate-6" class="col-form-label">Chấp hành quy định khi tham quan doanh nghiệp(0 - 20đ)</label>
                            <input type="number" class="form-control" name="rate-6" required min="0" max="20">
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary" name="evaluateAllStudent">Đánh giá</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal đánh giá từng sinh viên -->
    <div class="modal fade" id="evalute" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Đánh giá sinh viên</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <br>
                    <form method="POST">
                        <input type="hidden" class="form-control" name="studentIDToRate" id="studentID">
                        <div class="mb-3">
                            <label for="code" class="col-form-label">Mã sinh viên:</label>
                            <input type="text" class="form-control" name="code" id="code" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="fulName" class="col-form-label">Tên sinh viên: </label>
                            <input type="text" class="form-control" name="fullName" id="fullName" disabled>
                        </div>
                        <hr>
                        <h5 style="text-align: center;">Đánh giá</h5>
                        <hr>
                        <input type="hidden" class="form-control" name="tourIDToEvaluateAllStudent" value="<?php echo $tourIDToEvaluate; ?>">
                        <div class="mb-3">
                            <label for="rate-1" class="col-form-label">Hiểu biết của sinh viên về doanh nghiệp(0 - 20đ) </label>
                            <input type="number" class="form-control" name="rate-1" required min="0" max="20">
                        </div>
                        <div class="mb-3">
                            <label for="rate-2" class="col-form-label">Tương tác với nhân viên và đại diện doanh nghiệp(0 - 10đ) </label>
                            <input type="number" class="form-control" name="rate-2" required min="0" max="10">
                        </div>
                        <div class="mb-3">
                            <label for="rate-3" class="col-form-label">Đánh giá và phân tích môi trường làm việc(0 - 20đ): </label>
                            <input type="number" class="form-control" name="rate-3" required min="0" max="20">
                        </div>
                        <div class="mb-3">
                            <label for="rate-4" class="col-form-label">Giao tiếp linh hoạt và chân thực(0 - 20đ)</label>
                            <input type="number" class="form-control" name="rate-4" required min="0" max="20">
                        </div>
                        <div class="mb-3">
                            <label for="rate-5" class="col-form-label">Chấp hành đầy đủ quy định nhà trường(0 - 10đ)</label>
                            <input type="number" class="form-control" name="rate-5" required min="0" max="10">
                        </div>
                        <div class="mb-3">
                            <label for="rate-6" class="col-form-label">Chấp hành quy định khi tham quan doanh nghiệp(0 - 20đ)</label>
                            <input type="number" class="form-control" name="rate-6" required min="0" max="20">
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary" name="evaluateEachStudent">Đánh giá</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        <?php echo $scriptShowData ?>
        <?php echo $scriptShowPage2 ?>
        document.getElementById('showDataToutNow').addEventListener('click', function() {
            document.getElementById('notShowStudents').hidden = false;
            document.getElementById('showStudents').hidden = true;
        });
        $(document).ready(function() {
            $('.evaluateOneStudent').on('click', function() {
                $('#evalute').modal('show');
                $tr = $(this).closest('tr');
                let data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();
                console.log(data);
                $('#studentID').val(data[0]);
                $('#code').val(data[1]);
                $('#fullName').val(data[2]);
            });
        });
    </script>

</body>

</html>
