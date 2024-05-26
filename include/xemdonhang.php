<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <style>
        /* CSS Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .tittle-w3l {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 40px;
            color: #007bff;
        }

        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .card-body {
            padding: 15px;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 12px;
            vertical-align: middle;
            border-top: 1px solid #dee2e6;
            text-align: center;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody + tbody {
            border-top: 2px solid #dee2e6;
        }

        .btn-info {
            color: #fff;
            background-color: #17a2b8;
            border-color: #17a2b8;
            padding: 5px 10px;
            border-radius: 3px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        .mb-3,
        .mb-4,
        .mb-5 {
            margin-bottom: 1rem !important;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
        }

        .mb-5 {
            margin-bottom: 3rem !important;
        }
    </style>
</head>

<body>
    <div class="ads-grid py-sm-5 py-4">
        <div class="container py-xl-4 py-lg-2">
            <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">Xem lịch đã đặt</h3>
            <div class="row">
                <div class="agileinfo-ads-display col-lg-9">
                    <div class="wrapper">
                        <div class="row">
                            <?php
                            if (isset($_SESSION['dangnhap_home'])) {
                                echo '<div class="col-12 mb-3">Đơn hàng: ' . $_SESSION['dangnhap_home'] . '</div>';
                            }
                            ?>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Danh sách đơn hàng</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Thứ tự</th>
                                                    <th>Mã giao dịch</th>
                                                    <th>Tình trạng</th>
                                                    <th>Ngày đặt</th>
                                                    <th>Quản lý</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($_GET['khachhang'])) {
                                                    $id_khachhang = $_GET['khachhang'];
                                                } else {
                                                    $id_khachhang = '';
                                                }
                                                $sql_select = mysqli_query($conn, "SELECT * FROM tbl_giaodich WHERE tbl_giaodich.khachhang_id = '$id_khachhang' GROUP BY tbl_giaodich.magiaodich ");
                                                $i = 0;
                                                while ($row_donhang = mysqli_fetch_array($sql_select)) {
                                                    $i++;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $row_donhang['magiaodich']; ?></td>
                                                        <td><?php
                                                            if ($row_donhang['tinhtrangdon'] == 0) {
                                                                echo 'Đang chờ xác nhận';
                                                            } else {
                                                                echo 'Đã xác nhận';
                                                            }
                                                            ?></td>
                                                        <td><?php echo $row_donhang['ngaythang']; ?></td>
                                                        <td>
                                                            <a href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id'] ?>&magiaodich=<?php echo htmlspecialchars($row_donhang['magiaodich']); ?>" class="btn btn-info btn-sm">Xem chi tiết</a>
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
                        </div>
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5>Chi tiết đơn hàng</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Thứ tự</th>
                                            <th>Mã giao dịch</th>
                                            <th>Tên dịch vụ</th>
                                            <th>Ngày đặt</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_GET['magiaodich'])) {
                                            $magiaodich = $_GET['magiaodich'];
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
                <!-- Side bar or other content can go here if needed -->
            </div>
        </div>
    </div>
</body>

</html>
