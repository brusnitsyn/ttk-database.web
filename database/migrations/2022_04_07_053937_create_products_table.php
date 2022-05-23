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
            $table->string('article', 255)->nullable();
            $table->string('original_article', 255)->nullable();
            $table->decimal('actual_price', 13)->nullable();
            $table->decimal('discount_price', 13)->nullable();
            $table->text('description')->nullable();
            $table->foreignId('brand_id')->references('id')->on('brands')->onDelete('cascade');

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
