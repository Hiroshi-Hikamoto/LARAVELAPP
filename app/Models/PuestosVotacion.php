<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PuestosVotacion
 *
 * @property $Id
 * @property $Codigo
 * @property $Dpt
 * @property $Mpio
 * @property $Zona
 * @property $Pto
 * @property $Comuna
 * @property $Puesto
 * @property $Mujeres
 * @property $Hombres
 * @property $Mesas
 * @property $Direccion
 * @property $Observacion
 * @property $ZonaComuna
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PuestosVotacion extends Model
{
    
    static $rules = [
		'Id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Id','Codigo','Dpt','Mpio','Zona','Pto','Comuna','Puesto','Mujeres','Hombres','Mesas','Direccion','Observacion','ZonaComuna'];



}
