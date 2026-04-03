<?php
class CheckOutController
{
    public function index()
    {      
        if (!isset($_SESSION['user'])) {
            header("location: index.php?act=Login");
            exit;
        }

        $user = $_SESSION['user'];
        $carts = $_SESSION['cart'] ?? [];
        $sumPrice = (new CartController)->sumPrice();

        $categories = (new Category)->all();
        return view('Client.checkOut', compact('categories', 'user', 'carts', 'sumPrice'));
    }

    public function checkOut()
    {
        $sessionUser = $_SESSION['user'] ?? [];

        // Lấy dữ liệu từ POST, nếu không có thì lấy từ session
        $user = [
            'id'       => $_POST['id']       ?? ($sessionUser['id']       ?? ''),
            'fullname' => $_POST['fullname'] ?? ($sessionUser['fullname'] ?? ''),
            'phone'    => $_POST['phone']    ?? ($sessionUser['phone']    ?? ''),
            'email'    => $_POST['email']    ?? ($sessionUser['email']    ?? ''),
            'address'  => $_POST['address']  ?? ($sessionUser['address']  ?? ''),
            'role'     => $sessionUser['role']   ?? '',
            'status'   => $sessionUser['status'] ?? '',
        ];

        // Kiểm tra thông tin bắt buộc
        if (
            empty($user['id']) || 
            empty($user['fullname']) || 
            empty($user['phone']) || 
            empty($user['email']) || 
            empty($user['address'])
        ) {
            $_SESSION['message'] = "Vui lòng nhập đầy đủ thông tin trước khi đặt hàng.";
            header("Location: index.php?act=checkOut");
            exit;
        }

        $sumPrice = (new CartController)->sumPrice();
        $order = [
            'user_id'        => $user['id'],
            'status'         => 'pending',
            'payment_method' => $_POST['payment_method'] ?? '',
            'total_price'    => $sumPrice,
        ];

        if (empty($order['payment_method'])) {
            $_SESSION['message'] = "Vui lòng chọn phương thức thanh toán.";
            header("Location: index.php?act=checkOut");
            exit;
        }

        // Cập nhật thông tin người dùng
        (new Account)->update($user['id'], $user);

        // Tạo đơn hàng
        $orderId = (new Order)->create($order);

        // Xử lý chi tiết đơn hàng
        $carts = $_SESSION['cart'] ?? [];
        foreach ($carts as $id => $cart) {
            $orderDetailData = [
                'order_id'     => $orderId,
                'product_id'   => $id,
                'product_name' => $cart['name'] ?? '',
                'price'        => $cart['price'] ?? 0,
                'quantity'     => $cart['quantity'] ?? 1,
            ];
            (new Order)->createOrderDetail($orderDetailData);
        }

        $this->clearCart();
        $_SESSION['message'] = "Đặt hàng thành công!";
        header("location: index.php?act=");
        exit;
    }

    public function clearCart()
    {
        unset($_SESSION['cart'], $_SESSION['totalQuantity']);
    }
}
