<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityLog extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'activitylog';
    protected $dates = ['deleted_at'];


    public $fillable = [
        'codemp',
        'loja',
        'funcao',
        'tabela',
        'usuario',
        'objeto',

        'created_by',
        'updated_by'
    ];


    protected $casts = [
        'codemp' => 'string',
        'loja' => 'string',
        'funcao' => 'string',
        'tabela' => 'string',
        'usuario' => 'string',
        'status' => 'string',
        'objeto' => 'string',

        'created_by' => 'string',
        'updated_by' => 'string'
    ];


}
