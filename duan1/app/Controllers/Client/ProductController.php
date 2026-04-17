<?php
class ProductController {
    public function index(){
        $categories = (new Category)->all();
        $searchData = $_POST['search'] ?? "";
        $products = (new Product)->all();
        return view('Client.products', compact('categories', 'products', 'searchData'));
    }
}