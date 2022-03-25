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
        Schema::create('review_rating_message', function (Blueprint $table) {
            $table->foreignId('review_id')->references('id')->on('reviews')->cascadeOnDelete();
            $table->foreignId('rating_message_id')->references('id')->on('rating_messages')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_rating_message');
    }
};
