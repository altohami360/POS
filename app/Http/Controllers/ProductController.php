<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|unique:products|string|max:255',
            'image' => 'mimes:jpg,png,jpeg',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
        ]);

        $request_data = $request->except('image', 'active');
        // $request_data['active'] = $request->active ? true : false;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $image = $request->file('image')->store('images/products', 'public');
            $request_data['image'] =  $image;
        }
        
        Product::create($request_data);
        return redirect()->route('products.index')->with('message', 'Add Product Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'category_id' => 'required',
            'name' => 'required|string|max:255',
            'image' => 'mimes:jpg,png,jpeg',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
        ]);

        $request_data = $request->except('image', 'active');
        // $request_data['active'] = $request->active ? true : false;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->getClientOriginalName();
            $image = $request->file('image')->store('images/products', 'public');
            $request_data['image'] =  $image;
        }
        $product->update($request_data);
        return redirect()->route('products.index')->with('message', 'Update Product Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
