<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduto extends Migration
{

    public function up()
    {
        
        Schema::defaultStringLength(500);
        Schema::create('produto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codemp')->default('0101');
            $table->string('loja')->default('01');
            $table->unique(['codemp','loja', 'id']);

            $table->string('codigo')->nullable();
            $table->string('descricao')->nullable();
            $table->string('descricaoaux')->nullable();
            $table->string('descricaohtml')->nullable();
            $table->string('unidade')->nullable();
            $table->string('status')->nullable();
            $table->string('categoria')->nullable();
            $table->decimal('preco',15,4)->nullable();
            $table->string('tipo')->nullable();
            $table->string('grupo')->nullable();
            $table->string('subgrupo')->nullable();
            $table->string('secao')->nullable();
            $table->string('codaux')->nullable();
            $table->string('atributo')->nullable();
            $table->string('fabricante')->nullable();
            $table->decimal('pesobrt',15,4)->nullable();
            $table->decimal('pesoliq',15,4)->nullable();
            $table->decimal('saldo',15,4)->nullable();
            $table->decimal('icms',15,4)->nullable();
            $table->decimal('ipi',15,4)->nullable();
            $table->decimal('icmsst',15,4)->nullable();
            $table->string('livre1')->nullable();
            $table->string('livre2')->nullable();
            $table->string('livre3')->nullable();
            $table->timestamp('deletm2')->nullable();


            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('produto');
    }
}
