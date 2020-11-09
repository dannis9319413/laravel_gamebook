<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function show($id)
    {
        $all_categories = DB::table('categories')->get();
        $product = DB::table('products')->where('id', $id)->get();
        return view('web.product', compact('all_categories', 'product'));
    }
}
