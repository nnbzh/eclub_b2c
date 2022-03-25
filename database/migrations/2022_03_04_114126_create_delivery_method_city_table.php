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
        Schema::create('delivery_method_city', function (Blueprint $table) {
            $table->foreignId('delivery_method_id')->references('id')->on('delivery_methods')->cascadeOnDelete();
            $table->foreignId('city_id')->references('id')->on('cities')->cascadeOnDelete();
            $table->integer('min_price')->default(0)->nullable();
            $table->integer('max_price')->default(999999999)->nullable();
            $table->integer('cost')->nullable();
            $table->boolean('is_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_method_city');
    }
};
