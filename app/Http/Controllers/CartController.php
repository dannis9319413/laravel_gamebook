<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Order;
use App\Order_detail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function show()
    {
        return view('web.cart');
    }

    public function add(Request $request)
    {
        // 確認商品是否重複
        if (session()->has('cart')) {
            for ($i = 0; $i < count(session()->get('cart')); $i++) {
                if (session('cart')[$i]['product_id'] == $request->product_id) {
                    return redirect(route('web.product', $request->product_id))->with('add_error', '已存在於購物車');
                }
            }
        }
        //如果購物車為空
        $request->session()->push('cart', $request->input());
        return redirect(route('web.product', $request->product_id))->with('add_success', '成功加入購物車');
    }

    public function update(Request $request)
    {
        $update = false;
        if ($request->quantity) {
            for ($i = 0; $i < count(session('cart')); $i++) {
                session()->put('cart.' . $i . '.quantity', $request->quantity[$i]);
                $update = true;
            }
        }
        return redirect(route('web.cart', compact('update')));
    }

    public function delete(Request $request)
    {
        function findIndex($product_id)
        {
            for ($i = 0; $i < count(session()->get('cart')); $i++) {
                if (session('cart')[$i]['product_id'] == $product_id) {
                    return $i;
                }
            }
        }
        $index = findIndex($request->id);
        session()->forget('cart.' . $index);
        $newCart = array_values(session('cart'));
        session()->forget('cart');
        session()->put('cart', $newCart);

        return redirect(route('web.cart'))->with('cart_delete_success', '成功刪除商品');
    }

    public function checkout_1()
    {
        return view('web.checkout_1');
    }

    public function checkout_2(CheckoutRequest $request)
    {
        if ($request->name != null) {
            session()->put('cart_info', ['id' => session('user.id'), 'email' => $request->email, 'name' => $request->name, 'mobile' => $request->mobile, 'zipcode' => $request->zipcode, 'county' => $request->county, 'district' => $request->district, 'address' => $request->address]);
        }
        return view('web.checkout_2');
    }

    public function checkout_3(Request $request)
    {
        session()->put('shipping', $request->shipping);
        return view('web.checkout_3');
    }

    public function order_success(Request $request)
    {
        if (session()->has('cart_info')) {
            Order::create(['order_no' => $request->order_no, 'user_id' => session('cart_info.id'), 'total' => session('total'), 'shipping' => session('shipping'), 'name' => session('cart_info.name'), 'mobile' => session('cart_info.mobile'), 'zipcode' => session('cart_info.zipcode'), 'county' => session('cart_info.county'), 'district' => session('cart_info.district'), 'address' => session('cart_info.address')]);

            $order = DB::table('orders')->where('user_id', session('cart_info.id'))->orderBy('created_at', 'desc')->first();

            for ($i = 0; $i < count(session('cart')); $i++) {
                Order_detail::create(['order_id' => $order->id, 'product_id' => session('cart.' . $i . '.product_id'), 'folder' => session('cart.' . $i . '.folder'), 'header' => session('cart.' . $i . '.header'), 'name' => session('cart.' . $i . '.name'), 'price' => session('cart.' . $i . '.price'), 'quantity' => session('cart.' . $i . '.quantity')]);
            }
            session()->forget(['cart_info', 'total', 'shipping', 'cart']);
            session()->save();
        }

        return view('web.order_success');
    }
}
