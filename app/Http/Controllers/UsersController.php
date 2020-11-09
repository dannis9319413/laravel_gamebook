<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersInfoRequest;
use App\Http\Requests\UsersPasswordRequest;
use App\Http\Requests\UsersRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        $all_users = DB::table('users')->orderBy('created_at', 'desc')->paginate(5);
        return view('admin.users.list', compact('all_users'));
    }

    public function show()
    {
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UsersRequest $request)
    {
        if ($request->password == $request->confirm_password) {
            User::create($request->all());
        } else {
            return redirect(route('users.create'))->with('create_error', 'Email或密碼錯誤');
        }
        return redirect(route('users.index'))->with('create_success', '新增成功');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update_password(UsersPasswordRequest $request, User $user)
    {
        if ($request->new_password == $request->confirm_password) {
            $user->update(['password' => $request->new_password]);
            return redirect(route('users.edit', $user->id))->with('password_success', '密碼更新成功');
        } else {
            return redirect(route('users.edit', $user->id))->with('password_error', '密碼更新失敗');
        }
    }

    public function update(UsersInfoRequest $request, User $user)
    {
        $user->update($request->all());
        return redirect(route('users.index'))->with('update_success', '更新成功');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('users.index'))->with('delete_success', '刪除成功');
    }
}
