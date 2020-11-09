<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        $all_orders = DB::table('orders')->orderBy('created_at', 'desc')->paginate(5);
        return view('admin.orders.list', compact('all_orders'));
    }

    public function show()
    {
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $order->update($request->all());
        return redirect(route('orders.index'))->with('update_success', '更新成功');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect(route('orders.index'))->with('delete_success', '刪除成功');
    }
}
