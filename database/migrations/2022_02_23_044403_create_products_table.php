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
            $table->unsignedBigInteger('source_id');
            $table->unsignedBigInteger('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->text('name')->nullable();
            $table->foreignId('category_id')->nullable()->references('id')->on('categories')->nullOnDelete();
            $table->integer('sub_limit')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_special')->default(false);
            $table->boolean('by_recipe')->default(false);
            $table->foreignId('brand_id')->nullable()->references('id')->on('brands')->cascadeOnDelete();
            $table->string('country')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('lft')->default(0);
            $table->integer('rgt')->default(0);
            $table->integer('depth')->default(0);
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
