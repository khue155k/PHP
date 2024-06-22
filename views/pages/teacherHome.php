<!DOCTYPE html>
<html lang="en">

<head>
    <title>home</title>
    <link rel="stylesheet" href="/PHP_Nhom3/public/css/home.css">
</head>

<body>
    <div class='home flex-sb'>
        <div class="home-left">
            <?php
                include __DIR__ . '/../components/sidebarTeacher.php';
            ?>
        </div>
        <div class="home-right flex-grow-1">
            <?php
                include __DIR__ . '/../components/header.php';
            ?>
            <div class="container-body pad-12-0">
                <div class="list-card">
                    <div class="card-item">
                        <div class="card-item-content">
                            <h1>Sinh viên</h1>
                            <p>Số lượng: <?php echo $qofStudent;?> </p>
                        </div>
                        <div class="card-item-image">
                            <img src="/PHP_Nhom3/public/images/students.png" alt="student">
                        </div>
                    </div>
                    <div class="card-item">
                        <div class="card-item-content">
                            <h1>Giáo viên</h1>
                            <p>Số lượng: <?php echo $qofTeacher;?> </p>
                        </div>
                        <div class="card-item-image">
                            <img src="/PHP_Nhom3/public/images/teacher.png" alt="">
                        </div>
                    </div>
                    <div class="card-item">
                        <div class="card-item-content">
                            <h1>Doanh nghiệp</h1>
                            <p>Số lượng: <?php echo $qofCompany;?> </p>
                        </div>
                        <div class="card-item-image">
                            <img src="/PHP_Nhom3/public/images/office-building.png" alt="">
                        </div>
                    </div>
                    <div class="card-item">
                        <div class="card-item-content">
                            <h1>Chuyến tham quan</h1>
                            <p>Số lượng: <?php echo $qofTour;?> </p>
                        </div>
                        <div class="card-item-image">
                            <img src="/PHP_Nhom3/public/images/tour-bus.png" alt="">
                        </div>
                    </div>
                </div>
                <h1 class='title'>Danh sách các chuyến tham quan hôm nay của bạn</h1>
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
