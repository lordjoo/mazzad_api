<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('description', 255);
            $table->double('final_price')->nullable();
            $table->double('initial_price');
            $table->json('images')->nullable();
            $table->string('type', 255);
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->string('keywords')->nullable();

            $table->foreignId('category_id')->constrained();
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('auctions');
    }
}
