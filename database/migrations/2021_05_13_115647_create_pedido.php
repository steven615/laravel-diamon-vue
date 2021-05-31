<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedido extends Migration
{

    public function up()
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codemp')->default('0101');
            $table->string('loja')->default('01');
            $table->unique(['codemp','loja', 'id']);

            $table->string('codigo')->nullable();
            $table->string('tipo')->nullable();
            $table->string('cliente')->nullable();
            $table->string('condpgto')->nullable();
            $table->string('formapgto')->nullable();
            $table->string('repres')->nullable();
            $table->timestamp('dtemissao')->nullable();
            $table->string('status')->nullable();
            $table->string('obs')->nullable();
            $table->decimal('valor',15,4)->nullable();
            $table->decimal('peso',15,4)->default(0);
            $table->integer('reserva_id')->nullable();
            $table->timestamp('dtfatura')->nullable();
            $table->string('numfatura')->nullable();
            $table->string('latlong')->nullable();
            $table->string('livre1')->nullable();
            $table->string('livre2')->nullable();
            $table->string('livre3')->nullable();
            $table->string('livre4')->nullable();
            $table->timestamp('dtentrega')->nullable();
            $table->text('obstext')->nullable();
            $table->string('ordemcompra')->nullable();
            $table->string('frete')->nullable();
            $table->integer('transp')->default(0);

            $table->timestamp('deletm2')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('pedido');
    }
}
