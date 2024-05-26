<?php
include('../db/connect.php');
?>
<?php
if (isset($_POST['capnhatdonhang'])) {
    $xuly = $_POST['xuly'];
    $mahang = $_POST['mahang_xuly'];
    $sql_update_donhang = mysqli_query($conn, "UPDATE tbl_donhang SET tinhtrang='$xuly' WHERE mahang='$mahang'");
    $sql_update_giaodich = mysqli_query($conn, "UPDATE tbl_giaodich SET tinhtrangdon='$xuly' WHERE magiaodich='$mahang'");
    header('Location: xulydonhang.php');
}
?>
<?php
if (isset($_GET['xoadonhang'])) {
    $mahang = $_GET['xoadonhang'];
    $sql_delete = mysqli_query($conn, "DELETE FROM tbl_donhang WHERE mahang='$mahang'");
    header('Location: xulydonhang.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../css/styles.css" rel="stylesheet" type="text/css" media="all" />
    <title>Đơn hàng</title>
    <style>
        .navbar {
            margin-bottom: 20px;
        }
        .container {
            margin-top: 20px;
        }
        .table {
            margin-bottom: 20px;
        }
        .form-control,
        .btn-primary {
            margin-bottom: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
        .card-header {
            font-weight: bold;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="xulydonhang.php">Quản lý đơn hàng</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="xulydonhang.php">Đơn hàng</a>
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
    </div>
</nav>

<div class="container">
    <div class="row">
        <?php
        if (isset($_GET['quanly']) && $_GET['quanly'] == 'xemdonhang' && isset($_GET['mahang'])) {
            $mahang = $_GET['mahang'];
            $sql_chitiet = mysqli_query($conn, "SELECT * FROM tbl_donhang, tbl_sanpham WHERE tbl_donhang.sanpham_id=tbl_sanpham.sanpham_id AND tbl_donhang.mahang='$mahang'");
            ?>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Chi tiết đơn hàng</div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Thứ tự</th>
                                        <th>Mã hàng</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Tổng tiền</th>
                                        <th>Ngày đặt</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 0;
                                while ($row_donhang = mysqli_fetch_array($sql_chitiet)) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row_donhang['mahang']; ?></td>
                                        <td><?php echo $row_donhang['sanpham_name']; ?></td>
                                        <td><?php echo $row_donhang['soluong']; ?></td>
                                        <td><?php echo number_format($row_donhang['soluong'] * $row_donhang['sanpham_khuyenmai']) . ' vnd'; ?></td>
                                        <td><?php echo $row_donhang['ngaythang']; ?></td>
                                        <input type="hidden" name="mahang_xuly" value="<?php echo $row_donhang['mahang']; ?>">
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <select class="form-control" name="xuly">
                                <option value="1">Đã xử lý</option>
                                <option value="0">Chưa xử lý</option>
                            </select>
                            <input type="submit" name="capnhatdonhang" value="Cập nhật đơn hàng" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Danh sách đơn hàng</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Thứ tự</th>
                                    <th>Mã hàng</th>
                                    <th>Tình trạng</th>
                                    <th>Tên khách hàng</th>
                                    <th>Số điện thoại</th>
                                    <th>Ngày đặt</th>
                                    <th>Ghi chú</th>
                                    <th>Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_select = mysqli_query($conn, "SELECT * FROM tbl_sanpham, tbl_khachhang, tbl_donhang WHERE tbl_donhang.sanpham_id=tbl_sanpham.sanpham_id AND tbl_donhang.khachhang_id=tbl_khachhang.khachhang_id GROUP BY mahang DESC");
                            $i = 0;
                            while ($row_donhang = mysqli_fetch_array($sql_select)) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row_donhang['mahang']; ?></td>
                                    <td><?php echo $row_donhang['tinhtrang'] == 0 ? 'Chưa xử lý' : 'Đã xử lý'; ?></td>
                                    <td><?php echo $row_donhang['name']; ?></td>
                                    <td><?php echo $row_donhang['phone']; ?></td>
                                    <td><?php echo $row_donhang['ngaythang']; ?></td>
                                    <td><?php echo $row_donhang['note']; ?></td>
                                    <td>
                                        <a href="?xoadonhang=<?php echo $row_donhang['mahang']; ?>" class="btn btn-danger btn-sm">Xóa</a>
                                        <a href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['mahang']; ?>" class="btn btn-info btn-sm">Xem</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
</body>
</html>
