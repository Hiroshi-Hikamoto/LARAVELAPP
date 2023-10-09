<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Bingo
 *
 * @property $id
 * @property $Nombre
 * @property $Fecha
 * @property $estado
 * @property $id_usuario
 * @property $Cant_tablas
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Bingo extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Nombre','Fecha','estado','id_usuario','Cant_tablas','updated_at','created_at'];



}
