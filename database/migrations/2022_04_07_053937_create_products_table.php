<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('article', 255);
            $table->decimal('actual_price', 13);
            $table->decimal('discount_price', 13)->nullable();
            $table->decimal('weight', 8);
            $table->decimal('width', 8);
            $table->decimal('length', 8);
            $table->string('hole', 320)->nullable();
            $table->string('image', 320);

            //$table->foreignId('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
