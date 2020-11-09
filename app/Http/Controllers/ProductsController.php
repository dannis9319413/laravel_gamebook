<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        $all_products = DB::table('products')->orderBy('created_at', 'desc')->paginate(5);
        return view('admin.products.list', compact('all_products'));
    }

    public function show()
    {
    }

    public function create()
    {
        $all_categories = DB::table('categories')->get();
        return view('admin.products.create', compact('all_categories'));
    }

    public function store(ProductsRequest $request)
    {
        $products = new Product;

        Product::create($request->all());

        if ($request->hasFile('header')) {
            $header_name = $request->header->getClientOriginalName();
            $request->header->storeAs('uploads/products/' . $request->folder, $header_name, 'public');
            $products->where('name', $request->name)->update(['header' => $header_name]);
        }
        if ($request->hasFile('picture_1')) {
            $picture_1_name = $request->picture_1->getClientOriginalName();
            $request->picture_1->storeAs('uploads/products/' . $request->folder, $picture_1_name, 'public');
            $products->where('name', $request->name)->update(['picture_1' => $picture_1_name]);
        }
        if ($request->hasFile('picture_2')) {
            $picture_2_name = $request->picture_2->getClientOriginalName();
            $request->picture_2->storeAs('uploads/products/' . $request->folder, $picture_2_name, 'public');
            $products->where('name', $request->name)->update(['picture_2' => $picture_2_name]);
        }
        if ($request->hasFile('picture_3')) {
            $picture_3_name = $request->picture_3->getClientOriginalName();
            $request->picture_3->storeAs('uploads/products/' . $request->folder, $picture_3_name, 'public');
            $products->where('name', $request->name)->update(['picture_3' => $picture_3_name]);
        }
        if ($request->hasFile('picture_4')) {
            $picture_4_name = $request->picture_4->getClientOriginalName();
            $request->picture_4->storeAs('uploads/products/' . $request->folder, $picture_4_name, 'public');
            $products->where('name', $request->name)->update(['picture_4' => $picture_4_name]);
        }

        return redirect(route('products.index'))->with('create_success', '新增成功');
    }

    public function edit(Product $product)
    {
        $all_categories = DB::table('categories')->get();
        return view('admin.products.edit', compact('product', 'all_categories'));
    }

    public function update(ProductsRequest $request, Product $product)
    {

        $product->update($request->all());

        if ($request->hasFile('header')) {
            if ($product->header) {
                Storage::delete('public/uploads/products/' . $product->folder . '/' . $product->header);
            }
            $header_name = $request->header->getClientOriginalName();
            $request->header->storeAs('uploads/products/' . $product->folder, $header_name, 'public');
            $product->where('name', $request->name)->update(['header' => $header_name]);
        }
        if ($request->hasFile('picture_1')) {
            if ($product->picture_1) {
                Storage::delete('public/uploads/products/' . $product->folder . '/' . $product->picture_1);
            }
            $picture_1_name = $request->picture_1->getClientOriginalName();
            $request->picture_1->storeAs('uploads/products/' . $product->folder, $picture_1_name, 'public');
            $product->where('name', $request->name)->update(['picture_1' => $picture_1_name]);
        }
        if ($request->hasFile('picture_2')) {
            if ($product->picture_2) {
                Storage::delete('public/uploads/products/' . $product->folder . '/' . $product->picture_2);
            }
            $picture_2_name = $request->picture_2->getClientOriginalName();
            $request->picture_2->storeAs('uploads/products/' . $product->folder, $picture_2_name, 'public');
            $product->where('name', $request->name)->update(['picture_2' => $picture_2_name]);
        }
        if ($request->hasFile('picture_3')) {
            if ($product->picture_3) {
                Storage::delete('public/uploads/products/' . $product->folder . '/' . $product->picture_3);
            }
            $picture_3_name = $request->picture_3->getClientOriginalName();
            $request->picture_3->storeAs('uploads/products/' . $product->folder, $picture_3_name, 'public');
            $product->where('name', $request->name)->update(['picture_3' => $picture_3_name]);
        }
        if ($request->hasFile('picture_4')) {
            if ($product->picture_4) {
                Storage::delete('public/uploads/products/' . $product->folder . '/' . $product->picture_4);
            }
            $picture_4_name = $request->picture_4->getClientOriginalName();
            $request->picture_4->storeAs('uploads/products/' . $product->folder, $picture_4_name, 'public');
            $product->where('name', $request->name)->update(['picture_4' => $picture_4_name]);
        }

        return redirect(route('products.index'))->with('update_success', '更新成功');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        Storage::deleteDirectory('public/uploads/products/' . $product->folder);
        return redirect(route('products.index'))->with('delete_success', '刪除成功');
    }
}
