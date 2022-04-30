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
            $table->unsignedBigInteger('seller_id'); // define forgi key  one to many 
            // $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('catogray_id')->nullable();
            $table->double('final_price')->nullable();
            $table->double('initial_price');
            $table->json('image')->nullable();
            $table->string('type', 255);
            $table->datetime('start_date');
            $table->datetime('end_date')->nullable();
            $table->string('keywords');
            $table->double('increase_amount');
            $table->timestamps();
        });

        Schema::table('auctions', function (Blueprint $table) {
            $table->foreign('seller_id')->references('id')->on('users');    
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
