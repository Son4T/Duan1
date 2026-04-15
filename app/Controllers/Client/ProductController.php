<?php
class ProductController {
    public function index(){
        $categories = (new Category)->all();
        
        $filters = [
            'search'    => $_GET['search'] ?? '',
            'min_price' => $_GET['min_price'] ?? '',
            'max_price' => $_GET['max_price'] ?? '',
            'size'      => $_GET['size'] ?? '',
            'color'     => $_GET['color'] ?? '',
        ];

        $products = (new Product)->filter($filters);
        return view('Client.products', compact('categories', 'products', 'filters'));
    }
}