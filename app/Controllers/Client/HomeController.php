<?php
class HomeController {
    public function index(){
        $categories = (new Category)->all();

        // Tiếp nhận dữ liệu lọc từ URL (GET)
        $filters = [
            'search'    => $_GET['search'] ?? '',
            'min_price' => $_GET['min_price'] ?? '',
            'max_price' => $_GET['max_price'] ?? '',
            'size'      => $_GET['size'] ?? '',
            'color'     => $_GET['color'] ?? '',
        ];

        $products = (new Product)->filter($filters);
        $topseller = (new Product)->topSell();
        $message = session_flash('message');
        return view('Client.base.main', compact('categories', 'products', 'topseller', 'message', 'filters'));
    }
}