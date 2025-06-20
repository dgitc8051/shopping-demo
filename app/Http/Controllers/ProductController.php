<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required',
            'description' => 'required'
        ], [
            'name.required' => '請輸入商品名稱',
            'name.max' => '商品名稱不能超過 255 字',
            'price.required' => '請輸入價格',
            'price.numeric' => '價格必須是數字',
            'price.min' => '價格不可小於 0',
            'stock.required' => '請輸入庫存數量',
            'stock.integer' => '庫存數量必須是整數',
            'stock.min' => '庫存數量不得小於0',
            'category.required' => '請輸入分類',
            'description.required' => '請輸入商品描述'
        ]);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
            'description' => $request->description
        ]);
        return redirect()->route('products.index')->with('success','商品已新增成功!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required',
            'description' => 'required'
        ], [
            'name.required' => '請輸入商品名稱',
            'name.max' => '商品名稱不能超過 255 字',
            'price.required' => '請輸入價格',
            'price.numeric' => '價格必須是數字',
            'price.min' => '價格不可小於 0',
            'stock.required' => '請輸入庫存數量',
            'stock.integer' => '庫存數量必須是整數',
            'stock.min' => '庫存數量不得小於0',
            'category.required' => '請輸入分類',
            'description.required' => '請輸入商品描述'
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
            'description' => $request->description
        ]);
        return redirect()->route('products.index')->with('success', '商品更新成功!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index');
    }
}
