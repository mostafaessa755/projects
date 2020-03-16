<?php

namespace App\Http\Controllers;
use App\Order;
use App\User;
use App\Product;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $order   = new Order();
        $user    = new User();
        $product = new Product();
        return view('admin.dashboard',compact('order','user','product'));
    }
}
