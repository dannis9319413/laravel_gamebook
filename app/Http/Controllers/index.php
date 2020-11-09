<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class index extends Controller
{
    public function index()
    {
        $all_categories = DB::table('categories')->get();
        $all_pres = DB::table('products')->where('pre', 1)->get();
        $all_news = DB::table('products')->where('new', 1)->get();
        $all_specials = DB::table('products')->where('special', 1)->orderBy('created_at', 'desc')->paginate(6);
        $All_news = DB::table('news')->orderBy('created_at', 'desc')->paginate(3);
        return view('index', compact('all_categories', 'all_pres', 'all_news', 'all_specials', 'All_news'));
    }
}
