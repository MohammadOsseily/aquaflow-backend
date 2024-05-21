<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use DB;
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
    public function productCategories(Request $request)
    {

        $category = Category::find(1)->products;
        dd($category);
    }
    public function createproduct(Request $request)
    {
        $validatedData = $request->validate([
            'label' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|string|unique:products,sku',
        ]);

        $product = Product::create($validatedData);

        return response()->json($product, 201);
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
        $product->image = $request->input('image');
        $product->update();
    }
    public function updateproduct(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validatedData = $request->validate([
            'label' => 'string|max:255',
            'description' => 'nullable|string',
            'price' => 'numeric|min:0',
            'stock' => 'integer|min:0',
            'sku' => 'unique:products,sku,' . $product->id, // Exclude current product ID from unique validation
            'image' => 'string',
        ]);

        $product->update($validatedData);

        return response()->json($product);
    }

    public function getproduct($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }


    public function deleteproduct($id)
    {
        Product::where("id", $id)->delete();

        // DB::table('products')->where('id', $id)->delete();


        return response()->json(['message' => 'Product deleted successfully']);
    }



    /**
     * Remove the resource from storage.
     */
    public function destroy()
    {
        Product::truncate();
    }
}
