<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{

    public function run(){

        $now = date("Y-m-d H:i:s");

        $user = new User();
        $user->codemp = '0101';
        $user->loja = '01';
        $user->name = 'Administrador';
        $user->tipo = 'A';
        $user->email = 'admin@admin.com.br';
        $user->status = 'A';
        $user->password = Hash::make('#sucesso2020#');
        $user->email_verified_at = $now;
        $user->approved_at = $now;
        $user->save();


        $user = new User();
        $user->codemp = '0101';
        $user->loja = '01';
        $user->name = 'Comercial Testes';
        $user->tipo = 'C';
        $user->email = 'comercial@admin.com.br';
        $user->status = 'A';
        $user->password = Hash::make('#sucesso2020#');
        $user->email_verified_at = $now;
        $user->approved_at = $now;
        $user->save();


        $user = new User();
        $user->codemp = '0101';
        $user->loja = '01';
        $user->name = 'Financeiro Testes';
        $user->tipo = 'D';
        $user->email = 'financeiro@admin.com.br';
        $user->status = 'A';
        $user->password = Hash::make('#sucesso2020#');
        $user->email_verified_at = $now;
        $user->approved_at = $now;
        $user->save();
    }
}
