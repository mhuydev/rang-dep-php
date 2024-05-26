<!-- <?php
    if (isset($_POST['themgiohang'])) {
        $tensanpham = $_POST['tensanpham'];
        $sanpham_id = $_POST['sanpham_id'];
        $hinhanh = $_POST['hinhanh'];
        $gia = $_POST['giasanpham'];
        $soluong = $_POST['soluong'];
        $sql_select_giohang = mysqli_query($conn, "SELECT * FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
        $count_giohang = mysqli_num_rows($sql_select_giohang);
        if($count_giohang>0){
            $row_sanpham = mysqli_fetch_array($sql_select_giohang);
            $soluong = $row_sanpham['soluong'] + 1;
            $sql_giohang = "UPDATE tbl_giohang SET soluong='$soluong' WHERE sanpham_id='$sanpham_id'";
        }else{
            $soluong = $soluong;
            $sql_giohang = "INSERT INTO tbl_giohang(tensanpham, sanpham_id, giasanpham, hinhanh, soluong) VALUES ('$tensanpham','$sanpham_id','$gia','$hinhanh','$soluong')";
        }
        $insert_row = mysqli_query($conn, $sql_giohang);
        if ($sql_giohang==0) {            
            header('Location: index.php?quanly=chitietdichvu&id='.$sanpham_id);            
        }        
    }elseif (isset($_POST['capnhatsoluong'])) {	

		for ($i=0; $i < count($_POST['product_id']); $i++) {
			$sanpham_id = $_POST['product_id'][$i];
			$soluong = $_POST['soluong'][$i];
			if ($soluong <= 0) {
				$sql_delete = mysqli_query($conn, "DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
			}else{
				$sql_update = mysqli_query($conn, "UPDATE tbl_giohang SET soluong='$soluong' WHERE sanpham_id='$sanpham_id'");
			}
		}
	}elseif (isset($_GET['xoa'])) {
		$id = $_GET['xoa'];
		$sql_delete = mysqli_query($conn, "DELETE FROM tbl_giohang WHERE giohang_id='$id'");

	}elseif(isset($_GET['dangxuat'])){
		$id = $_GET['dangxuat'];
		if ($id == 1) {
			unset($_SESSION['dangnhap_home']);
		}
		
	}elseif(isset($_POST['thanhtoan'])){
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$note = $_POST['note'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		$giaohang = $_POST['giaohang'];
		$sql_khachhang = mysqli_query($conn, "INSERT INTO tbl_khachhang(name, phone, address, note, email, giaohang, password) VALUES ('$name','$phone','$address','$note','$email','$giaohang','$password')");
		if($sql_khachhang){
			$sql_select_khachhang = mysqli_query($conn, "SELECT * FROM tbl_khachhang ORDER BY khachhang_id DESC LIMIT 1");
			$mahang = rand(0,9999);
			$row_khachhang = mysqli_fetch_array($sql_select_khachhang);
			$khachhang_id = $row_khachhang['khachhang_id'];
			$_SESSION['dangnhap_home'] = $row_khachhang['name'];
			$_SESSION['khachhang_id'] = $row_khachhang['khachhang_id'];
			for ($i=0; $i < count($_POST['thanhtoan_product_id']); $i++) {				
				$sanpham_id = $_POST['thanhtoan_product_id'][$i];
				$soluong = $_POST['thanhtoan_soluong'][$i];
				$sql_donhang = mysqli_query($conn, "INSERT INTO tbl_donhang(sanpham_id, khachhang_id, soluong, mahang) VALUES ('$sanpham_id','$khachhang_id','$soluong','$mahang')");
				$sql_delete_thanhtoan = mysqli_query($conn, "DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
			}
		}
	}
?> -->
<?php
    if (isset($_POST['themgiohang'])) {
        $tensanpham = $_POST['tensanpham'];
        $sanpham_id = $_POST['sanpham_id'];
        $hinhanh = $_POST['hinhanh'];
        $gia = $_POST['giasanpham'];
        $soluong = $_POST['soluong'];
        $sql_select_giohang = mysqli_query($conn, "SELECT * FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
        $count_giohang = mysqli_num_rows($sql_select_giohang);
        if($count_giohang > 0){
            $row_sanpham = mysqli_fetch_array($sql_select_giohang);
            $soluong = $row_sanpham['soluong'] + 1;
            $sql_giohang = "UPDATE tbl_giohang SET soluong='$soluong' WHERE sanpham_id='$sanpham_id'";
        } else {
            $sql_giohang = "INSERT INTO tbl_giohang(tensanpham, sanpham_id, giasanpham, hinhanh, soluong) VALUES ('$tensanpham','$sanpham_id','$gia','$hinhanh','$soluong')";
        }
        $insert_row = mysqli_query($conn, $sql_giohang);
        if (!$insert_row) {            
            header('Location: index.php?quanly=chitietdichvu&id='.$sanpham_id);            
        }        
    } elseif (isset($_POST['capnhatsoluong'])) {    

        for ($i=0; $i < count($_POST['product_id']); $i++) {
            $sanpham_id = $_POST['product_id'][$i];
            $soluong = $_POST['soluong'][$i];
            if ($soluong <= 0) {
                $sql_delete = mysqli_query($conn, "DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
            } else {
                $sql_update = mysqli_query($conn, "UPDATE tbl_giohang SET soluong='$soluong' WHERE sanpham_id='$sanpham_id'");
            }
        }
    } elseif (isset($_GET['xoa'])) {
        $id = $_GET['xoa'];
        $sql_delete = mysqli_query($conn, "DELETE FROM tbl_giohang WHERE giohang_id='$id'");

    } elseif (isset($_GET['dangxuat'])) {
        $id = $_GET['dangxuat'];
        if ($id == 1) {
            unset($_SESSION['dangnhap_home']);
        }
        
    } elseif (isset($_POST['thanhtoan'])) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $note = $_POST['note'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $giaohang = $_POST['giaohang'];
        $sql_khachhang = mysqli_query($conn, "INSERT INTO tbl_khachhang(name, phone, address, note, email, giaohang, password) VALUES ('$name','$phone','$address','$note','$email','$giaohang','$password')");
        if ($sql_khachhang) {
            $sql_select_khachhang = mysqli_query($conn, "SELECT * FROM tbl_khachhang ORDER BY khachhang_id DESC LIMIT 1");
            $mahang = rand(0, 9999);
            $row_khachhang = mysqli_fetch_array($sql_select_khachhang);
            $khachhang_id = $row_khachhang['khachhang_id'];
            $_SESSION['dangnhap_home'] = $row_khachhang['name'];
            $_SESSION['khachhang_id'] = $row_khachhang['khachhang_id'];
            for ($i=0; $i < count($_POST['thanhtoan_product_id']); $i++) {                
                $sanpham_id = $_POST['thanhtoan_product_id'][$i];
                $soluong = $_POST['thanhtoan_soluong'][$i];
                $sql_donhang = mysqli_query($conn, "INSERT INTO tbl_donhang(sanpham_id, khachhang_id, soluong, mahang) VALUES ('$sanpham_id','$khachhang_id','$soluong','$mahang')");
                $sql_giaodich = mysqli_query($conn, "INSERT INTO tbl_giaodich(sanpham_id, soluong, magiaodich, khachhang_id) VALUES ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
				$sql_delete_thanhtoan = mysqli_query($conn, "DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
            }
        }
    }elseif(isset($_POST['thanhtoandangnhap'])){

		$khachhang_id = $_SESSION['khachhang_id'];
        $mahang = rand(0, 9999);    
        for ($i=0; $i < count($_POST['thanhtoan_product_id']); $i++) {                
                $sanpham_id = $_POST['thanhtoan_product_id'][$i];
                $soluong = $_POST['thanhtoan_soluong'][$i];
                $sql_donhang = mysqli_query($conn, "INSERT INTO tbl_donhang(sanpham_id, khachhang_id, soluong, mahang) VALUES ('$sanpham_id','$khachhang_id','$soluong','$mahang')");
				$sql_giaodich = mysqli_query($conn, "INSERT INTO tbl_giaodich(sanpham_id, soluong, magiaodich, khachhang_id) VALUES ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
				$sql_delete_thanhtoan = mysqli_query($conn, "DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
            }
        }
	
?>

<!-- checkout page -->
<div class="privacy py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>Đặt lịch</span>
			</h3>
			<?php
				if (isset($_SESSION['dangnhap_home'])) {
					echo '<p style="color:red">Xin chào bạn: ' . $_SESSION['dangnhap_home'] . ' - <a href="index.php?quanly=giohang&dangxuat=1">Đăng xuất</a></p>';
				} else {
					echo '';
				}
			?>
			<!-- //tittle heading -->
			<div class="checkout-right">
			<?php
                $sql_lay_giohang = mysqli_query($conn, "SELECT * FROM tbl_giohang ORDER BY giohang_id DESC");
            ?>
			
				<div class="table-responsive">
					<form action="" method="POST">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>Thứ tự</th>
								<th>Dịch vụ</th>
								<th>Số người khám</th>
								<th>Tên dịch vụ</th>
								<th>Giá</th>
                                <th>Gia tổng</th>
								<th>Quản lý</th>
							</tr>
						</thead>
						<tbody>
                        <?php
                            $total = 0;
                            $i = 0;
                            while ($row_fetch_giohang = mysqli_fetch_array($sql_lay_giohang)) {
                            $subtotal = $row_fetch_giohang['soluong'] * $row_fetch_giohang['giasanpham'];    
                            $total += $subtotal;  
                            $i++;
                        ?>
							<tr class="rem1">
								<td class="invert"><?php echo $i ?></td>
								<td class="invert-image">
									<a href="single.html">
										<img src="images/<?php echo $row_fetch_giohang['hinhanh'] ?>" alt=" " height="120" class="">
									</a>
								</td>
								<td class="invert">
									<input type="number" min="1" name="soluong[]" value="<?php echo $row_fetch_giohang['soluong'] ?>">
									<input type="hidden" name="product_id[]" value="<?php echo $row_fetch_giohang['sanpham_id'] ?>">
                                </td>
								<td class="invert"><?php echo $row_fetch_giohang['tensanpham'] ?></td>
								<td class="invert"><?php echo number_format( $row_fetch_giohang['giasanpham']).'vnđ' ?></td>
                                <td class="invert"><?php echo number_format( $subtotal).'vnđ' ?></td>
								<td class="invert">
									<a href="?quanly=giohang&xoa=<?php echo $row_fetch_giohang['giohang_id'] ?>">Xóa</a>
								</td>
							</tr>
							<?php
                            }
                            ?>
                            <tr>
                                <td colspan="7">Tổng tiền: <?php echo number_format( $total).'vnđ' ?> </td>                                
                            </tr>
                            <tr>
                                <td colspan="7"><input type="submit" class="btn btn-success" value="Cập nhật" name="capnhatsoluong" >
								<?php
									$sql_giohang_select = mysqli_query($conn, "SELECT * FROM tbl_giohang");
									$count_giohang_select = mysqli_num_rows($sql_giohang_select);
									if (isset($_SESSION['dangnhap_home']) && $count_giohang_select>0) {
										while ($row_1 = mysqli_fetch_array($sql_giohang_select)) {
								?>

								<input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_1['soluong'] ?>">
								<input type="hidden" name="thanhtoan_product_id[]" value="<?php echo $row_1['sanpham_id'] ?>">
								<?php
									}
								?>
								<input type="submit" class="btn btn-primary" value="Thanh toán" name="thanhtoandangnhap" > 
								<?php
									}
								?>
								</td>							
                            </tr>
						</tbody>
					</table>
					</form>
				</div>
			</div>
			<?php
				if (!isset($_SESSION['dangnhap_home'])) {
			?>
			<div class="checkout-left">
				<div class="address_form_agile mt-sm-5 mt-4">
					<h4 class="mb-sm-4 mb-3">Thêm chi tiết dịch vụ</h4>
					<form action="" method="post" class="creditly-card-form agileinfo_form">
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<div class="first-row">
									<div class="controls form-group">
										<input class="billing-address-name form-control" type="text" name="name" placeholder="Họ tên" required="">
									</div>
									<div class="w3_agileits_card_number_grids">
										<div class="w3_agileits_card_number_grid_left form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Số điện thoại" name="phone" required="">
											</div>
										</div>
										<div class="w3_agileits_card_number_grid_right form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Địa chỉ" name="address" required="">
											</div>
										</div>
									</div>
									<div class="controls form-group">
										<input type="text" class="form-control" placeholder="Email" name="email" required="">
									</div>
									<div class="controls form-group">
										<input type="password" class="form-control" placeholder="Password" name="password" required="">
									</div>
									<div class="controls form-group">
										<textarea type="text" style="resize: none" class="form-control" placeholder="Ghi chú" name="note" required=""></textarea>
									</div>
									<!-- <div class="controls form-group">
										<textarea type="text" style="resize: none" class="form-control" placeholder="Ngày khám" name="date" required=""></textarea>
									</div>
									<div class="controls form-group">
										<textarea type="text" style="resize: none" class="form-control" placeholder="Giờ khám" name="time" required=""></textarea>
									</div> -->
									<div class="controls form-group">
										<select class="option-w3ls" name="giaohang">
											<option>Hình thức thanh toán</option>
											<option value="1">Trực tiếp tại quầy</option>
											<option value="0">Chuyển khoản ngân hàng</option>

										</select>
									</div>
								</div>
								<?php
								$sql_lay_giohang = mysqli_query($conn, "SELECT * FROM tbl_giohang ORDER BY giohang_id DESC");
								while ($row_thanhtoan = mysqli_fetch_array($sql_lay_giohang)) {
								?>
									<input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_thanhtoan['soluong'] ?>">
									<input type="hidden" name="thanhtoan_product_id[]" value="<?php echo $row_thanhtoan['sanpham_id'] ?>">
								<?php
								}
								?>
								<input type="submit" name="thanhtoan" class="btn btn-success" style="width: 20%" value="Thanh toán đặt lịch">
							</div>
						</div>
					</form>
				
				</div>
			</div>
			<?php
				}
			?>
		</div>
	</div>
	<!-- //checkout page -->