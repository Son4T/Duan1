<?php include_once VIEW . "Client/base/header.php" ?>
    <?php if(!empty($message)): ?>
        <script type="text/javascript">
            alert("<?php echo $message; ?>");
        </script>
    <?php endif; ?>
<link rel="stylesheet" href="Assets/Client/Css/register.css">
<div id="container">
    <div id="main">
      <form method="POST" action="index.php?act=StorageUser" class="login">
        <h3>Đăng ký tài khoản</h3>
        <div class="mb-3">
          <label class="form-label">Họ tên</label>
          <input type="text" name="fullname" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Phone</label>
          <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Address:</label>
          <input type="text" name="address" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Mật khẩu</label>
          <input type="text" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Nhập lại mật khẩu</label>
          <input type="text" name="get_check_password" class="form-control" required>
        </div>    
        <a href="index.php?act=RegisterForm">Đăng Nhập tại đây</a><br> <br>
        <button type="submit" name="sbm_register" style="width: 100%;" class="btn btn-primary">Đăng ký</button>
      </form>
    </div>
</div>
<?php include_once VIEW . "Client/base/foot.php" ?>
