<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     *
     */
    public function up(): void
    {
        if (!Schema::hasTable('categories_products')) {
            Schema::create('categories_products', function (Blueprint $table) {
                $table->id();
                $table->integer('products_id')->unsigned();
                $table->integer('categories_id')->unsigned();



                $table->timestamps();
            });
            Schema::table('categories_products', function ($table) {
                $table->foreign('products_id')->references('id')->on('products')->onDelete('cascade');
                $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories_products');
    }
};
