<?php
class AdminStatisticalController
{
    public function index()
    {
        $statistics = new Statistical();
        $totalOrders = $statistics->getTotalOrders();
        $totalRevenue = $statistics->getTotalRevenue();
        $totalUsers = $statistics->getTotalUsers();
        $totalProducts = $statistics->getTotalProducts();

        return view('Admin.statistical.Statistical', compact('totalOrders', 'totalRevenue', 'totalUsers', 'totalProducts'));
    }

    public function bestselling()
    {
        $products = (new Product)->getBestSellingProducts();
        return view('Admin.statistical.BestSelling', compact('products'));
    }
}
