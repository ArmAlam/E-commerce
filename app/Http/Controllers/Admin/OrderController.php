<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function NewOrder()
    {
        $order = DB::table('orders')->where('status', 0)->get();
        return view('admin.order.pending', compact('order'));
    }

    public function ViewOrder($id)
    {
        $order = DB::table('orders')->join('users', 'orders.user_id', 'users.id')->select('users.name', 'users.phone', 'orders.*')->where('orders.id', $id)->first();

        $shipping = DB::table('shipping')->where('order_id', $id)->first();

        $details = DB::table('order_details')->join('products', 'order_details.product_id', 'products.id')->select('products.product_code', 'products.image_one', 'order_details.*')->where('order_details.order_id', $id)->get();
    }
}
