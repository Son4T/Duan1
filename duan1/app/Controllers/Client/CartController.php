<?php
class CartController
{
    public function index()
    {
        $categories = (new Category)->all();
        $carts = $_SESSION['cart'] ?? "";
        $sumPrice = (new CartController)->sumPrice();
        return view('Client.cart', compact('categories', 'carts', 'sumPrice'));
    }

    public function addToCart()
    {
        $carts = $_SESSION['cart'] ?? [];
        $id = $_GET['id'];
        $product = (new Product)->find($id);
        if (isset($carts[$id])) {
            $carts[$id]['quantity']++;
        } else {
            $carts[$id] = [
                'name' => $product['name'],
                'image' => $product['image'],
                'price' => $product['price'],
                'quantity' => 1
            ];
        }
        $_SESSION['cart'] = $carts;


        return header("location: index.php?act=Detail&id=" . $product['id']);
    }

    public function totalQuantity()
    {
        $carts = $_SESSION['cart'] ?? [];
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart['quantity'];
        }
        return $total;
    }

public function sumPrice()
{
    $carts = $_SESSION['cart'] ?? [];
    $total = 0;
    foreach ($carts as $cart) {
        // Chuyển đổi quantity và price thành số trước khi tính toán
        $quantity = (int) $cart['quantity']; // Chuyển quantity thành số nguyên
        $price = (float) $cart['price'];     // Chuyển price thành số thực (float)
        
        // Tính tổng tiền
        $total += $quantity * $price;
    }
    return $total;
}


    public function delete()
    {
        $id = $_GET['id'];
        unset($_SESSION['cart'][$id]);
        $_SESSION['totalQuantity'] = (new CartController)->totalQuantity();
        return header("location: index.php?act=Cart");
    }

    public function updateCart()
    {
        $quantities = $_POST['quantities'];
        foreach ($quantities as $id => $quantity) {
            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['quantity'] = $quantity;
            }
        }
        return header("location: index.php?act=Cart");
    }
}
