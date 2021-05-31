<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Produto extends Model
{
    use SoftDeletes;

    public $table = 'produto';
    protected $dates = ['deleted_at'];

    public $fillable = [
        'codemp',
        'loja',
        'codigo',
        'descricao',
        'descricaoaux',
        'descricaohtml',
        'status',
        'categoria',
        'unidade',
        'preco',
        'multiplo',
        'tipo',
        'grupo',
        'subgrupo',
        'secao',
        'codaux',
        'atributo',
        'fabricante',
        'pesobrt',
        'pesoliq',
        'saldo',
        'icms',
        'ipi',
        'icmsst',
        'livre1',
        'livre2',
        'livre3',

        'created_by',
        'updated_by'
    ];


    protected $casts = [
        'codemp' => 'string',
        'codigo' => 'string',
        'loja' => 'string',
        'descricao' => 'string',
        'status' => 'string',
        'categoria' => 'string',
        'unidade' => 'string',
        'atributo' => 'string',
        'tipo' => 'string',
        'grupo' => 'string',
        'subgrupo' => 'string',
        'secao' => 'string',
        'codaux' => 'string',
        'fabricante' => 'string',
        'livre1' => 'string',
        'livre2' => 'string',
        'livre3' => 'string',

        'created_by' => 'string',
        'updated_by' => 'string'
    ];


    public static $rules = [

    ];


}
