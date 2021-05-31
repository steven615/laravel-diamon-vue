<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{

    public function run()
    {
        DB::table('cliente')->truncate();
        $statement = "INSERT INTO ".env('DB_PREFIX')."`cliente` (`codemp`,`loja`,`codigo`,`nome`,`status`,`rua`,`numero`,`compl`,`bairro`,`estado`,`cidade`,`cep`,`tel1`,`tel2`,`cnpj`,`nascim`, `created_at`, `updated_at`) VALUES
            ('0101','01','0013','Cliente Teste 98','A','EUDES SHERRER DE SOUZA','2100','LOJA 04','LARANJEIRAS','ES','SERRA','29165680','027 33369722','','00073562000327',now(),now(),now()),
			('0101','01','0014','Cliente Teste 83','A','EUDES SCHERRER DE SOUZA','1436','','CIVIT II','ES','SERRA','29168061','27  33260894','27  33260894','00041327004794',now(),now(),now()),
			('0101','01','0015','Cliente Teste 76','A','REGIAO SUDESTE','395','SALA: C;','BARCELONA','ES','SERRA','29166200','27  33188052','','00063770000183',now(),now(),now()),
			('0101','01','0016','Cliente Teste 58','A','ATALYDES MOREIRA DE SOUZA','1697','','CIVIT I','ES','SERRA','29168055','27  32180298','27  99041192','00055643000213',now(),now(),now()),
			('0101','01','0017','Cliente Teste 42','A','NESTOR GUISSO','304','','BOA VISTA / CARAPINA','ES','SERRA','29161019','27  32818950','27  32818949','00022128000156',now(),now(),now()),
			('0101','01','0018','Cliente Teste 27','A','DESEMBARGADOR MARIO DA SILVA NUNES','1420','LOJA: 03;','JARDIM LIMOEIRO','ES','SERRA','29164044','27  33312635','27  33312674','00000000692999',now(),now(),now()),
			('0101','01','0019','Cliente Teste 23','A','TERCEIRA AVENIDA','199','','SAO DIOGO I','ES','SERRA','29163266','11  37576876','','00005275000460',now(),now(),now()),
			('0101','01','0022','Cliente Teste 21','A','RUI BARBOSA','40','','FATIMA','ES','SERRA','29160810','027 3372060','','00058177000220',now(),now(),now()),
			('0101','01','0021','Cliente Teste 19','A','ELDES SCHERRER SOUZA','600','','CIVIT II','ES','SERRA','29168060','27  33189505','','00000000522139',now(),now(),now()),
			('0101','01','0031','Cliente Teste 08','A','ES-010','2594','KM: 2.6; QUADRA: CHA; LOTE: 343;','JARDIM LIMOEIRO','ES','SERRA','29164140','21  24291656','','00074569004601',now(),now(),now())

            ;
            ";
        DB::unprepared($statement);
    }
}
