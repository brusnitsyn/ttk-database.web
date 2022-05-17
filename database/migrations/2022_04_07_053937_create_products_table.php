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
            $table->string('original_article', 255)->nullable();
            $table->decimal('actual_price', 13)->nullable();
            $table->decimal('discount_price', 13)->nullable();
            // $table->decimal('weight', 8);
            // $table->decimal('width', 8)->nullable();
            // $table->decimal('diameter', 8)->nullable();
            // $table->decimal('thickness', 8)->nullable();
            // $table->decimal('height', 8)->nullable();
            // $table->decimal('length', 8)->nullable();
            // $table->string('hole', 320)->nullable();
            // $table->string('mounting_hole', 320)->nullable();
            // $table->string('capture_width', 320)->nullable();
            // $table->string('thread', 320)->nullable();
            // $table->string('distance_between_holes', 320)->nullable();
            $table->text('description')->nullable();
            $table->string('preview_image', 320);
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
