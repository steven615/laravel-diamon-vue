<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoMovSeeder extends Seeder
{

    public function run()
    {
        DB::table('tipomov')->truncate();
        $statement = "INSERT INTO ".env('DB_PREFIX')."`tipomov` (`codigo`, `descricao`, `status`,`created_at`, `updated_at`) VALUES
            ('P', 'Pedido', 'A', now(), now()),
            ('O', 'Orcamento', 'A', now(), now()),
            ('B', 'Bonificacao', 'A', now(), now()),
            ('A', 'Amostra', 'I', now(), now())
            ;
            ";
        DB::unprepared($statement);
    }
}
