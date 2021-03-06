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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sku');
            $table->foreignId('city_id')->nullable()->references('id')->on('cities')->nullOnDelete();
            $table->foreignId('market_number')->references('number')->on('markets')->cascadeOnDelete();
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedBigInteger('sub_price')->default(0);
            $table->unsignedBigInteger('changed_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices');
    }
};
