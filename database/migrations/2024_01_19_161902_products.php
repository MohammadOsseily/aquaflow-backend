<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    protected $connection = 'pgsql';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('products'))
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('label');
                $table->float('price');
                $table->text('description');
                $table->string('image');

                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('products'))
            Schema::drop('products');
    }
};
