<?php
if (isset($_POST['search_button'])) {
    $tukhoa = $_POST['search_product'];

$sql_product = mysqli_query($conn, "SELECT * FROM tbl_sanpham WHERE sanpham_name LIKE '%$tukhoa%' ORDER BY sanpham_id DESC");
$title = $tukhoa;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <style>
        /* CSS Styles */
        .product-sec1 .product-men {
            margin-bottom: 20px;
        }

        .men-thumb-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            object-position: center;
            border-radius: 5px;
        }

        .men-pro-item {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            border-radius: 5px;
            overflow: hidden;
            transition: transform 0.3s;
        }

        .men-pro-item:hover {
            transform: translateY(-10px);
        }

        .men-thumb-item {
            position: relative;
        }

        .men-cart-pro {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .men-thumb-item:hover .men-cart-pro {
            opacity: 1;
        }

        .carousel-indicators li {
            background-color: #333;
        }

        .carousel-indicators .active {
            background-color: #000;
        }

        .carousel-caption h3,
        .carousel-caption p {
            color: #fff;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }

        .heading-tittle {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .button {
            background-color: #28a745;
            border: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #218838;
        }

        .side-bar .search-hotel input[type="search"] {
            width: calc(100% - 40px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .side-bar .search-hotel input[type="submit"] {
            background: #333;
            border: none;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
        }

        .side-bar h3 {
            font-size: 18px;
            font-weight: bold;
        }

        .side-bar ul {
            padding-left: 0;
            list-style: none;
        }

        .side-bar ul li {
            margin-bottom: 10px;
        }

        .side-bar ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            transition: color 0.3s;
        }

        .side-bar ul li a:hover {
            color: #28a745;
        }

        .box-scroll .scroll {
            max-height: 300px;
            overflow-y: auto;
        }

        .box-scroll .scroll img {
            border-radius: 5px;
        }

        .box-scroll .scroll .price-mar {
            color: #28a745;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="ads-grid py-sm-5 py-4">
        <div class="container py-xl-4 py-lg-2">
            <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3"><?php echo $title ?></h3>
            <div class="row">
                <div class="agileinfo-ads-display col-lg-9">
                    <div class="wrapper">
                        <div class="product-sec1 px-sm-4 px-3 py-sm-5 py-3 mb-4">
                            <div class="row">
                                <?php while ($row_sanpham = mysqli_fetch_array($sql_product)) : ?>
                                    <div class="col-md-4 product-men mt-5">
                                        <div class="men-pro-item simpleCart_shelfItem">
                                            <div class="men-thumb-item text-center">
                                                <img src="images/<?php echo $row_sanpham['sanpham_image']; ?>" alt="">
                                                <div class="men-cart-pro">
                                                    <div class="inner-men-cart-pro">
                                                        <a href="?quanly=chitietdichvu&id=<?php echo $row_sanpham['sanpham_id']; ?>" class="link-product-add-cart">Xem dịch vụ</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-info-product text-center border-top mt-4">
                                                <h4 class="pt-1">
                                                    <a href="?quanly=chitietdichvu&id=<?php echo $row_sanpham['sanpham_id']; ?>"><?php echo $row_sanpham['sanpham_name']; ?></a>
                                                </h4>
                                                <div class="info-product-price my-2">
                                                    <span class="item_price"><?php echo number_format($row_sanpham['sanpham_khuyenmai']) . 'vnđ'; ?></span>
                                                    <del><?php echo number_format($row_sanpham['sanpham_gia']) . 'vnđ'; ?></del>
                                                </div>
                                                <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                                                    <form action="?quanly=giohang" method="post">
                                                        <fieldset>
                                                            <input type="hidden" name="tensanpham" value="<?php echo $row_sanpham['sanpham_name']; ?>" />
                                                            <input type="hidden" name="sanpham_id" value="<?php echo $row_sanpham['sanpham_id']; ?>" />
                                                            <input type="hidden" name="giasanpham" value="<?php echo $row_sanpham['sanpham_gia']; ?>" />
                                                            <input type="hidden" name="hinhanh" value="<?php echo $row_sanpham['sanpham_image']; ?>" />
                                                            <input type="hidden" name="soluong" value="1" />
                                                            <input type="submit" name="themgiohang" value="Thêm lịch khám" class="button" />
                                                        </fieldset>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
                    <div class="side-bar p-sm-4 p-3">
                        <div class="search-hotel border-bottom py-2">
                            <h3 class="agileits-sear-head mb-3">Tìm kiếm</h3>
                            <form action="#" method="post">
                                <input type="search" placeholder="Dịch vụ..." name="search" required="">
                                <!-- <input type="submit" value=" "> -->
                            </form>
                        </div>
                        <div class="range border-bottom py-2">
                            <h3 class="agileits-sear-head mb-3">Giá</h3>
                            <div class="w3l-range">
                                <ul>
                                    <li><a href="#">Dưới 1 triệu</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="customer-rev border-bottom left-side py-2">
                            <h3 class="agileits-sear-head mb-3">Khách hàng Review</h3>
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span>5.0</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="left-side border-bottom py-2">
                            <h3 class="agileits-sear-head mb-3">Khuyến mãi</h3>
                            <ul>
                                <li>
                                    <a href="#">Giảm giá lên tới 50%</a>
                                </li>
                            </ul>
                        </div>
                        <div class="f-grid py-2">
                            <h3 class="agileits-sear-head mb-3">Dịch vụ nổi bật</h3>
                            <div class="box-scroll">
                                <div class="scroll">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-6">
                                            <div class="e-left">
                                                <a href="#">
                                                    <img src="images/s1.jpg" alt="">
                                                    <h6>Kiểm tra sức khỏe định kỳ</h6>
                                                    <span class="price-mar">$120.00</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-6">
                                            <div class="e-left">
                                                <a href="#">
                                                    <img src="images/s2.jpg" alt="">
                                                    <h6>Tư vấn dinh dưỡng</h6>
                                                    <span class="price-mar">$180.00</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
