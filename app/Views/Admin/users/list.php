<?php include_once VIEW . "Admin/base/header.php" ?>
<div class="main">
<style>
    .main {
    height: 800px;
    overflow-y: auto;
}
</style>
    <div class="option">
    </div>
    <div class="product-main">
    <div style="color: green;margin: 40px 50px 0px 50px;font-weight: 25;height: 50px;border-radius: 20px;"><?php if(isset($message) && $message != "") :?><?= $message ?><?php endif; ?></div>
        <div class="show_list" style="width: 97%; margin: 20px 0; border-collapse: collapse; margin-left: 2%;">
            <table style="width: 100%; border: 1px solid gray;">
                <div style="width: 100%; height: 40px; background-color: white; border: 1px solid gray; border-radius: 5px; margin-top: 20px; text-align: center;">
                    <h3 style="margin-top: 10px;">Tài khoản quản trị</h3>
                </div>
                <thead style="background-color: #f2f2f2;">
                    <tr>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">ID</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Tên người dùng</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Email</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Số điện thoại</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Mật khẩu</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Ngày tạo</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Role</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Status</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $checkUser = "admin";
                    foreach ($users as $value) :
                        if ($value['role'] == $checkUser) :
                    ?>
                            <tr>
                                <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= $value['id'] ?></td>
                                <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;width: 200px;"><?= $value['fullname'] ?></td>
                                <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;width: 250px;"><?= $value['email'] ?></td>
                                <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= $value['phone'] ?></td>
                                <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;max-width: 250px;overflow: hidden;"><?= $value['password'] ?></td>
                                <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= date('d/m/Y', strtotime($value['created_at'])) ?></td>
                                <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= $value['role'] ?></td>
                                <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= $value['status'] ?></td>
                                <td style="width: 70px; background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;">
                                <a href="index.php?role=admin&act=UpdateUserForm&id=<?= $value['id'] ?>"><input style="margin-left: 5px; width: 50px; height: 25px;" type="button" value="Sửa"></a>
                                </td>
                            </tr>
                    <?php
                        endif;
                    endforeach;
                    ?>
                </tbody>
            </table>

            <!-- Bảng tài khoản người dùng -->
            <table style="width: 100%; border: 1px solid gray;">
                <div style="width: 100%; height: 40px; background-color: white; border: 1px solid gray; border-radius: 5px; margin-top: 20px; text-align: center;">
                    <h3 style="margin-top: 10px;">Tài khoản người dùng</h3>
                </div>
                <thead style="background-color: #f2f2f2;">
                    <tr>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">ID</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Tên người dùng</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Email</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Số điện thoại</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Mật khẩu</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Ngày tạo</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Role</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Status</th>
                        <th style="background-color: #f8f8f8; color: #333; font-weight: bold; padding: 10px; text-align: left; border: 1px solid #ccc;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($users as $value) :
                        if ($value['role'] !== $checkUser) :
                    ?>
                            <tr>
                            <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= $value['id'] ?></td>
                                <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;width: 200px;"><?= $value['fullname'] ?></td>
                                <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;width: 250px;"><?= $value['email'] ?></td>
                                <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= $value['phone'] ?></td>
                                <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;max-width: 250px;overflow: hidden;"><?= $value['password'] ?></td>
                                <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= date('d/m/Y', strtotime($value['created_at'])) ?></td> <!-- Ngày tạo -->
                                <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= $value['role'] ?></td> <!-- Role -->
                                <td style="background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;"><?= $value['status'] ?></td> <!-- Status -->
                                <td style="width: 70px; background-color: #f8f8f8; padding: 10px; text-align: left; border: 1px solid #ccc;">
                                <a href="index.php?role=admin&act=UpdateUserForm&id=<?= $value['id'] ?>"><input style="margin-left: 5px; width: 50px; height: 25px;" type="button" value="Sửa"></a>
                                </td>
                            </tr>
                    <?php
                        endif;
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include_once VIEW . "Admin/base/footer.php" ?>
