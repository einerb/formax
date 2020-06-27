<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->string('order')->unique();
            $table->string('channel');
            $table->enum('state', ['reservada', 'pendiente', 'en transito', 'recoger', 'cerrada', 'cancelada']);
            $table->double('value');
            $table->integer('discount');
            $table->enum('delivery', ['estandar', 'express']);
            $table->enum('dispatch', ['tienda', 'domicilio']);
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
}
