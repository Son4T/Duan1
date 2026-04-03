<?php
class LoginController
{
    // Hiển thị trang đăng nhập
    public function index()
    {
        $categories = (new Category)->all(); // Lấy tất cả các danh mục từ cơ sở dữ liệu
        $message = $_SESSION['message'] ?? ''; // Lấy thông báo từ session nếu có
        unset($_SESSION['message']); // Xóa thông báo sau khi lấy
        return view('Client.login', compact('categories', 'message')); // Trả về view login với danh mục và thông báo
    }

    // Xử lý đăng nhập
    public function login()
    {
        // Kiểm tra nếu người dùng đã gửi form đăng nhập
        if (isset($_POST['submit_login'])) {
            // Lấy dữ liệu từ form
            $email = $_POST['get_email_login'] ?? '';
            $password = $_POST['get_password_login'] ?? '';

            // Kiểm tra nếu email hoặc mật khẩu trống
            if (empty($email) || empty($password)) {
                // Thông báo lỗi nếu trống
                $_SESSION['message'] = 'Vui lòng điền đầy đủ thông tin!';
                header("Location: index.php?act=LoginForm"); // Trả về trang đăng nhập
                exit();
            }

            // Gọi phương thức login từ model Account để kiểm tra thông tin người dùng
            $user = (new Account)->login($email, $password);

            // Kiểm tra nếu đăng nhập thành công
            if ($user) {
                $_SESSION['user'] = $user; // Lưu thông tin người dùng vào session
                header("Location: index.php?act=home"); // Chuyển hướng tới trang chính sau khi đăng nhập
                exit();
            } else {
                // Nếu đăng nhập thất bại, hiển thị thông báo lỗi
                $_SESSION['message'] = 'Tên đăng nhập hoặc mật khẩu không chính xác!';
                header("Location: index.php?act=LoginForm");
                exit();
            }
        } else {
            // Nếu không có POST request (nghĩa là người dùng mới vào trang đăng nhập)
            return view('Client.login'); // Hiển thị trang đăng nhập
        }
    }

    public function logout(){
        unset($_SESSION['user']);
        header("Location: index.php?act=");
        exit();
    }
}
?>
