<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     */
    public function up(): void
    {
        if (!Schema::hasTable('product_categories')) {
            Schema::create('product_categories', function (Blueprint $table) {
                $table->id();
                $table->integer('product_id')->unsigned();
                $table->integer('category_id')->unsigned();

                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');


                $table->timestamps();
            });
            // Schema::table('categories_products', function ($table) {
            //     $table->foreign('products_id')->nullable()->references('id')->on('products')->onDelete('cascade');
            //     $table->foreign('categories_id')->nullable()->references('id')->on('categories')->onDelete('cascade');
            // });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};
