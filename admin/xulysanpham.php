<?php
    include('../db/connect.php');
?>
<?php
    if(isset($_POST['themsanpham'])){
        $tensanpham = $_POST['tensanpham'];
        $hinhanh = $_FILES['hinhanh']['name'];
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        $soluong = $_POST['soluong'];
        $gia = $_POST['giasanpham'];
        $giakhuyenmai = $_POST['giakhuyenmai'];
        $danhmuc = $_POST['danhmuc'];
        $chitiet = $_POST['chitiet'];
        $mota = $_POST['mota'];
        $path = '../uploads/';
        $sql_insert_product = mysqli_query($conn, "INSERT INTO tbl_sanpham(sanpham_name, sanpham_chitiet, sanpham_mota, sanpham_gia, sanpham_khuyenmai, sanpham_soluong, sanpham_image, category_id) VALUES('$tensanpham', '$chitiet', '$mota', '$gia', '$giakhuyenmai', '$soluong', '$hinhanh', '$danhmuc')");
        move_uploaded_file($hinhanh_tmp, $path.$hinhanh);
    } elseif(isset($_POST['suasanpham'])){
        $id_update = $_POST['id_update'];
        $tensanpham = $_POST['tensanpham'];
        $hinhanh = $_FILES['hinhanh']['name'];
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        $soluong = $_POST['soluong'];
        $gia = $_POST['giasanpham'];
        $giakhuyenmai = $_POST['giakhuyenmai'];
        $danhmuc = $_POST['danhmuc'];
        $chitiet = $_POST['chitiet'];
        $mota = $_POST['mota'];
        $path = '../uploads/';
        if($hinhanh == ''){
            $sql_update_image = "UPDATE tbl_sanpham SET sanpham_name='$tensanpham', sanpham_chitiet='$chitiet', sanpham_mota='$mota', sanpham_gia='$gia', sanpham_khuyenmai='$giakhuyenmai', sanpham_soluong='$soluong', category_id='$danhmuc' WHERE sanpham_id='$id_update'";
        } else {
            $sql_update_image = "UPDATE tbl_sanpham SET sanpham_name='$tensanpham', sanpham_chitiet='$chitiet', sanpham_mota='$mota', sanpham_gia='$gia', sanpham_khuyenmai='$giakhuyenmai', sanpham_soluong='$soluong', sanpham_image='$hinhanh', category_id='$danhmuc' WHERE sanpham_id='$id_update'";
            move_uploaded_file($hinhanh_tmp, $path.$hinhanh);
        }
        mysqli_query($conn, $sql_update_image);
    }

    if(isset($_GET['xoa'])){
        $id = $_GET['xoa'];
        $sql_xoa = mysqli_query($conn, "DELETE FROM tbl_sanpham WHERE sanpham_id='$id'");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <title>Quản lý dịch vụ</title>
    <style>
        body {
            padding-top: 20px;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .form-section {
            margin-bottom: 20px;
        }
        .form-section h4 {
            margin-bottom: 20px;
        }
        .table-section {
            margin-top: 20px;
        }
        .product-image {
            height: 80px;
            width: 80px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Quản lý dịch vụ</a>
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
        <div class="col-md-4 form-section">
            <?php
                if(isset($_GET['quanly']) && $_GET['quanly'] == 'sua'){
                    $id = $_GET['sua_id'];
                    $sql_sua = mysqli_query($conn, "SELECT * FROM tbl_sanpham WHERE sanpham_id='$id'");
                    $row_sua = mysqli_fetch_array($sql_sua);
                    $id_category_1 = $row_sua['category_id'];
            ?>
                <h4>Sửa dịch vụ</h4>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="tensanpham">Tên dịch vụ</label>
                    <input type="text" name="tensanpham" id="tensanpham" placeholder="Tên dịch vụ" class="form-control" value="<?php echo $row_sua['sanpham_name'] ?>"><br>
                    <input type="hidden" name="id_update" value="<?php echo $row_sua['sanpham_id'] ?>">
                    <label for="hinhanh">Hình ảnh</label>
                    <input type="file" name="hinhanh" id="hinhanh" class="form-control"><br>
                    <img src="../uploads/<?php echo $row_sua['sanpham_image'] ?>" class="product-image"><br>
                    <label for="giasanpham">Giá</label>
                    <input type="text" name="giasanpham" id="giasanpham" value="<?php echo $row_sua['sanpham_gia'] ?>" class="form-control"><br>
                    <label for="giakhuyenmai">Giá khuyến mãi</label>
                    <input type="text" name="giakhuyenmai" id="giakhuyenmai" value="<?php echo $row_sua['sanpham_khuyenmai'] ?>" class="form-control"><br>
                    <label for="soluong">Số lượng sản phẩm</label>
                    <input type="text" name="soluong" id="soluong" value="<?php echo $row_sua['sanpham_soluong'] ?>" class="form-control"><br>
                    <label for="mota">Mô tả</label>
                    <textarea class="form-control" rows="5" name="mota" id="mota"><?php echo $row_sua['sanpham_mota'] ?></textarea><br>
                    <label for="chitiet">Chi tiết</label>
                    <textarea class="form-control" rows="5" name="chitiet" id="chitiet"><?php echo $row_sua['sanpham_chitiet'] ?></textarea><br>
                    <label for="danhmuc">Danh mục sản phẩm</label>
                    <select class="form-control" name="danhmuc" id="danhmuc">
                        <option value="0">Chọn danh mục</option>
                        <?php
                            $sql_danhmuc = mysqli_query($conn, "SELECT * FROM tbl_category ORDER BY category_id DESC");
                            while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
                                if($id_category_1 == $row_danhmuc['category_id']){
                        ?>
                            <option selected value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
                        <?php
                                } else {
                        ?>
                            <option value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
                        <?php
                                }
                            }
                        ?>
                    </select><br>
                    <input type="submit" name="suasanpham" class="btn btn-primary" value="Sửa sản phẩm">
                </form>
            <?php
                } else {
            ?>
                <h4>Thêm dịch vụ</h4>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="tensanpham">Tên dịch vụ</label>
                    <input type="text" name="tensanpham" id="tensanpham" placeholder="Tên dịch vụ" class="form-control"><br>
                    <label for="hinhanh">Hình ảnh</label>
                    <input type="file" name="hinhanh" id="hinhanh" class="form-control"><br>
                    <label for="giasanpham">Giá</label>
                    <input type="text" name="giasanpham" id="giasanpham" placeholder="Giá sản phẩm" class="form-control"><br>
                    <label for="giakhuyenmai">Giá khuyến mãi</label>
                    <input type="text" name="giakhuyenmai" id="giakhuyenmai" placeholder="Giá khuyến mãi" class="form-control"><br>
                    <label for="soluong">Số lượng sản phẩm</label>
                    <input type="text" name="soluong" id="soluong" placeholder="Số lượng" class="form-control"><br>
                    <label for="mota">Mô tả</label>
                    <textarea class="form-control" name="mota" id="mota"></textarea><br>
                    <label for="chitiet">Chi tiết</label>
                    <textarea class="form-control" name="chitiet" id="chitiet"></textarea><br>
                    <label for="danhmuc">Danh mục sản phẩm</label>
                    <select class="form-control" name="danhmuc" id="danhmuc">
                        <option value="0">Chọn danh mục</option>
                        <?php
                            $sql_danhmuc = mysqli_query($conn, "SELECT * FROM tbl_category ORDER BY category_id DESC");
                            while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
                        ?>
                            <option value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
                        <?php
                            }
                        ?>
                    </select><br>
                    <input type="submit" name="themsanpham" class="btn btn-primary" value="Thêm sản phẩm">
                </form>
            <?php
                }
            ?>
        </div>
        <div class="col-md-8 table-section">
            <h4>Liệt kê dịch vụ</h4>
            <?php
                $sql_select_sp = mysqli_query($conn, "SELECT * FROM tbl_sanpham, tbl_category WHERE tbl_sanpham.category_id=tbl_category.category_id ORDER BY tbl_sanpham.sanpham_id DESC");
            ?>
            <table class="table table-bordered">
                <tr>
                    <th>Thứ tự</th>
                    <th>Tên dịch vụ</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Danh mục</th>
                    <th>Giá sản phẩm</th>
                    <th>Giá khuyến mãi</th>
                    <th>Quản lý</th>
                </tr>
                <?php
                $i = 0;
                while($row_sp = mysqli_fetch_array($sql_select_sp)){
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row_sp['sanpham_name'] ?></td>
                    <td><img src="../uploads/<?php echo $row_sp['sanpham_image'] ?>" class="product-image"></td>
                    <td><?php echo $row_sp['sanpham_soluong'] ?></td>
                    <td><?php echo $row_sp['category_name'] ?></td>
                    <td><?php echo number_format($row_sp['sanpham_gia']).' vnd' ?></td>
                    <td><?php echo number_format($row_sp['sanpham_khuyenmai']).' vnd' ?></td>
                    <td>
                        <a href="?xoa=<?php echo $row_sp['sanpham_id'] ?>" class="btn btn-danger btn-sm">Xóa</a>
                        <a href="xulysanpham.php?quanly=sua&sua_id=<?php echo $row_sp['sanpham_id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </table>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
