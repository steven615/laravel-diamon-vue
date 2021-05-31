<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCliente extends Migration
{
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codemp')->default('0101');
            $table->string('loja')->default('01');
            $table->unique(['codemp','loja', 'id']);

            $table->string('codigo')->nullable();
            $table->string('nome')->nullable();
            $table->string('fantasia')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('email')->nullable();
            $table->string('cidade')->nullable();
            $table->string('status')->nullable();
            $table->string('inscricao')->nullable();
            $table->string('rua')->nullable();
            $table->string('numero')->nullable();
            $table->string('compl')->nullable();
            $table->string('bairro')->nullable();
            $table->string('estado')->nullable();
            $table->string('cep')->nullable();
            $table->string('tel1')->nullable();
            $table->string('tel2')->nullable();
            $table->decimal('limite',15,4)->nullable();
            $table->string('latlong')->nullable();
            $table->date('nascim')->nullable();
            $table->integer('classe')->default(0);
            $table->string('prodpreco')->nullable();
            $table->string('tipo')->nullable();
            $table->string('repres')->nullable();
            $table->timestamp('dtultcompra')->default('1990-01-01 00:00:0000');
            $table->timestamp('dtpricompra')->default('1990-01-01 00:00:0000');
            $table->string('formapgto')->nullable();
            $table->string('condpgtos')->nullable();
            $table->decimal('desconto',15,4)->nullable();

            $table->string('livre1')->nullable();
            $table->string('livre2')->nullable();
            $table->string('livre3')->nullable();
            $table->string('livre4')->nullable();

            $table->timestamp('deletm2')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cliente');
    }
}
