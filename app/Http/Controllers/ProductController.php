<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Show the form for creating the resource.
     */
    public function create()

    {
    }

    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request): never
    {
        abort(404);
    }

    /**
     * Display the resource.
     */
    public function show()
    {
        //
        $product = Product::paginate(10);
        return $product;
    }

    // /**
    //  * Show the form for editing the resource.
    //  */
    public function edit()
    {
        //
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request)
    {
        $product = Product::find($request->input('id'));
        $product->label = $request->input('label');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->sku = $request->input('sku');
        $product->gallery = $request->input('gallery');
        $product->update();
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy()
    {
        Product::truncate();
    }
}
