<?php
class DetailController {
    public function index(){
        // Validate: Kiểm tra ID có tồn tại không
        if (empty($_GET['id'])) {
            header("location: index.php?act=Products");
            exit;
        }
        
        $id = $_GET['id'];
        
        // Validate: Kiểm tra ID có phải số nguyên dương không
        if (!is_numeric($id) || intval($id) <= 0) {
            header("location: index.php?act=Products");
            exit;
        }
        
        $categories = (new Category)->all();
        $detail = (new Product)->find($id);
        
        // Validate: Kiểm tra sản phẩm có tồn tại không
        if (!$detail) {
            $_SESSION['message'] = "Sản phẩm không tồn tại.";
            header("location: index.php?act=Products");
            exit;
        }
        
        $products = (new Product)->all();
        $comments = (new Comment)->getCommentsByProductId($id);
        (new Product)->updateView($id);
        $_SESSION['totalQuantity'] = (new CartController)->totalQuantity();
        return view('Client.detail', compact('detail', 'products', 'categories', 'comments'));
    }
}