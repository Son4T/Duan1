<?php
class ProductInCategoryController {
    public function index(){
        $id = $_GET['id'] ?? "";
        $categories = (new Category)->all();
        $category = (new Category)->find($id);
        $products = (new Product)->all();
        return view('Client.category', compact('category', 'products', 'categories'));
    }
}