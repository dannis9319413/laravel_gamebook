<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Order;
use App\Order_detail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function login_page()
    {
        return view('web.login');
    }

    public function login(Request $request)
    {
        $has_user = count(DB::table('users')->where('email', $request->email)->where('password', $request->password)->get());
        $user_data = DB::table('users')->where('email', $request->email)->where('password', $request->password)->get();
        if ($has_user > 0) {
            session()->put('user', ['id' => $user_data[0]->id, 'email' => $user_data[0]->email, 'name' => $user_data[0]->name, 'gender' => $user_data[0]->gender, 'phone' => $user_data[0]->phone, 'mobile' => $user_data[0]->mobile, 'zipcode' => $user_data[0]->zipcode, 'county' => $user_data[0]->county, 'district' => $user_data[0]->district, 'address' => $user_data[0]->address]);
            return redirect(route('index'));
        } else {
            return redirect(route('web.user.login'))->with('login_error', 'Email或密碼錯誤');
        }
    }

    public function register_page()
    {
        return view('web.register');
    }

    public function register(UserRegisterRequest $request)
    {
        $user = new User;
        $has_user = count(DB::table('users')->where('email', $request->email)->get());
        if ($has_user > 0) {
            return redirect(route('web.user.register_result_page'))->with('email_exist', 'Email已重複，請重新註冊');
        }
        if ($request->password == $request->confirm_password) {
            $user->create($request->all());
            session()->put('user', ['email' => $request->email]);
            return redirect(route('web.user.register_result_page'))->with('register_success', '註冊成功!');
        } else {
            return redirect(route('web.user.register_result_page'))->with('register_error', '密碼或確認密碼錯誤，請重新註冊');
        }
    }

    public function register_result_page()
    {
        return view('web.register_result');
    }

    public function logout()
    {
        session()->forget('user');
        return redirect(route('index'));
    }

    public function orders()
    {
        $all_orders = DB::table('orders')->where('user_id', session('user.id'))->orderBy('created_at', 'desc')->get()->toarray();
        return view('web.user_orders', compact('all_orders'));
    }

    public function order(Request $request)
    {
        session()->put('order', $request->id);
        $order = DB::table('orders')->where('id', $request->id)->get()->toArray();
        $all_details = DB::table('order_details')->where('order_id', $request->id)->get()->toArray();
        return view('web.user_order', compact('order', 'all_details'));
    }

    public function delete_order(Request $request)
    {
        DB::table('orders')->where('id', $request->id)->delete();
        DB::table('order_details')->where('order_id', $request->id)->delete();
        return redirect(route('web.user.orders'))->with('delete_success', '刪除成功');
    }

    public function account()
    {
        $has_third_id = count(DB::table('users')->where('third_id', session('user.id'))->get()->toArray());
        if ($has_third_id > 0) {
            $user = DB::table('users')->where('third_id', session('user.id'))->get()->toArray();
        } else {
            $user = DB::table('users')->where('id', session('user.id'))->get()->toArray();
        }
        return view('web.user_account', compact('user'));
    }

    public function update_password(Request $request)
    {
        $old_password = DB::table('users')->where('id', session('user.id'))->get('password')->toArray();
        if ($old_password[0]->password == $request->old_password && $request->new_password == $request->confirm_password) {
            DB::table('users')->where('id', session('user.id'))->update(['password' => $request->new_password]);
            return redirect(route('web.user.account'))->with('update_password_success', '會員資料更新成功');
        } else {
            return redirect(route('web.user.account'))->with('update_password_error', '舊密碼或新密碼錯誤');
        }
    }

    public function update_info(Request $request)
    {
        $has_third_id = count(DB::table('users')->where('third_id', session('user.id'))->get());
        if ($has_third_id > 0) {
            DB::table('users')->where('third_id', session('user.id'))->update(['email' => $request->email, 'name' => $request->name, 'gender' => $request->gender, 'phone' => $request->phone, 'mobile' => $request->mobile, 'zipcode' => $request->zipcode, 'county' => $request->county, 'district' => $request->district, 'address' => $request->address]);
        } else {
            DB::table('users')->where('id', session('user.id'))->update(['name' => $request->name, 'gender' => $request->gender, 'phone' => $request->phone, 'mobile' => $request->mobile, 'zipcode' => $request->zipcode, 'county' => $request->county, 'district' => $request->district, 'address' => $request->address]);
        }
        return redirect(route('web.user.account'))->with('update_success', '會員資料更新成功');
    }
}
