<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoitem extends Migration
{

    public function up()
    {
        Schema::create('pedidoitem', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codemp')->default('0101');
            $table->string('loja')->default('01');
            $table->unique(['codemp','loja', 'id']);

            $table->integer('pedido_id')->unsigned();
            $table->foreign('pedido_id')->references('id')->on('pedido');
            $table->string('produto')->nullable();
            $table->integer('sequenc')->nullable();
            $table->string('und')->nullable();

            $table->decimal('peso',15,4)->nullable();
            $table->decimal('quant',15,4)->nullable();
            $table->decimal('vlrunit',15,4)->nullable();
            $table->decimal('vlrtotal',15,4)->nullable();
            $table->decimal('desconto',15,4)->nullable();

            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('pedidoitem');
    }
}
