<?php
class HomeController {
    public function index(){
        $categories = (new Category)->all();
        $products = (new Product)->all();
        $topseller = (new Product)->topSell();
        $message = session_flash('message');
        return view('Client.base.main', compact('categories', 'products', 'topseller', 'message'));
    }
}