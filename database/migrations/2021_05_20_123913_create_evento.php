<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvento extends Migration
{

    public function up()
    {
        Schema::create('evento', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codemp')->default('0101');
            $table->string('loja')->default('01');
            $table->unique(['codemp','loja', 'id']);


            $table->string('title');
            $table->date('start');
            $table->date('end');
            $table->string('backgroundcolor')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('evento');
    }
}
