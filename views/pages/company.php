<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị doanh nghiệp</title>
    <style>
    </style>
</head>

<body>
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
                    <button type="button" class="btn btn-primary">Tạo doanh nghiệp</button>
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
                                            <label for="classname" class="col-form-label">Tên doanh nghiệp: </label>
                                        </div>
                                            <input required type="text" class="form-control" name="classname">
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
                    <!-- hien thi  -->
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
                                                echo "<td>
                                                        <button class='update update-company'>Sửa</button>
                                                        <button class='delete delete-class'>Xóa</button>
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
                </div>
            </div>
        </div>
    </div>
 
    <script>
    <?php echo $scriptShowData ?>
    // document.getElementById('showListClasses').addEventListener('click', function() {
    //         document.getElementById('listCompany').hidden = false;
    //         document.getElementById('showData').hidden = true;
    // });
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
