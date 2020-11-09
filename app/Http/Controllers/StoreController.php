<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function all()
    {
        $all_categories = DB::table('categories')->get();
        $all_products = DB::table('products')->paginate(9);
        return view('web.store', compact('all_categories', 'all_products'));
    }

    public function discount()
    {
        $all_categories = DB::table('categories')->get();
        $all_products = DB::table('products')->where('special', 1)->paginate(9);
        return view('web.store', compact('all_categories', 'all_products'));
    }

    public function category($category)
    {
        for ($i = 1; $i <= 5; $i++) {
            if ($category == $i) {
                $all_categories = DB::table('categories')->get();
                $all_products = DB::table('products')->where('product_category_id', $i)->paginate(9);
                return view('web.store', compact('all_categories', 'all_products'));
            }
        }
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $product = (new Product)->newQuery();
            if (in_array(1, $request->filters)) {
                $product->where('product_category_id', 1);
            }
            if (in_array(2, $request->filters)) {
                $product->where('product_category_id', 2);
            }
            if (in_array(3, $request->filters)) {
                $product->where('product_category_id', 3);
            }
            if (in_array(4, $request->filters)) {
                $product->where('product_category_id', 4);
            }
            if (in_array(5, $request->filters)) {
                $product->where('product_category_id', 5);
            }
            if (in_array('pre', $request->filters)) {
                $product->where('pre', 1);
            }
            if (in_array('new', $request->filters)) {
                $product->where('new', 1);
            }
            if (in_array('special', $request->filters)) {
                $product->where('special', 1);
            }
            $all_products =  $product->get();
            $output = '';
            foreach ($all_products as $product) {
                $output .=
                    '<div class="card m-1 p-1 col-10 col-md-5 col-lg-5 col-xl-3" style="max-width: 18rem;">
                        <a href="' . route('web.product', $product['id']) . '"><img class="card-img-top" src="' . URL('storage/uploads/products/' . $product['folder'] . '/' . $product['header']) . '" alt="" style="max-height: 7rem"></a>
                        <div class="row card-body justify-content-center">
                            <h6 class="card-text my-3 col-md-12">' . $product['name'] . '</h6>
                            <p class="text-right col-md-12">NT$ ' . $product['price'] . '</p>
                            <a href="' . route('web.product', $product['id']) . '"><button class="btn btn-dark btn-sm col-12 align-self-end">立即購買</button></a>
                        </div>
                    </div>';
            }
            
            if (count($all_products) > 0) {
                return $output;
            } else {
                return '<div class="mt-5"><h5>查無商品</h5></div>';
            }
        }
    }
}
