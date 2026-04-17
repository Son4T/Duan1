<?php include_once VIEW . "Client/base/header.php" ?>
<link rel="stylesheet" href="Assets/Client/Css/checkOut.css">
<style>
    .qr-payment-container {
        max-width: 600px;
        margin: 40px auto;
        padding: 30px;
        background: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .qr-payment-container h2 {
        text-align: center;
        color: #333;
        margin-bottom: 10px;
    }
    .order-info {
        background: white;
        padding: 20px;
        border-radius: 8px;
        margin: 20px 0;
        border-left: 4px solid #007bff;
    }
    .order-info p {
        margin: 10px 0;
        font-size: 16px;
    }
    .order-info strong {
        color: #333;
    }
    .qr-code-section {
        text-align: center;
        background: white;
        padding: 30px;
        border-radius: 8px;
        margin: 20px 0;
    }
    .qr-code-section h3 {
        color: #333;
        margin-bottom: 20px;
    }
    .qr-code-image {
        max-width: 300px;
        width: 100%;
        height: auto;
        border: 2px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        background: white;
    }
    .payment-instructions {
        background: #e8f4f8;
        padding: 20px;
        border-radius: 8px;
        margin: 20px 0;
        border-left: 4px solid #0288d1;
    }
    .payment-instructions h3 {
        color: #0288d1;
        margin-top: 0;
    }
    .payment-instructions ol {
        padding-left: 20px;
        color: #555;
    }
    .payment-instructions li {
        margin: 10px 0;
        line-height: 1.6;
    }
    .action-buttons {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-top: 20px;
    }
    .btn {
        padding: 12px 30px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .btn-primary {
        background-color: #007bff;
        color: white;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }
    .btn-secondary:hover {
        background-color: #5a6268;
    }
    .success-check {
        font-size: 48px;
        color: #28a745;
        text-align: center;
        margin: 20px 0;
    }
</style>

<div class="container">
    <div class="qr-payment-container">
        <h2>🎯 Thanh Toán Bằng Mã QR</h2>
        <p style="text-align: center; color: #666; margin-bottom: 20px;">Quét mã QR bên dưới để thanh toán đơn hàng</p>

        <div class="order-info">
            <p><strong>Mã đơn hàng:</strong> #<?= $order['id'] ?></p>
            <p><strong>Khách hàng:</strong> <?= $order['fullname'] ?></p>
            <p><strong>Số điện thoại:</strong> <?= $order['phone'] ?></p>
            <p><strong>Email:</strong> <?= $order['email'] ?></p>
            <p><strong>Địa chỉ:</strong> <?= $order['address'] ?></p>
            <p style="font-size: 18px; color: #d9534f;"><strong>Số tiền thanh toán: <?= number_format($order['total_price']) ?> VND</strong></p>
            <p><strong>Trạng thái:</strong> <span style="color: #ffc107;">Chờ xác nhận thanh toán</span></p>
        </div>

        <div class="qr-code-section">
            <h3>📱 Mã QR Thanh Toán</h3>
            <!-- 
            Để tích hợp QR code thực tế, bạn có thể sử dụng một trong các tùy chọn:
            1. API QR code: https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=[ENCODED_DATA]
            2. Thư viện phpqrcode
            3. Dịch vụ thanh toán như VNPay, Momo, etc.
            -->
            
            <!-- Ví dụ QR code URL (cần được cấu hình theo phương thức thanh toán của bạn) -->
            <img src="https://cdn.discordapp.com/attachments/1475803482106888275/1494718189701955774/IMG_6448.png?ex=69e3a04a&is=69e24eca&hm=7d820df2d3bfee186b3c12e192a43a298b03eaf9068d624b9eac56182b61e69e&" alt="QR Code" class="qr-code-image">
            
            <p style="margin-top: 15px; color: #666;">Sử dụng ứng dụng ngân hàng hoặc ứng dụng thanh toán để quét mã QR này</p>
        </div>

        <div class="payment-instructions">
            <h3>📋 Hướng dẫn thanh toán:</h3>
            <ol>
                <li>Mở ứng dụng ngân hàng hoặc ứng dụng thanh toán (VNPay, Momo, etc.) trên điện thoại của bạn</li>
                <li>Chọn tính năng "Quét mã QR" hoặc "Scan QR"</li>
                <li>Quét mã QR hiển thị trên màn hình này</li>
                <li>Xác nhận thông tin và hoàn tất thanh toán</li>
                <li>Sau khi thanh toán thành công, bấm nút "Xác nhận thanh toán" bên dưới</li>
            </ol>
        </div>

        <div class="action-buttons">
            <form method="POST" action="index.php?act=ConfirmQrPayment" style="display: inline;">
                <input type="hidden" name="orderId" value="<?= $order['id'] ?>">
                <button type="submit" class="btn btn-primary">✓ Xác nhận thanh toán</button>
            </form>
            <a href="index.php?act=Order" class="btn btn-secondary">← Quay lại đơn hàng</a>
        </div>

        <div style="margin-top: 20px; padding: 15px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 5px;">
            <p style="margin: 0; color: #856404;">
                <strong>⚠️ Lưu ý:</strong>  Sau khi thanh toán thành công chủ shop sẽ liên lạc với bạn để xác nhận đơn hàng này và giao hàng đến bạn theo yêu cầu.
        </div>
    </div>
</div>

<?php include_once VIEW . "Client/base/foot.php" ?>
