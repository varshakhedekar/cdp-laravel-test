<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productsData = Product::get();
        return view('admin.products.list', compact('productsData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.form');
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
            'name' => 'required',
        ], [
            'name.required' => 'Name is required'
        ]);

        DB::beginTransaction();
        $product = new Product();
        $product->image = $request->hidden_image;
        $product->name = trim($request->name);
        $product->price = trim($request->price);
        $product->discount_percentage = trim($request->discount_percentage);
        $product->description = trim($request->description);
        $product->save();
        
        DB::commit();
        if (isset($product)) {
            return redirect()->route('admin.products.index', $product->id)->with(['message' => 'Product created successfully.']);
        } else {
            return redirect()->route('products.create')->with(['error' => 'There seems to be some issue with the data. Please try again.']);
        }
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
        $productsData = Product::where('id', $id)->first();
        return view('admin.products.form', compact('productsData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        // return $product;
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Name is required'
        ]);

        DB::beginTransaction();
        $product->image = $request->hidden_image;
        $product->name = trim($request->name);
        $product->price = trim($request->price);
        $product->discount_percentage = trim($request->discount_percentage);
        $product->description = trim($request->description);
        $product->save();
        
        DB::commit();
        if (isset($product)) {
            return redirect()->route('admin.products.index', $product->id)->with(['message' => 'Product updated successfully.']);
        } else {
            return redirect()->route('admin.products.edit', $product->id)->with(['error' => 'There seems to be some issue with the data. Please try again.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $delete_product = Product::where('id', $id)->delete();
        DB::commit();
        if (isset($delete_product)) {
            return redirect()->route('admin.products.index')->with(['message' => 'Product deleted successfully.']);
        } else {
            return redirect()->route('admin.products.index')->with(['error' => 'There seems to be some issue with the data. Please try again.']);
        }
    }
}
