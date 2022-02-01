<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::all();
        $clients = Client::count();
        $products = Product::count();

        $order_count = $orders->count();
        $total_price = $orders->sum('total_price');

        return view('dashboard', compact('order_count', 'clients', 'products', 'total_price'));
    }
}
