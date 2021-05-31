<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceiro extends Migration
{

    public function up()
    {
        Schema::create('financeiro', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codemp')->default('0101');
            $table->string('loja')->default('01');
            $table->unique(['codemp','loja', 'id']);

            $table->string('codigo')->nullable();
            $table->string('cliente')->nullable();
            $table->string('status')->nullable();
            $table->timestamp('emissao')->nullable();
            $table->timestamp('vencimento')->nullable();
            $table->string('obs')->nullable();
            $table->string('tipo')->nullable();
            $table->string('conta')->nullable();
            $table->decimal('valor')->nullable();
            $table->integer('pedido_id')->nullable();
            $table->string('repres')->nullable();
            $table->string('livre1')->nullable();
            $table->string('livre2')->nullable();
            $table->string('livre3')->nullable();
            $table->string('livre4')->nullable();
            $table->string('numero')->nullable();


            $table->timestamp('deletm2')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('financeiro');
    }
}
