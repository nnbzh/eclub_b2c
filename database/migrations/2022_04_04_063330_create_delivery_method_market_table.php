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
        Schema::create('delivery_method_market', function (Blueprint $table) {
            $table->foreignId('market_id')->references('id')->on('markets')->cascadeOnDelete();
            $table->foreignId('delivery_method_id')->references('id')->on('delivery_methods')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_method_market');
    }
};
