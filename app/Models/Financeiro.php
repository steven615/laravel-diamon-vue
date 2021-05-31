<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Financeiro extends Model
{
    use SoftDeletes;

    public $table = 'financeiro';
    protected $dates = ['deleted_at','emissao','vencimento'];


    public $fillable = [
        'codemp',
        'loja',
        'codigo',
        'pessoa',
        'status',
        'emissao',
        'vencimento',
        'obs',
        'tipo',
        'conta',
        'valor',
        'pedido_id',
        'livre1',
        'livre2',
        'livre3',
        'livre4',
        'repres',
        'numero',

        'created_by',
        'updated_by'
    ];


    protected $casts = [
        'codigo' => 'string',
        'pessoa' => 'string',
        'status' => 'string',
        'obs' => 'string',
        'tipo' => 'string',
        'conta' => 'string',
        'pedido_id' => 'integer',
        'livre1' => 'string',
        'livre2' => 'string',
        'livre3' => 'string',
        'livre4' => 'string',
        'repres' => 'string',
        'numero' => 'string',

        'created_by' => 'string',
        'updated_by' => 'string'
    ];



    public static $rules = [

    ];
}
