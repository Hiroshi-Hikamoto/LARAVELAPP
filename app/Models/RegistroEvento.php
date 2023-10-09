<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RegistroEvento
 *
 * @property $Id
 * @property $Nombre_Evento
 * @property $Fecha_Evento
 * @property $Observacion
 * @property $CC_Encargado
 * @property $Departamento
 * @property $Municipio
 * @property $Comuna
 * @property $Sitio_Direccion
 * @property $Asistencia_Esperada
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class RegistroEvento extends Model
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
    protected $fillable = ['Id','Nombre_Evento','Fecha_Evento','Observacion','CC_Encargado','Departamento','Municipio','Comuna','Sitio_Direccion','Asistencia_Esperada'];



}
