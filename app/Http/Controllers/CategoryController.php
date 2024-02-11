<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $categorie = Category::paginate(10);
        return $categorie;
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
        $categorie = Category::find($request->input('id'));
        $categorie->label = $request->input('label');

        $categorie->update();
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy()
    {
        Category::truncate();
    }
}
