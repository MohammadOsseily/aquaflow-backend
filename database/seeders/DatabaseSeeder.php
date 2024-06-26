<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategorySeeder::run();
        ProductSeeder::run();
        // $products = Product::all();
        // $categories = Category::pluck("id")->toArray();
        // foreach ($products as $product) {
        //     $categoriesRndKey = array_rand($categories, count($categories));
        //     $categoriesValues = [];
        //     foreach ($categoriesRndKey as $key) {
        //         $categoriesValues = $categories[$key];
        //     }
        //     $product->categories()->sync($categoriesValues);
        //     $product->save();
        // }

        UserSeeder::run();

        CartSeeder::run();

        $carts = Cart::all()->toArray();
        $users = User::all();

        foreach ($users as $id => $user) {
            $user->cart()->associate($carts[$id]);
        }
    }
}
