<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProdutoSeeder extends Seeder
{

    public function run()
    {
        $now = date("Y-m-d H:i:s");


        DB::table("produto")->insert([
            [
                "codemp" => '0001',
                "codigo" => "10",
                "descricao" => "Produto Teste 1",
                "descricaoaux" => "Descrição auxiliar produtos",
                "descricaohtml" => "<p>Descrição html produtos</p> <p> Texto de demonstração</p>",
                "status" => "A",
                "unidade" => "UND",
                "preco" => 32,
                "atributo" => "destaque",
                "categoria" => 1,
                "loja" => "01",
                "created_at" => $now,
            ],
            [
                "codemp" => '0001',
                "codigo" => "11",
                "descricao" => "Produto Teste 2",
                "descricaoaux" => "Descrição auxiliar produtos",
                "descricaohtml" => "<p>Descrição html produtos</p> <p> Texto de demonstração</p>",
                "status" => "A",
                "unidade" => "UND",
                "preco" => 44.8,
                "atributo" => "destaque",
                "categoria" => 2,
                "loja" => "01",
                "created_at" => $now,
            ],
            [
                "codemp" => '0001',
                "codigo" => "12",
                "descricao" => "Produto Teste 3",
                "descricaoaux" => "Descrição auxiliar produtos",
                "descricaohtml" => "<p>Descrição html produtos</p> <p> Texto de demonstração</p>",
                "status" => "A",
                "unidade" => "UND",
                "preco" => 80.99,
                "atributo" => "destaque",
                "categoria" => 3,
                "loja" => "01",
                "created_at" => $now,
            ],
            [
                "codemp" => '0001',
                "codigo" => "13",
                "descricao" => "Produto Teste 4",
                "descricaoaux" => "Descrição auxiliar produtos",
                "descricaohtml" => "<p>Descrição html produtos</p> <p> Texto de demonstração</p>",
                "status" => "A",
                "unidade" => "UND",
                "preco" => 14.00,
                "atributo" => "destaque",
                "categoria" => 4,
                "loja" => "01",
                "created_at" => $now,
            ],
            [
                "codemp" => '0001',
                "codigo" => "14",
                "descricao" => "Produto Teste 4",
                "descricaoaux" => "Descrição auxiliar produtos",
                "descricaohtml" => "<p>Descrição html produtos</p> <p> Texto de demonstração</p>",
                "status" => "A",
                "unidade" => "UND",
                "preco" => 45.00,
                "atributo" => "destaque",
                "categoria" => 3,
                "loja" => "01",
                "created_at" => $now,
            ],
            [
                "codemp" => '0001',
                "codigo" => "15",
                "descricao" => "Produto Teste 5",
                "descricaoaux" => "Descrição auxiliar produtos",
                "descricaohtml" => "<p>Descrição html produtos</p> <p> Texto de demonstração</p>",
                "status" => "A",
                "unidade" => "UND",
                "preco" => 70.00,
                "atributo" => "destaque",
                "categoria" => 4,
                "loja" => "01",
                "created_at" => $now,
            ],
            [
                "codemp" => '0001',
                "codigo" => "16",
                "descricao" => "Produto Teste 6",
                "descricaoaux" => "Descrição auxiliar produtos",
                "descricaohtml" => "<p>Descrição html produtos</p> <p> Texto de demonstração</p>",
                "status" => "A",
                "unidade" => "UND",
                "preco" => 1400.00,
                "atributo" => "destaque",
                "categoria" => 4,
                "loja" => "01",
                "created_at" => $now,
            ],
        ]);
    }
}
