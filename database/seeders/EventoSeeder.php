<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventoSeeder extends Seeder
{

    public function run()
    {
        $now = date("Y-m-d H:i:s");
        $now_dia_menos_oito = Carbon::now()->addDay(1);


        DB::table("evento")->insert([
            [
                "codemp" => '0101',
                "loja" => "10",
                "title" => "Encontro para reunião comercial",
                "start" => $now,
                "end" => Carbon::now()->addDay(1)
            ],


            [
                "codemp" => '0101',
                "loja" => "10",
                "title" => "Nova Nota Fiscal Disponível",
                "start" => Carbon::now()->subDay(7),
                "end" => Carbon::now()->subDay(7)
            ],


            [
                "codemp" => '0101',
                "loja" => "10",
                "title" => "Nova Nota Fiscal Disponível",
                "start" => Carbon::now()->subDay(14),
                "end" => Carbon::now()->subDay(14)
            ],

            [
                "codemp" => '0101',
                "loja" => "10",
                "title" => "Novo Pedido",
                "start" => Carbon::now()->addDay(4),
                "end" => Carbon::now()->addDay(4)
            ],


            [
                "codemp" => '0101',
                "loja" => "10",
                "title" => "Novo Boleto",
                "start" => Carbon::now()->addDay(14),
                "end" => Carbon::now()->addDay(14)
            ],

        ]);
    }
}
