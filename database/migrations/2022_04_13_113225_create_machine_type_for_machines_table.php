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
        Schema::create('machine_type_for_machines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('machine_id')->references('id')->on('machines')->onDelete('cascade');
            $table->foreignId('machine_type_id')->references('id')->on('machine_types')->onDelete('cascade');
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
        Schema::dropIfExists('machine_type_for_machines');
    }
};
