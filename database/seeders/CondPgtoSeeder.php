<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CondPgtoSeeder extends Seeder
{

    public function run()
    {
        DB::table('condpgto')->truncate();
        $statement = "INSERT INTO ".env('DB_PREFIX')."`condpgto` (`descricao`,`codigo`,`status`,`created_at`, `updated_at`) VALUES
            ('A vista','01','A', now(), now()),
            ('30 / 60','02','A', now(), now()),
            ('30 / 60 / 90','03','A', now(), now())
            ;
            ";
        DB::unprepared($statement);
    }
}
