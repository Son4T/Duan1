<?php
// Lấy các tham số từ URL, nếu không tồn tại thì gán giá trị mặc định
$act = $_GET['act'] ?? ""; // Hành động (action) cần xử lý
$id = $_GET['id'] ?? ""; // ID của đối tượng (nếu có)
$role = $_GET['role'] ?? null; // Vai trò của người dùng (admin hay client)

// Khởi tạo các controller dành cho quản trị viên
$controllerAdmin = [
    'AdminCategoryController',
    'AdminUserController',
    'AdminProductController',
    'AdminOrderController',
    'AdminCommentController',
    'AdminStatisticalController',
];
foreach ($controllerAdmin as $controllerName) {
    $$controllerName = new $controllerName;
}

// Khởi tạo các controller dành cho client (người dùng thông thường)
$controllerClient = [
    'RegisterController',
    'LoginController',
    'HomeController',
    'ProductController',
    'ProductInCategoryController',
    'InformationController',
    'DetailController',
    'CartController',
    'CheckOutController',
    'ChangeInformationController',
    'OrdersController',
    'CommentController'
];
foreach ($controllerClient as $controllerName) {
    $$controllerName = new $controllerName;
}

// Xử lý khi không có vai trò được xác định (người dùng thông thường)
if (!isset($role)) {
    match ($act) {
        'RegisterForm' => $RegisterController->index(),
        'StorageUser' => $RegisterController->Storage(),
        'LoginForm' => $LoginController->index(),
        'Login' => $LoginController->login(),
        'Products' => $ProductController->index(),
        'Category' => $ProductInCategoryController->index(),
        'Logout' => $LoginController->logout(),
        'Information' => $InformationController->index(),
        'Detail' => $DetailController->index(),
        'AddToCart' => $CartController->addToCart(),
        'Cart' => $CartController->index(),
        'DeleteInCart' => $CartController->delete(),
        'UpdateCart' => $CartController->updateCart(),
        'CheckOutForm' => $CheckOutController->index(),
        'CheckOut' => $CheckOutController->checkOut(),
        'ChangeInforForm' => $ChangeInformationController->UpdateForm(),
        'ChangeInformation' => $ChangeInformationController->update($id),
        'Order' => $OrdersController->index(),
        'CancelOrder' => $OrdersController->cancel($id),
        'AddComment' => $CommentController->addComment(),
        default => $HomeController->index()
    };
}

// Xử lý khi vai trò là admin
if (isset($role) && $role == 'admin') {
    match ($act) {
        'User' => $AdminUserController->index(),
        'AddCategory' => $AdminCategoryController->create(),
        'Edit' => $AdminCategoryController->edit(),
        'UpdateCategory' => $AdminCategoryController->update(),
        'DeleteCategory' => $AdminCategoryController->deleteCategory($id),
        'Storage' => $AdminCategoryController->storage(),
        'Category' => $AdminCategoryController->index(),
        'Product' => $AdminProductController->index(),
        'UpdateProductForm' => $AdminProductController->updateForm(),
        'UpdateProduct' => $AdminProductController->update($id),
        'DeleteProduct' => $AdminProductController->delete($id),
        'SelectType' => $AdminProductController->createT(),
        'AddProduct' => $AdminProductController->createP(),
        'StorageProduct' => $AdminProductController->storage(),
        'UpdateUserForm' => $AdminUserController->updateForm(),
        'UpdateUser' => $AdminUserController->update($id),
        'Order' => $AdminOrderController->index(),
        'OrderDetail' => $AdminOrderController->detail(),
        'OrderStatus' => $AdminOrderController->status(),
        'UpdateOrderStatus' => $AdminOrderController->updateStatus(),
        'Comment' => $AdminCommentController->index(),
        'DeleteComment' => $AdminCommentController->delete(),
        'Statistical' => $AdminStatisticalController->index(),
        'BestSelling' => $AdminStatisticalController->bestselling(),
        default => include_once VIEW . "Admin/wellcome.php"
    };
}
?>
