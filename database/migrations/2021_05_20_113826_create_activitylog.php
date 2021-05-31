<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitylog extends Migration
{

    public function up()
    {
        Schema::create('activitylog', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codemp');
            $table->string('loja')->nullable();
            $table->string('funcao');
            $table->string('tabela');
            $table->string('usuario')->nullable();
            $table->text('objeto')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('activitylog');
    }
}
