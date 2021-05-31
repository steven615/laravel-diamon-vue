<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Evento extends Model
{
    use SoftDeletes;

    public $table = 'evento';
    protected $dates = ['deleted_at','start','end'];


    protected $fillable = [
        'codemp',
        'title',
        'start',
        'end',
        'backgroundcolor',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'title' => 'string',
        'backgroundcolor' => 'string',
        'created_by' => 'string',
        'updated_by' => 'string'
    ];


    public static $rules = [

    ];



}
