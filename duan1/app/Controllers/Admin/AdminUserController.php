<?php
class AdminUserController {
    public function index(){
        $users = (new Account)->all();
        $message = session_flash('message');
        return view('Admin.users.list', compact('users', 'message'));
    }

    public function UpdateForm(){
        $id = $_GET['id'] ?? "";    
        $user = (new Account)->find($id);
        $message = session_flash('message');
        return view('Admin.users.update', compact('user', 'message'));
    }

    public function update($id) {
        // Kiểm tra xem form có được submit không
        if (isset($_POST['sbm_update_user'])) {
            // Lấy tất cả dữ liệu từ $_POST
            $data = $_POST;
    
            // Kiểm tra các trường bắt buộc
            if (empty($data['fullname']) || empty($data['email']) || empty($data['phone']) || empty($data['role'])) {
                $_SESSION['message'] = "Vui lòng điền đầy đủ thông tin";
                header("Location: index.php?role=admin&act=UpdateUserForm&id=" . $id);
                exit;
            }
    
            // Làm sạch các dữ liệu đầu vào (để bảo vệ khỏi XSS)
            $data['fullname'] = htmlspecialchars($data['fullname']);
            $data['email'] = htmlspecialchars($data['email']);
            $data['phone'] = htmlspecialchars($data['phone']);
            $data['role'] = htmlspecialchars($data['role']);
            $data['status'] = htmlspecialchars($data['status']);
    
            // Kiểm tra định dạng email
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['message'] = "Địa chỉ email không hợp lệ.";
                header("Location: index.php?role=admin&act=UpdateUserForm&id=" . $id);
                exit;
            }
    
          // Kiểm tra và xử lý mật khẩu mới
            if (empty($data['password'])) {
                // Nếu không có mật khẩu mới, giữ lại mật khẩu cũ
                unset($data['password']);  // Đảm bảo không truyền mật khẩu cũ khi không thay đổi
            } else {
                // Mã hóa mật khẩu mới
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            }
    
            // Cập nhật thông tin người dùng trong cơ sở dữ liệu (gọi phương thức updateUser)
            $result = (new Account)->update($id, $data);
    
            // Kiểm tra kết quả cập nhật
            if ($result) {
                $_SESSION['message'] = "Cập nhật thông tin người dùng thành công.";
                header("Location: index.php?role=admin&act=User");
                exit;
            } else {
                $_SESSION['message'] = "Có lỗi xảy ra trong quá trình cập nhật thông tin người dùng.";
            }
    
            // Chuyển hướng về trang chỉnh sửa người dùng với thông báo
            header("Location: index.php?role=admin&act=UpdateUserForm&id=" . $id);
            exit;
        } else {
            // Nếu form chưa được submit
            header("Location: index.php?role=admin&act=UpdateUserForm&id=" . $id);
            exit;
        }
    }     
}