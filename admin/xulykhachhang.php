<?php
    include('../db/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <title>Khách hàng</title>
    <style>
        body {
            padding-top: 20px;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .container {
            margin-top: 20px;
        }
        .table-section {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Quản lý khách hàng</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="xulydonhang.php">Đơn hàng <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="xulydanhmuc.php">Danh mục</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="xulysanpham.php">Dịch vụ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="xulykhachhang.php">Khách hàng</a>
      </li>
    </ul>
  </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12 table-section">
            <h4>Danh sách khách hàng</h4>
            <?php
                $sql_select_khachhang = mysqli_query($conn, "SELECT * FROM tbl_khachhang, tbl_giaodich WHERE tbl_khachhang.khachhang_id = tbl_giaodich.khachhang_id GROUP BY tbl_giaodich.magiaodich ORDER BY tbl_khachhang.khachhang_id DESC");
            ?>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Thứ tự</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Email</th>
                        <th>Ngày đặt</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    while($row_khachhang = mysqli_fetch_array($sql_select_khachhang)){
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo htmlspecialchars($row_khachhang['name']); ?></td>
                        <td><?php echo htmlspecialchars($row_khachhang['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row_khachhang['address']); ?></td>
                        <td><?php echo htmlspecialchars($row_khachhang['email']); ?></td>
                        <td><?php echo htmlspecialchars($row_khachhang['ngaythang']); ?></td>
                        <td>
                            <a href="?quanly=xemgiaodich&khachhang=<?php echo htmlspecialchars($row_khachhang['magiaodich']); ?>" class="btn btn-info btn-sm">Xem giao dịch</a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Lịch sử đơn hàng</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Thứ tự</th>
                                    <th>Mã giao dịch</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Ngày đặt</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($_GET['khachhang'])) {
                                $magiaodich = $_GET['khachhang'];
                            } else {
                                $magiaodich = '';
                            }
                            $sql_select = mysqli_query($conn, "SELECT * FROM tbl_giaodich, tbl_khachhang, tbl_sanpham WHERE tbl_giaodich.sanpham_id=tbl_sanpham.sanpham_id AND tbl_khachhang.khachhang_id = tbl_giaodich.khachhang_id AND tbl_giaodich.magiaodich = '$magiaodich' ORDER BY tbl_giaodich.giaodich_id DESC");
                            $i = 0;
                            while ($row_donhang = mysqli_fetch_array($sql_select)) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row_donhang['magiaodich']; ?></td>
                                    <td><?php echo $row_donhang['sanpham_name']; ?></td>
                                    <td><?php echo $row_donhang['ngaythang']; ?></td>
                                   
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>    
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
