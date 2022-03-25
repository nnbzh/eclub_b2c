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
        Schema::create('pharmacy_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sku');
            $table->foreignId('pharmacy_id')->nullable()->references('id')->on('pharmacies')->nullOnDelete();
            $table->bigInteger('quantity')->default(0);
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
        Schema::dropIfExists('pharmacy_stocks');
    }
};
