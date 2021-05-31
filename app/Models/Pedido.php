<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Pedido extends Model
{
    use SoftDeletes;

    public $table = 'pedido';
    protected $dates = ['deleted_at','dtemissao','dtfatura','dtentrega'];


    public $fillable = [
        'codemp',
        'loja',
        'codigo',
        'tipo',
        'cliente',
        'condpgto',
        'formapgto',
        'dtemissao',
        'status',
        'obs',
        'obstext',
        'valor',
        'reserva_id',
        'dtfatura',
        'numfatura',
        'repres',
        'livre1',
        'livre2',
        'livre3',
        'livre4',
        'dtentrega',
        'ordemcompra',
        'frete',
        'peso',
        'transp',

        'created_by',
        'updated_by'
    ];


    protected $casts = [
        'codemp' => 'string',
        'loja' => 'string',
        'codigo' => 'string',
        'tipo' => 'string',
        'cliente' => 'string',
        'condpgto' => 'string',
        'formapgto' => 'string',
        'status' => 'string',
        'obs' => 'string',
        'obstext' => 'string',
        'reserva_id' => 'integer',
        'numfatura' => 'string',
        'repres' => 'string',
        'livre1' => 'string',
        'livre2' => 'string',
        'livre3' => 'string',
        'livre4' => 'string',
        'ordemcompra' => 'string',
        'frete' => 'string',
        'transp' => 'integer',

        'created_by' => 'string',
        'updated_by' => 'string'
    ];


    public static $rules = [

    ];


    public function pedidoitem()
    {
        return $this->hasMany(PedidoItem::class);
    }



}
