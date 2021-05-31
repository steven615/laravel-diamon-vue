<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FinanceiroSeeder extends Seeder
{

    public function run()
    {
        $now = Carbon::now();
        $now_mes_mais_um = Carbon::now()->addMonths(1);


        DB::table("financeiro")->insert([

            [
                "codemp" => '00.000.000/0000-00',
                "cliente" => "0013",
                "status" => "A",
                "codigo" => "0000444",
                "emissao" => $now_mes_mais_um,
                "vencimento" => $now_mes_mais_um,
                "obs" => "Observação teste 1",
                "valor" => 270,
                "created_at" => $now,
                "updated_at" => $now,
            ],

            [
                "codemp" => '00.000.000/0000-00',
                "cliente" => "0013",
                "status" => "A",
                "codigo" => "0000845",
                "emissao" => $now_mes_mais_um,
                "vencimento" => $now_mes_mais_um,
                "obs" => "Observação teste 1",
                "valor" => 10780,
                "created_at" => $now,
                "updated_at" => $now,
            ],

            [
                "codemp" => '00.000.000/0000-00',
                "cliente" => "0013",
                "status" => "A",
                "codigo" => "0000100",
                "emissao" => $now_mes_mais_um,
                "vencimento" => $now_mes_mais_um,
                "obs" => "Observação teste 1",
                "valor" => 400,
                "created_at" => $now,
                "updated_at" => $now,
            ],

            [
                "codemp" => '00.000.000/0000-00',
                "cliente" => "0014",
                "status" => "A",
                "codigo" => "0001055",
                "emissao" => $now_mes_mais_um,
                "vencimento" => $now_mes_mais_um,
                "obs" => "Observação teste 1",
                "valor" => 2700,
                "created_at" => $now,
                "updated_at" => $now,
            ],

            [
                "codemp" => '00.000.000/0000-00',
                "cliente" => "0014",
                "status" => "A",
                "codigo" => "0000004",
                "emissao" => $now_mes_mais_um,
                "vencimento" => $now_mes_mais_um,
                "obs" => "Observação teste 1",
                "valor" => 18970,
                "created_at" => $now,
                "updated_at" => $now,
            ],

            [
                "codemp" => '00.000.000/0000-00',
                "cliente" => "0014",
                "status" => "A",
                "codigo" => "0098774",
                "emissao" => $now_mes_mais_um,
                "vencimento" => $now_mes_mais_um,
                "obs" => "Observação teste 1",
                "valor" => 4000,
                "created_at" => $now,
                "updated_at" => $now,
            ],

            [
                "codemp" => '00.000.000/0000-00',
                "cliente" => "0015",
                "status" => "A",
                "codigo" => "0000478",
                "emissao" => $now_mes_mais_um,
                "vencimento" => $now_mes_mais_um,
                "obs" => "Observação teste 1",
                "valor" => 480,
                "created_at" => $now,
                "updated_at" => $now,
            ],

            [
                "codemp" => '00.000.000/0000-00',
                "cliente" => "0015",
                "status" => "A",
                "codigo" => "0000345",
                "emissao" => $now_mes_mais_um,
                "vencimento" => $now_mes_mais_um,
                "obs" => "Observação teste 1",
                "valor" => 570,
                "created_at" => $now,
                "updated_at" => $now,
            ],

            [
                "codemp" => '00.000.000/0000-00',
                "cliente" => "0018",
                "status" => "A",
                "codigo" => "0000187",
                "emissao" => $now_mes_mais_um,
                "vencimento" => $now_mes_mais_um,
                "obs" => "Observação teste 1",
                "valor" => 890,
                "created_at" => $now,
                "updated_at" => $now,
            ],

            [
                "codemp" => '00.000.000/0000-00',
                "cliente" => "0031",
                "status" => "A",
                "codigo" => "0000215",
                "emissao" => $now_mes_mais_um,
                "vencimento" => $now_mes_mais_um,
                "obs" => "Observação teste 1",
                "valor" => 8000,
                "created_at" => $now,
                "updated_at" => $now,
            ],

            [
                "codemp" => '00.000.000/0000-00',
                "cliente" => "0031",
                "status" => "A",
                "codigo" => "0000588",
                "emissao" => $now_mes_mais_um,
                "vencimento" => $now_mes_mais_um,
                "obs" => "Observação teste 1",
                "valor" => 11450,
                "created_at" => $now,
                "updated_at" => $now,
            ],

            [
                "codemp" => '00.000.000/0000-00',
                "cliente" => "0019",
                "status" => "A",
                "codigo" => "0004788",
                "emissao" => $now_mes_mais_um,
                "vencimento" => $now_mes_mais_um,
                "obs" => "Observação teste 1",
                "valor" => 1400,
                "created_at" => $now,
                "updated_at" => $now,
            ],

            [
                "codemp" => '00.000.000/0000-00',
                "cliente" => "0019",
                "status" => "A",
                "codigo" => "0005700",
                "emissao" => $now_mes_mais_um,
                "vencimento" => $now_mes_mais_um,
                "obs" => "Observação teste 1",
                "valor" => 5700,
                "created_at" => $now,
                "updated_at" => $now,
            ]
            ]);

    }
}
