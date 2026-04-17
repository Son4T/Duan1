<?php include_once VIEW . "Admin/base/header.php" ?>
<link rel="stylesheet" href="Assets/Admin/Css/UpdateUser.css">
<div id="container">
    <div id="main">
        <form method="POST" action="index.php?role=admin&act=UpdateUser&id=<?= $user['id'] ?>" class="login">
            <h3>Sửa người dùng</h3>
            <div class="mb-3">
                <label class="form-label">Họ tên</label>
                <input type="text" name="fullname" value="<?= htmlspecialchars($user['fullname'] ?? '') ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Số điện thoại</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Mật khẩu</label>
                <input type="text   " name="password" class="form-control" placeholder="Để trống nếu không thay đổi">
            </div>
            <div class="mb-3">
                <label class="form-label">Quyền</label>
                <select name="role" class="form-control">
                    <option value="admin" <?= isset($user) && $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="user" <?= isset($user) && $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="active" <?= isset($user) && $user['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="banned" <?= isset($user) && $user['status'] === 'banned' ? 'selected' : '' ?>>banned</option>
                </select>
            </div>
            <div style="display: flex;">
                <button type="submit" name="sbm_update_user" style="width: 100%;padding-right: 5px;" class="btn btn-primary">Cập nhật</button>
                <button type="button" class="btn btn-primary" style="width: 100%; padding-left: 5px;" onclick="window.location.href='index.php?API=list_user'">Trang người dùng</button>
            </div>
            <h4 style="color: red;margin-top: 20px;text-align: center;">
                <?= isset($message) ? htmlspecialchars($message) : '' ?>
            </h4>
        </form>
    </div>
</div>
<?php include_once VIEW . "Admin/base/footer.php" ?>
