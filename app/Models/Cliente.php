<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Cliente extends Model
{
    use SoftDeletes;

    public $table = 'cliente';
    protected $dates = ['deleted_at','nascim','dtpricompra','dtultcompra'];


    public $fillable = [
        'codemp',
        'loja',
        'codigo',
        'nome',
        'cnpj',
        'email',
        'cidade',
        'status',
        'fantasia',
        'inscricao',
        'rua',
        'numero',
        'compl',
        'bairro',
        'estado',
        'cep',
        'tel1',
        'tel2',
        'limite',
        'nascim',
        'tipo',
        'livre1',
        'livre2',
        'repres',
        'dtpricompra',
        'dtultcompra',
        'classe',



        'created_by',
        'updated_by'
    ];



    protected $casts = [
        'nome' => 'string',
        'empresa' => 'string',
        'cnpj' => 'string',
        'email' => 'string',
        'cidade' => 'string',
        'status' => 'string',
        'codexterno' => 'string',
        'fantasia' => 'string',
        'inscricao' => 'string',
        'rua' => 'string',
        'numero' => 'string',
        'compl' => 'string',
        'bairro' => 'string',
        'estado' => 'string',
        'cep' => 'string',
        'tel1' => 'string',
        'tel2' => 'string',
        'nascim' => 'date',
        'tipo' => 'string',
        'livre1' => 'string',
        'livre2' => 'string',
        'repres' => 'string',
        'classe' => 'integer',


        'created_by' => 'string',
        'updated_by' => 'string'
    ];



    public static $rules = [

    ];

}
