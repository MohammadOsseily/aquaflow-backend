<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('products'))
            Schema::create('products', function (Blueprint $table) {
                $table->uuid('id');
                $table->timestamps();
                $table->string('label');
                $table->string('description')->nullable();
                $table->float('price');
                $table->string('sku')->unique();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('products');
    }
};
