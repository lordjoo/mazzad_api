<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_migration', function (Blueprint $table) {
            $table->id();
            $table->string("seller_id")->unique();
            $table->string("name");
            $table->string("description")->nullable();
            //$table->string("images");
            $table->integer("price");
            $table->string("keywords");
            $table->string("category");
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
        Schema::dropIfExists('products_migration');
    }
}
