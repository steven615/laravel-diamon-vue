<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CondPgto extends Model
{
    use SoftDeletes;

    public $table = 'condpgto';
    protected $dates = ['deleted_at'];


    public $fillable = [
        'codemp',
        'loja',
        'codigo',
        'descricao',
        'qtditens',
        'valormin',
        'status',
        'created_by',
        'updated_by'
    ];



    protected $casts = [
        'codigo' => 'string',
        'empresa' => 'string',
        'descricao' => 'string',
        'status' => 'string',
        'qtditens' => 'integer',
        'created_by' => 'string',
        'updated_by' => 'string'
    ];



    public static $rules = [

    ];
}
