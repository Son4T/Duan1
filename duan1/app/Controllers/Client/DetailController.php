<?php
class DetailController {
    public function index(){
        $id = $_GET['id'];
        $categories = (new Category)->all();
        $detail = (new Product)->find($id);
        $products = (new Product)->all();
        $comments = (new Comment)->getCommentsByProductId($id);
        (new Product)->updateView($id);
        $_SESSION['totalQuantity'] = (new CartController)->totalQuantity();
        return view('Client.detail', compact('detail', 'products', 'categories', 'comments'));
    }
}