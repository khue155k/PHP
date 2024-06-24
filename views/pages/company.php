<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị doanh nghiệp</title>
</head>

<body>
    <?php
        include_once __DIR__ . '/../../controllers/CompanyController.php';
    ?>
    <div class='flex-sb company'>
        <div class="company-left">
            <?php
                include __DIR__ . '/../components/sidebarAdmin.php';
            ?>
        </div>
        <div class="company-right flex-grow-1">
            <?php
                include __DIR__ . '/../components/header.php';
            ?>
            <div class="container pad-0-28" id="listCompany">
                <div class="flex-sb-center pad-20-0">
                    <h1 class="h1-title">Danh sách doanh nghiệp</h1>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createCompany">Tạo doanh nghiệp</button>
                </div>

                <!-- modal create -->
                <div class="modal fade" id="createCompany" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tạo doanh nghiệp</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <br>
                                <form method="POST">
                                    <div class="mb-3">
                                        <label for="code" class="col-form-label">Mã doanh nghiệp:</label>
                                        <input required type="text" class="form-control" name="code">
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="col-form-label">Tên doanh nghiệp: </label>
                                        <input required type="text" class="form-control" name="name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="col-form-label">Mô tả: </label>
                                        <input required type="text" class="form-control" name="description">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="col-form-label">E-mail: </label>
                                        <input required type="text" class="form-control" name="email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phoneNumber" class="col-form-label">Điện thoại: </label>
                                        <input required type="text" class="form-control" name="phoneNumber">
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="col-form-label">Địa chỉ: </label>
                                        <input required type="text" class="form-control" name="address">
                                    </div>
                                    <br>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-primary" name="createCompany">Tạo doanh nghiệp</button>
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
                                    <th scope="col">Mã doanh nghiệp</th>
                                    <th scope="col">Tên doanh nghiệp</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Điện thoại</th>
                                    <th scope="col">Địa chỉ</th>
                                    <th scope="col">Số lượng tour</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(mysqli_num_rows($dataCompanys) > 0)
                                    {
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($dataCompanys)) {
                                            $i += 1;
                                            echo "<tr>";
                                            echo "<th scope='row'>". $i ."</th>";
                                            echo "<td class='hiddenId'>" . $row['companyID'] . "</td>"; 
                                            echo "<td>" . $row['code'] . "</td>"; 
                                            echo "<td>" . $row['name'] . "</td>"; 
                                            echo "<td>" . $row['description'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['phoneNumber'] . "</td>";
                                            echo "<td>" . $row['address'] . "</td>";
                                            echo "<td>" . $row['numTours'] . "</td>";
                                            echo "<td>
                                                    <button class='update update-company'>Sửa</button>
                                                    <button class='delete delete-company'>Xóa</button>
                                                    <form method='POST' class='form-inline'>
                                                        <input type='hidden' name='companyIDToShowTours' value='" . $row['companyID'] . "'>
                                                        <button type='submit' class='showData' name='showData'>Xem danh sách tour</button>
                                                    </form>
                                                </td>";
                                                echo "</tr>";
                                            }
                                        }else{
                                            echo "<tr>";
                                            echo "<td colspan='5' class='text-center'>Không có doanh nghiệp nào</td>"; 
                                            echo "</tr>";
                                        }
                                ?>
                            </tbody>
                        </table>
                        <div class="pagination">
                            <?php
                                if ($current_page > 1 && $total_page > 1) {
                                    echo '<a class="page-item" href="index.php?controller=CompanyController&page=' . ($current_page - 1) . '">Prev</a>';
                                }
                                for ($i = 1; $i <= $total_page; $i++) {
                                    if ($i == $current_page) {
                                        echo '<span class=" page-item page-active">' . $i . '</span>';
                                    } else {
                                        echo '<a class="page-item" href="index.php?controller=CompanyController&page=' . $i . '">' . $i . '</a> ';
                                    }
                                }
                                if ($current_page < $total_page && $total_page > 1) {
                                    echo '<a class="page-item" href="index.php?controller=CompanyController&page=' . ($current_page + 1) . '">Next</a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container pad-0-28" hidden id="showData">
                <div class="flex-sb-center pad-20-0">
                    <h1 class="h1-title">Danh sách chuyến tham quan của doanh nghiệp</h1>
                    <button type="button" class="btn btn-primary" id="showListCompanys">Xem danh sách doanh nghiệp</button>
                </div>
                <div class="container-body">
                    <div class="container-table">
                        <?php
                        if (isset($dataCompany)) {
                            mysqli_num_rows($dataCompany);
                            $row = mysqli_fetch_assoc($dataCompany);
                            echo "
                            <ul class='list-infor'>
                                <li>Mã doanh nghiệp: <b>" . $row['code'] . "</b></li>
                                <li>Tên doanh nghiệp: <b>" . $row['name'] . "</b></li>
                                <li>E-mail: <b>" . $row['email'] . "</b></li>
                                <li>Điện thoại: <b>" . $row['phoneNumber'] . "</b></li>
                                <li>Địa chỉ: <b>" . $row['address'] . "</b></li>
                                <li>Số lượng chuyến tham quan: <b>" . $row['numTours'] . "</b></li>
                            </ul>";
                        }
                        ?>
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
                                    <th scope="col">Cán bộ trường dẫn đoàn</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($dataTours)){
                                    if (mysqli_num_rows($dataTours) > 0) {
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($dataTours)) {
                                            $i += 1;
                                            echo "<tr>";
                                            echo "<th scope='row'>" . $i . "</th>";
                                            echo "<td>" . $row['code'] . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['description'] . "</td>";
                                            echo "<td>" . $row['startDate'] . "</td>";
                                            echo "<td>" . $row['presentator'] . "</td>";
                                            echo "<td>" . $row['availables'] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr>";
                                        echo "<td colspan='7'>Không có chuyến tham quan nào nào</td>";
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
    <div class="modal fade" id="updateCompany" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhập doanh nghiệp</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <br>
                    <form method="POST">
                        <input required type="hidden" name="companyID" id="companyID">
                        <div class="mb-3">
                            <label for="code" class="col-form-label">Mã doanh nghiệp:</label>
                            <input required type="text" class="form-control" name="code" id="code">
                        </div>
                        <div class="mb-3">
                            <label for="classname" class="col-form-label">Tên doanh nghiệp:</label>
                            <input required type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="classname" class="col-form-label">Mô tả:</label>
                            <input required type="text" class="form-control" name="description" id="description">
                        </div>
                        <div class="mb-3">
                            <label for="classname" class="col-form-label">E-mail:</label>
                            <input required type="text" class="form-control" name="email" id="email">
                        </div>
                        <div class="mb-3">
                            <label for="classname" class="col-form-label">Điện thoại:</label>
                            <input required type="text" class="form-control" name="phoneNumber" id="phoneNumber">
                        </div>
                        <div class="mb-3">
                            <label for="classname" class="col-form-label">Địa chỉ:</label>
                            <input required type="text" class="form-control" name="address" id="address">
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary" name="updateCompany">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal delete -->
    <div class="modal fade" id="deleteCompanyModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa doanh nghiệp</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> <br>
                    Bạn có chắc chắn muốn xóa doanh nghiệp này?
                    <br> <br>
                    <form method="POST">
                        <input type="hidden" name="deleteID" id="deleteID">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-danger">Xóa doanh nghiệp</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
    document.getElementById('showListCompanys').addEventListener('click', function() {
            document.getElementById('listCompany').hidden = false;
            document.getElementById('showData').hidden = true;
    });
    $(document).ready(function() {
        $('.update-company').on('click', function() {
            $('#updateCompany').modal('show');
            $tr = $(this).closest('tr');
            let data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            $('#companyID').val(data[0]);
            $('#code').val(data[1]);
            $('#name').val(data[2]);
            $('#description').val(data[3]);
            $('#email').val(data[4]);
            $('#phoneNumber').val(data[5]);
            $('#address').val(data[6]);
        });
        $('.delete-company').on('click', function() {
            $('#deleteCompanyModal').modal('show');
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
