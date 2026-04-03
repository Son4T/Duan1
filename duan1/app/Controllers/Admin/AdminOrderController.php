<?php
class AdminOrderController {
    public function index(){
        $categories = (new Category)->all();
        $orders = (new Order)->all();
        $message = session_flash('message');
        return view('Admin.cart.list', compact('categories','message', 'orders'));
    }
    public function detail(){
        $id = $_GET['id'];
        $categories = (new Category)->all();
        $orderDetail = (new Order)->allOrderDetail($id);
        $message = session_flash('message');
        return view('Admin.cart.detail', compact('categories','message', 'orderDetail'));
    }
    public function status(){
        $id = $_GET['id'];
        $categories = (new Category)->all();
        $order = (new Order)->find($id);
        $message = session_flash('message');
        return view('Admin.cart.status', compact('categories','message', 'order'));
    }
    public function updateStatus()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lấy dữ liệu từ form
        $orderId = $_POST['order_id'] ?? null;
        $status = $_POST['status'] ?? null;

        // Kiểm tra dữ liệu
        if (is_null($orderId) || is_null($status)) {
            die('Thiếu thông tin đơn hàng hoặc trạng thái.');
        }

        // Gọi model để cập nhật trạng thái
        $orderModel = new Order();
        $orderModel->updateOrderStatus($orderId, $status);
        return header('Location: index.php?role=admin&act=Order');
    } else {
        die('Phương thức không được hỗ trợ.');
    }
}

}