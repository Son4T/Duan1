<?php
class RegisterController {
    public function index(){
        $categories = (new Category)->all();
        $message = $_SESSION['message'] ?? ''; // Lấy thông báo từ session nếu có
        unset($_SESSION['message']); // Xóa thông báo sau khi lấy
        return view('Client.register', compact('categories', 'message')); // Trả về view register với danh mục và thông báo
    }

    public function Storage()
    {
        // Kiểm tra nếu form được submit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST;

            // Kiểm tra nếu mật khẩu và mật khẩu nhập lại không khớp
            if ($data['password'] !== $data['get_check_password']) {
                $_SESSION['message'] = 'Mật khẩu không khớp!';
                header("Location: index.php?act=RegisterForm");
                exit();
            }

            // Kiểm tra các trường dữ liệu khác, ví dụ email đã tồn tại
            $existingUser = (new Account)->checkEmailExist($data['email']);
            if ($existingUser) {
                $_SESSION['message'] = 'Email này đã được đăng ký!';
                header("Location: index.php?act=RegisterForm");
                exit();
            }

            // Nếu không có lỗi, tiếp tục xử lý đăng ký
            $userData = [
                'fullname' => $data['fullname'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'role' => 'user',  // Mặc định role là 'user'
                'status' => 'active',  // Mặc định status là 'active'
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            // Gọi phương thức insert() để lưu dữ liệu vào cơ sở dữ liệu
            (new Account)->insert($userData);

            // Hiển thị thông báo thành công
            $_SESSION['message'] = 'Đăng ký thành công! Bạn có thể đăng nhập ngay.';
            header("Location: index.php?act=LoginForm");
            exit();
        }
    }
}
?>
