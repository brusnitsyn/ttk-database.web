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
            $table->decimal('cost', 13);
            $table->decimal('weight', 8);
            $table->string('image', 320);
            $table->foreignId('equipment_manufacturers_id')->references('id')->on('equipment_manufacturers')->onDelete('cascade');

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
