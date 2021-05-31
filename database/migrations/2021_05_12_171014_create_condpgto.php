<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCondpgto extends Migration
{

    public function up()
    {
        Schema::create('condpgto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codemp')->default('0101');
            $table->string('loja')->default('01');
            $table->unique(['codemp','loja', 'id']);

            $table->string('codigo')->nullable();
            $table->string('descricao')->nullable();
            $table->string('status')->nullable();
            $table->integer('qtditens')->nullable();
            $table->decimal('valormin',15,4)->nullable();

            $table->timestamp('deletm2')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('condpgto');
    }
}
