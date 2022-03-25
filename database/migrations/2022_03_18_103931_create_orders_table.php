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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('number')->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->restrictOnDelete();
            $table->foreignId('user_address_id')->nullable()->references('id')->on('user_addresses')->restrictOnDelete();
            $table->foreignId('pharmacy_id')->nullable()->references('id')->on('pharmacies')->restrictOnDelete();
            $table->foreignId('payment_method_id')->references('id')->on('payment_methods')->restrictOnDelete();
            $table->foreignId('delivery_method_id')->references('id')->on('payment_methods')->restrictOnDelete();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedInteger('cost')->nullable();
            $table->unsignedInteger('used_bonuses')->default(0);
            $table->unsignedInteger('delivery_cost')->default(0);
            $table->string('status')->nullable()->default(\App\Helpers\OrderStatus::NEW);
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
        Schema::dropIfExists('orders');
    }
};
