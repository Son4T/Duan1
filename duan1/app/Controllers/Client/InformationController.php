<?php
class InformationController
{
    // Hiển thị trang đăng nhập
    public function index()
    {
        // Khởi tạo mặc định để tránh lỗi nếu chưa đăng nhập
        $information = [
            'name' => '',
            'phone' => '',
            'email' => '',
            'address' => '',
            'created_at' => ''
        ];

        // Nếu đã đăng nhập, ghi đè thông tin từ session
        if (isset($_SESSION['user']) && is_array($_SESSION['user'])) {
            $information = array_merge($information, $_SESSION['user']);
        }

        $categories = (new Category)->all();
        $message = session_flash('message');

        return view('Client.information', compact('information', 'categories', 'message'));
    }
}
