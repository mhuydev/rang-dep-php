<?php
session_start();
include('../db/connect.php');
?>
<?php
if (isset($_POST['dangnhap'])) {
    $taikhoan = $_POST['taikhoan'];
    $matkhau = md5($_POST['matkhau']);
    if ($taikhoan == '' || $matkhau == '') {
        $error_message = 'Vui lòng nhập đầy đủ thông tin';
    } else {
        $stmt = $conn->prepare("SELECT * FROM tbl_admin WHERE email = ? AND password = ? LIMIT 1");
        $stmt->bind_param("ss", $taikhoan, $matkhau);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row_dangnhap = $result->fetch_assoc();
            $_SESSION['dangnhap'] = $row_dangnhap['admin_name'];
            $_SESSION['admin_id'] = $row_dangnhap['admin_id'];
            header('Location: dashboard.php');
            exit;
        } else {
            $error_message = 'Tài khoản hoặc mật khẩu sai';
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <title>Đăng nhập admin</title>
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input {
            margin-bottom: 1rem;
        }
        .error-message {
            color: red;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="login-container col-md-4">
        <h2 class="text-center">Đăng nhập</h2>
        <?php if (isset($error_message)) { echo '<p class="error-message">' . $error_message . '</p>'; } ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="taikhoan">Tài khoản</label>
                <input type="text" name="taikhoan" id="taikhoan" placeholder="Tên đăng nhập" class="form-control">
            </div>
            <div class="form-group">
                <label for="matkhau">Mật khẩu</label>
                <input type="password" name="matkhau" id="matkhau" placeholder="Mật khẩu" class="form-control">
            </div>
            <input type="submit" name="dangnhap" class="btn btn-primary btn-block" value="Đăng nhập">
        </form>
    </div>
</body>
</html>
