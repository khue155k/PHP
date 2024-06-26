


    <?php
    //pagination
    $pagination = mysqli_query($conn, "SELECT COUNT(companyID) AS total FROM company");
    $row = mysqli_fetch_assoc($pagination);
    $total_records = $row['total'];
    
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 6;
    $total_page = ceil($total_records / $limit);
    
    if ($current_page > $total_page) $current_page = $total_page;
            else if ($current_page < 1) $current_page = 1;
    
    $start = ($current_page - 1) * $limit >=0 ? ($current_page - 1) * $limit : 0;
    
    // read
    $dataCompanysSql = "SELECT company.*, COUNT(tour.tourID) AS numTours
                      FROM company
                      LEFT JOIN tour ON company.companyID = tour.companyID
                      GROUP BY company.companyID
                      LIMIT $start, $limit";
    $dataCompanys = mysqli_query($conn, $dataCompanysSql);
    $scriptShowData="";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['showData'])) {
            $companyIDShow = $_POST["companyIDToShowTours"];
            echo "<script>console.log('". $companyIDShow ."')</script>" ;
            $dataCompanySql = "SELECT company.*, COUNT(tour.tourID) AS numTours
                      FROM company
                      LEFT JOIN tour ON company.companyID = tour.companyID
                      WHERE company.companyID = $companyIDShow
                      GROUP BY company.companyID";
            $dataCompany = mysqli_query($conn, $dataCompanySql);    
            $dataTourSql = "SELECT tour.code, name, description, startDate, presentator, availables, teacher.fullName
                               FROM tour LEFT JOIN teacher ON tour.teacherID = teacher.teacherID
                               WHERE companyID = $companyIDShow";

            $dataTours = mysqli_query($conn, $dataTourSql);
            $scriptShowData = "
                document.getElementById('listCompany').hidden = true;
                document.getElementById('showData').hidden = false;";
        }
    }


// create
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['createCompany'])) {
        $code = $_POST["code"];
        $name = $_POST["name"];
        $description = $_POST["description"];
        $email = $_POST["email"];
        $phoneNumber = $_POST["phoneNumber"];
        $address = $_POST["address"]; 

        $checkCompanySql = "SELECT * FROM company WHERE code = '$code'";
        $checkCompanyResult = mysqli_query($conn, $checkCompanySql);
        if (mysqli_num_rows($checkCompanyResult) > 0) {
            echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Mã doanh nghiệp đã tồn tại';
                            $('#notificationModal').modal('show');
                        });
                    </script>";
        } else {
            $createCompanySql = "INSERT INTO company(code, name, description, address, phoneNumber, email) VALUES('$code', '$name', '$description', '$address', '$phoneNumber', '$email')";
            if (!mysqli_query($conn, $createCompanySql)) {
                $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
                echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('modalMessage').innerText = 'Thêm doanh nghiệp thất bại: $errorMessage';
                                $('#notificationModal').modal('show');
                            });
                          </script>";
            } else {
                echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('modalMessage').innerText = 'Thêm doanh nghiệp thành công';
                                $('#notificationModal').modal('show');
                                setTimeout(function(){
                                    window.location.href = '/PHP_Nhom3/index.php?controller=CompanyController';
                                }, 2000);
                            });
                        </script>";
            }
        }
    }
}


// update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['updateCompany'])) {
        $companyID = $_POST["companyID"];
        $code = $_POST["code"];
        $name = $_POST["name"];
        $description = $_POST["description"];
        $email = $_POST["email"];
        $phoneNumber = $_POST["phoneNumber"];
        $address = $_POST["address"];  
        $checkCompanySql = "SELECT * FROM company WHERE code = '$code'";
        $checkCompanyResult = mysqli_query($conn, $checkCompanySql);
        $createCompanySql = "UPDATE company SET name = '$name', description = '$description',email = '$email', phoneNumber = '$phoneNumber', address = '$address'
                                WHERE companyID = $companyID";
        if (!mysqli_query($conn, $createCompanySql)) {
            $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('modalMessage').innerText = 'Sửa doanh nghiệp thất bại: $errorMessage';
                            $('#notificationModal').modal('show');
                        });
                    </script>";
        } else {
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                         document.getElementById('modalMessage').innerText = 'Sửa doanh nghiệp thành công';
                        $('#notificationModal').modal('show');
                        setTimeout(function(){
                            window.location.href = '/PHP_Nhom3/index.php?controller=CompanyController';
                        }, 2000);
                    });
                </script>";
        } 
    }
}

// delete
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["deleteID"])) {
        $deleteId = $_POST["deleteID"];
        
       
        $getQualityCompany = "SELECT COUNT(tourID) AS numTours FROM tour WHERE companyID = '$deleteId'";
        $dataAll = mysqli_query($conn, $getQualityCompany);
        if ($dataAll) {
            $rowAll = mysqli_fetch_assoc($dataAll);
            
            if ($rowAll['numTours'] > 0) {
                echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            document.getElementById('modalMessage').innerText = 'Không thể xóa doanh nghiệp này vì doanh nghiệp này vẫn còn chuyến tham quan.';
                            $('#notificationModal').modal('show');
                            setTimeout(function(){
                                window.location.href = '/PHP_Nhom3/index.php?controller=CompanyController';
                            }, 2000);
                        });
                    </script>";
            } else {
                // Xóa doanh nghiệp nếu không còn tour
                $deleteSql = "DELETE FROM company WHERE companyID = '$deleteId'";
                
                if (mysqli_query($conn, $deleteSql)) {
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('modalMessage').innerText = 'Doanh nghiệp đã được xóa thành công';
                                $('#notificationModal').modal('show');
                                setTimeout(function(){
                                    window.location.href = '/PHP_Nhom3/index.php?controller=CompanyController';
                                }, 2000);
                            });
                        </script>";
                } else {
                    $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
                    echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('modalMessage').innerText = 'Xóa doanh nghiệp thất bại: $errorMessage';
                                $('#notificationModal').modal('show');
                                setTimeout(function(){
                                    window.location.href = '/PHP_Nhom3/index.php?controller=CompanyController';
                                }, 2000);
                            });
                        </script>";
                }
            }
        } else {
            // Xử lý trường hợp có lỗi trong quá trình truy vấn
            $errorMessage = mysqli_real_escape_string($conn, mysqli_error($conn));
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('modalMessage').innerText = 'Đã xảy ra lỗi khi kiểm tra số lượng tour: $errorMessage';
                        $('#notificationModal').modal('show');
                        setTimeout(function(){
                            window.location.href = '/PHP_Nhom3/index.php?controller=CompanyController';
                        }, 2000);
                    });
                </script>";
        }
    }
}


require_once __DIR__ . '/../views/pages/company.php';

    
    
    