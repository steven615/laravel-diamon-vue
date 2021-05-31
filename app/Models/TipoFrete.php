<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoFrete extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'tipofrete';
    protected $dates = ['deleted_at'];


    public $fillable = [
        'codemp',
        'loja',
        'codigo',
        'descricao',
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
        'created_by' => 'string',
        'updated_by' => 'string'
    ];



    public static $rules = [

    ];
}
