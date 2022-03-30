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
            $table->string('status')->default(\App\Helpers\OrderStatus::NEW);
            $table->foreignId('user_id')->references('id')->on('users')->restrictOnDelete();
            $table->text('address')->nullable();
            $table->foreignId('pharmacy_id')->nullable()->references('id')->on('pharmacies')->nullOnDelete();
            $table->foreignId('payment_method_id')->nullable()->references('id')->on('payment_methods')->nullOnDelete();
            $table->foreignId('delivery_method_id')->nullable()->references('id')->on('payment_methods')->nullOnDelete();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedInteger('cost')->nullable();
            $table->unsignedInteger('used_bonuses')->default(0);
            $table->unsignedInteger('delivery_cost')->default(0);
            $table->text('fields_json')->nullable();
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
