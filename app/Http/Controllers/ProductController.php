<?php

namespace App\Http\Controllers;

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
        $student = Product::find($request->input('id'));
        $student->label = $request->input('label');
        $student->description = $request->input('description');
        $student->price = $request->input('price');
        $student->sku = $request->input('sku');
        $student->update();
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy()
    {
        Product::truncate();
    }
}
