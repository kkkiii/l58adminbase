<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order ;
class OrderController extends AdminBase
{
    public function list()
    {
        parent::check_module();

        $orders = Order::paginate(10);

        return view('admin.order.list',compact('orders'));
    }
}
