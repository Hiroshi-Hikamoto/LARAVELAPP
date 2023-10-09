<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Carguemasivowab
 *
 * @property $id
 * @property $Celular
 * @property $Plantilla
 * @property $id_cargue
 * @property $estado
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Carguemasivowab extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Celular','Plantilla','id_cargue','estado'];



}
