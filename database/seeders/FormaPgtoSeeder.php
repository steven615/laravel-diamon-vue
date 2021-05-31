<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormaPgtoSeeder extends Seeder
{

    public function run()
    {
        DB::table('formapgto')->truncate();
        $statement = "INSERT INTO ".env('DB_PREFIX')."`formapgto` (`codemp`,`codigo`,`descricao`,`status`,`created_at`, `updated_at`) VALUES
            ('0101', '01','Dinheiro', 'A', now(), now()),
            ('0101', '02','Cartao', 'I', now(), now()),
            ('0101', '03','Boleto', 'A', now(), now())

            ;
            ";
        DB::unprepared($statement);
    }
}
