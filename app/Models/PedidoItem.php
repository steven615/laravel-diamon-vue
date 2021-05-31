<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PedidoItem extends Model
{
    use SoftDeletes;

    public $table = 'pedidoitem';
    protected $dates = ['deleted_at'];


    public $fillable = [
        'codemp',
        'loja',
        'produto',
        'sequenc',
        'und',
        'peso',
        'quant',
        'vlrunit',
        'vlrtotal',
        'desconto',
        'tabpreco',
        'obs',
        'margem1',
        'margem2',
        'margem3',
        'vlrtab',

        'created_by',
        'updated_by'

    ];


    protected $casts = [
        'produto' => 'string',
        'sequenc' => 'integer',
        'und' => 'string',
        'tabpreco' => 'string',
        'obs' => 'string',

        'created_by' => 'string',
        'updated_by' => 'string'
    ];


    public static $rules = [

    ];


    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id');
    }



}
