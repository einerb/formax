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
            $table->uuid('id')->unique();
            $table->string('channel');
            $table->enum('state', array('Reservada', 'Pendiente', 'En tránsito', 'Listo para recoger', 'Cerrada', 'Cancelada'));
            $table->double('value');
            $table->integer('discount');
            $table->enum('delivery', array('Estándar', 'Express'));
            $table->enum('dispatch', array('Entrega en tienda', 'Entrega en domicilio'));
            $table->string('items', []);
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
