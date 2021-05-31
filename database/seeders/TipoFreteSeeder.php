<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoFreteSeeder extends Seeder
{

    public function run()
    {
        DB::table('tipofrete')->truncate();
        $statement = "INSERT INTO ".env('DB_PREFIX')."`tipofrete` (`codigo`, `descricao`, `status`,`created_at`, `updated_at`) VALUES
            ('C', 'CIF', 'A', now(), now()),
            ('F', 'FOB', 'A', now(), now())
            ;
            ";
        DB::unprepared($statement);
    }
}
