<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('category');
            $table->string('name');
            $table->text('description');
            $table->bigInteger('price');
            $table->integer('stock')->unsigned();
            $table->string('status');
            $table->string('image_path');
            
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
}
