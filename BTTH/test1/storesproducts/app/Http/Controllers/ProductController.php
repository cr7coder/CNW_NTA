<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Store;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fix the relation in pagination, use 'store' as the relation name
        $products = Product::with('store')->paginate(5); // 5 is the number of items per page
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stores = Store::all();
        return view('products.create', compact('stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'store_id' => 'required|exists:stores,id',  // Cửa hàng phải tồn tại trong bảng stores
            'name' => 'required|string',                 // Tên sản phẩm là chuỗi và bắt buộc
            'description' => 'nullable|string',          // Mô tả là chuỗi nhưng không bắt buộc
            'price' => 'required|numeric|gt:0',  
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $stores = Store::all();
        return view('products.edit', compact('product', 'stores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'store_id' => 'required|exists:stores,id', // Cửa hàng phải tồn tại trong bảng stores
        'name' => 'required|string', // Tên sản phẩm bắt buộc và phải là chuỗi
        'description' => 'nullable|string', // Mô tả không bắt buộc
        'price' => 'required|numeric|min:0.01', // Giá phải là số và lớn hơn 0
        ]);

        $product = Product::find($id);
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được xóa.');
    }
}
