<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="Assets/Client/Css/login.css">
</head>
<body>
    <?php include_once VIEW . "Client/base/header.php" ?>
    
    <?php if(!empty($message)): ?>
        <script type="text/javascript">
            alert("<?php echo $message; ?>");
        </script>
    <?php endif; ?>

    <div id="container">
        <div id="main">
            <div class="border">
                <form method="POST" action="index.php?act=Login" class="login">
                    <img src="Assets/images/login-baner.png" alt=""> <br><br>
                    <h3>Đăng nhập</h3>
                    <div class="mb-3">
                        <label class="form-label">Tên tài khoản</label>
                        <input type="text" name="get_email_login" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mật khẩu</label>
                        <input type="password" name="get_password_login" class="form-control">
                    </div>
                    <a href="index.php?act=RegisterForm">Đăng ký tại đây</a><br> <br>
                    <button type="submit" name="submit_login" class="btn btn-primary" style="width: 100%;">Đăng nhập</button>
                </form>
            </div>
        </div>
    </div>

    <?php include_once VIEW . "Client/base/foot.php" ?>
</body>
</html>
