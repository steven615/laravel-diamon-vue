<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormaPgto extends Model
{
    use SoftDeletes;

    public $table = 'formapgto';
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
        'codemp' => 'string',
        'loja' => 'string',
        'codigo' => 'string',
        'descricao' => 'string',
        'status' => 'string',
        'qtditens' => 'integer',
        'created_by' => 'string',
        'updated_by' => 'string'
    ];



    public static $rules = [

    ];
}
