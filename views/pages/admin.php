<!DOCTYPE html>
<html lang="en">

<head>
    <title>admin</title>
    <link rel="stylesheet" href="/PHP_Nhom3/public/css/admin.css">
</head>

<body>
    <div class='admin-home flex-sb'>
        <div class="admin-home-left">
            <?php
                include __DIR__ . '/../components/sidebarAdmin.php';
            ?>
        </div>
        <div class="admin-home-right flex-grow-1">
            <?php
                include __DIR__ . '/../components/header.php';
            ?>
            <div class="container-body pad-12-0">
                <div class="list-card">
                    <div class="card-item">
                        <a href="/PHP_Nhom3/index.php?controller=StudentController">
                            <div class="card-item-content">
                                <h1>Sinh viên</h1>
                                <p>Số lượng: <?php echo $qofStudent;?> </p>
                            </div>
                            <div class="card-item-image">
                                <img src="/PHP_Nhom3/public/images/students.png" alt="student">
                            </div>
                        </a>
                    </div>
                    <div class="card-item">
                        <a href="/PHP_Nhom3/index.php?controller=TeacherController">
                            <div class="card-item-content">
                                <h1>Giáo viên</h1>
                                <p>Số lượng: <?php echo $qofTeacher;?> </p>
                            </div>
                            <div class="card-item-image">
                                <img src="/PHP_Nhom3/public/images/teacher.png" alt="">
                            </div>
                        </a>
                    </div>
                    <div class="card-item">
                        <a href="/PHP_Nhom3/index.php?controller=CompanyController">
                            <div class="card-item-content">
                                <h1>Doanh nghiệp</h1>
                                <p>Số lượng: <?php echo $qofCompany;?> </p>
                            </div>
                            <div class="card-item-image">
                                <img src="/PHP_Nhom3/public/images/office-building.png" alt="">
                            </div>
                        </a>
                    </div>
                    <div class="card-item">
                        <a href="/PHP_Nhom3/index.php?controller=TourController">
                            <div class="card-item-content">
                                <h1>Chuyến tham quan</h1>
                                <p>Số lượng: <?php echo $qofTour;?> </p>
                            </div>
                            <div class="card-item-image">
                                <img src="/PHP_Nhom3/public/images/tour-bus.png" alt="">
                            </div>
                        </a>
                    </div>
                </div>
                <h1 class='admin-title'>Danh sách chuyến tham quan trong ngày hôm nay</h1>
                <div class="container-table table-pad">
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
                                if(mysqli_num_rows($getTourNow) > 0)
                                {
                                    $i = 0;
                                    while ($row = mysqli_fetch_assoc($getTourNow)) {
                                        $i += 1;
                                        echo "<tr>";
                                        echo "<th scope='row'>". $i ."</th>";
                                        echo "<td>" . $row['code'] . "</td>"; 
                                        echo "<td class='w-25'>" . $row['name'] . "</td>"; 
                                        echo "<td class='w-25'>" . $row['description'] . "</td>"; 
                                        echo "<td>" . $row['availables'] . "</td>";
                                        echo "<td>" . $row['companyName'] . "</td>";
                                        echo "<td>" . $row['teacherName'] . "</td>";
                                        echo "</tr>";
                                    }
                                }else{
                                    echo "<tr>";
                                    echo "<td colspan='7' class='text-center'>Không có chuyến tham quan nào diễn ra trong ngày hôm nay</td>"; 
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
