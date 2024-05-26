<?php
include('../db/connect.php');
?>
<?php
if (isset($_POST['themdanhmuc'])) {
    $tendanhmuc = $_POST['danhmuc'];
    $sql_insert = mysqli_query($conn, "INSERT INTO tbl_category(category_name) VALUES ('$tendanhmuc')");
} elseif (isset($_POST['suadanhmuc'])) {
    $id_post = $_POST['id_danhmuc'];
    $tendanhmuc = $_POST['danhmuc'];
    $sql_update = mysqli_query($conn, "UPDATE tbl_category SET category_name='$tendanhmuc' WHERE category_id='$id_post'");
    header('Location:xulydanhmuc.php');
}
if (isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    $sql_xoa = mysqli_query($conn, "DELETE FROM tbl_category WHERE category_id='$id'");
    header('Location:xulydanhmuc.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <title>Danh mục</title>
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
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="xulydonhang.php">Quản lý danh mục</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="xulydonhang.php">Đơn hàng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="xulydanhmuc.php">Danh mục</a>
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
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <?php echo isset($_GET['quanly']) && $_GET['quanly'] == 'sua' ? 'Sửa danh mục' : 'Thêm danh mục'; ?>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <?php
                        if (isset($_GET['quanly']) && $_GET['quanly'] == 'sua') {
                            $id = $_GET['id'];
                            $sql_sua = mysqli_query($conn, "SELECT * FROM tbl_category WHERE category_id='$id'");
                            $row_sua = mysqli_fetch_array($sql_sua);
                            ?>
                            <input type="hidden" name="id_danhmuc" value="<?php echo $row_sua['category_id'] ?>">
                            <input type="text" name="danhmuc" class="form-control" value="<?php echo $row_sua['category_name'] ?>" required>
                            <input type="submit" name="suadanhmuc" class="btn btn-primary" value="Sửa danh mục">
                            <?php
                        } else {
                            ?>
                            <input type="text" name="danhmuc" class="form-control" placeholder="Tên danh mục" required>
                            <input type="submit" name="themdanhmuc" class="btn btn-primary" value="Thêm danh mục">
                            <?php
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Danh sách danh mục</div>
                <div class="card-body">
                    <?php
                    $sql_select = mysqli_query($conn, "SELECT * FROM tbl_category ORDER BY category_id DESC");
                    ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Thứ tự</th>
                                <th>Tên danh mục</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 0;
                        while ($row_category = mysqli_fetch_array($sql_select)) {
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row_category['category_name']; ?></td>
                                <td>
                                    <a href="?xoa=<?php echo $row_category['category_id']; ?>" class="btn btn-danger btn-sm">Xóa</a>
                                    <a href="?quanly=sua&id=<?php echo $row_category['category_id']; ?>" class="btn btn-info btn-sm">Sửa</a>
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
</div>
</body>
</html>
