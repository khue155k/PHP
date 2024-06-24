<!DOCTYPE html>
<html lang="en">

<head>
    <title>student tours history</title>
    <style>
        .title {
            text-align: center;
            font-size: 32px;
            color: #333;
            margin: 28px 0 40px;
            color: darkorange;
        }
    </style>
</head>

<body>
    <div class='flex-sb'>
        <div class="left">
            <?php
            include __DIR__ . '/../components/sidebarUser.php';
            ?>
        </div>
        <div class="right flex-grow-1">
            <?php
            include __DIR__ . '/../components/header.php';
            ?>
            <div class="container-body pad-12-0">
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
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr>";
                                echo "<td colspan='7' class='text-center'>Bạn chưa tham gia chuyến tham quan nào</td>";
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
    </div>
    <script>
        <?php echo $scriptShowData ?>
    </script>
</body>

</html>
