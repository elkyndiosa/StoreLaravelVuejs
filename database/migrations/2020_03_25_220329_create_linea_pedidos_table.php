<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineaPedidosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('linea_pedidos', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('order');

            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');

            $table->integer('units');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('linea_pedidos');
    }

}
