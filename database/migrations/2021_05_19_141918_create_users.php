<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsers extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codemp')->default('0101');
            $table->string('loja')->default('01');
            $table->unique(['codemp','loja', 'id']);

            $table->string('name');
            $table->string('email')->unique();
            $table->string('status')->default('A');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('api_token')->nullable();
            
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();

            $table->timestamp('ultimologin')->nullable();
            $table->timestamp('aceitetermo')->nullable();

            $table->string('codrepres')->nullable();
            $table->string('filtrocli')->nullable();
            $table->string('tipo')->nullable();
            $table->string('nivel')->nullable();


            $table->timestamp('deletm2')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down()
    {
        Schema::dropIfExists('users');
    }
}
