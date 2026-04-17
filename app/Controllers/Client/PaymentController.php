<?php
class PaymentController {
    public function vnpayPayment($orderId) {
        $order = (new Order)->find($orderId);
        if (!$order) {
            $_SESSION['message'] = "Không tìm thấy đơn hàng.";
            header("Location: index.php?act=Order");
            exit;
        }

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/da1/duan1/index.php?act=VnpayReturn";
        $vnp_TmnCode = "YOUR_TMN_CODE"; // Thay bằng mã website của bạn
        $vnp_HashSecret = "YOUR_HASH_SECRET"; // Thay bằng chuỗi bí mật của bạn

        $vnp_TxnRef = $order['id']; 
        $vnp_OrderInfo = "Thanh toán đơn hàng #" . $order['id'];
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = (int)($order['total_price'] * 100);
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB'; // Mã ngân hàng test mặc định
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        
        header('Location: ' . $vnp_Url);
        exit;
    }

    public function vnpayReturn() {
        $vnp_HashSecret = "YOUR_HASH_SECRET"; // Khớp với Secret ở trên
        $vnp_Data = $_GET;
        $vnp_SecureHash = $vnp_Data['vnp_SecureHash'] ?? '';
        unset($vnp_Data['vnp_SecureHash']);
        ksort($vnp_Data);
        $i = 0;
        $hashData = "";
        foreach ($vnp_Data as $key => $value) {
            $hashData .= ($i == 1 ? '&' : '') . urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $orderId = $vnp_Data['vnp_TxnRef'];

        if ($secureHash == $vnp_SecureHash) {
            if ($vnp_Data['vnp_ResponseCode'] == '00') {
                (new Order)->updateStatus($orderId, 'completed');
                $_SESSION['message'] = "Thanh toán thành công đơn hàng #" . $orderId;
            } else {
                $_SESSION['message'] = "Giao dịch không thành công hoặc đã bị hủy.";
            }
        } else {
            $_SESSION['message'] = "Chữ ký không hợp lệ!";
        }
        header("Location: index.php?act=Order");
        exit;
    }

    public function qrPayment($orderId) {
        $order = (new Order)->find($orderId);
        if (!$order) {
            $_SESSION['message'] = "Không tìm thấy đơn hàng.";
            header("Location: index.php?act=Order");
            exit;
        }

        // Dữ liệu thanh toán QR (có thể điều chỉnh theo nhu cầu)
        $qrData = [
            'orderId' => $order['id'],
            'amount' => $order['total_price'],
            'fullname' => $order['fullname'],
            'phone' => $order['phone'],
            'email' => $order['email']
        ];

        $categories = (new Category)->all();
        return view('Client.qrPayment', compact('categories', 'order', 'qrData'));
    }

    public function confirmQrPayment() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['message'] = "Phương thức yêu cầu không hợp lệ.";
            header("Location: index.php?act=Order");
            exit;
        }

        $orderId = $_POST['orderId'] ?? '';
        
        if (empty($orderId)) {
            $_SESSION['message'] = "Không tìm thấy đơn hàng.";
            header("Location: index.php?act=Order");
            exit;
        }

        // Lấy thông tin đơn hàng
        $order = (new Order)->find($orderId);
        if (!$order) {
            $_SESSION['message'] = "Không tìm thấy đơn hàng.";
            header("Location: index.php?act=Order");
            exit;
        }

        // Cập nhật trạng thái đơn hàng thành pending (chờ xác nhận thanh toán)
        (new Order)->updateStatus($orderId, 'pending');

        // Tạo thông báo cho admin
        $notificationData = [
            'order_id' => $orderId,
            'user_id' => $order['user_id'],
            'message' => "Khách hàng " . $order['fullname'] . " vừa thanh toán đơn hàng #" . $orderId . " bằng mã QR. Số tiền: " . number_format($order['total_price']) . " VND. Vui lòng xác nhận đơn hàng.",
            'is_read' => 0,
            'is_confirmed' => 0
        ];
        (new Notification)->create($notificationData);

        $_SESSION['message'] = "Đơn hàng #" . $orderId . " đang chờ xác nhận thanh toán qua QR.";
        header("Location: index.php?act=Order");
        exit;
    }
}

