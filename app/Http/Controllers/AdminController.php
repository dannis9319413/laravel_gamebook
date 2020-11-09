<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function admin_login(Request $request)
    {
        $has_admin = count(DB::table('admins')->where('account', $request->account)->where('password', $request->password)->get());
        if ($has_admin) {
            session(['admin' =>  $request->account]);
            $all_news = DB::table('news')->orderBy('created_at', 'desc')->paginate(5);
            return view('admin.news.list', compact('all_news'));
        } else {
            return redirect(route('admin.index'))->with('login_error', '帳號密碼錯誤');
        }
    }

    public function admin_logout()
    {
        session()->forget('admin');
        return  redirect(route('admin.index'));
    }
}
