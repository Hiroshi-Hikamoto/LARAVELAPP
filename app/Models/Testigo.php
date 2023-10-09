<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Testigo
 *
 * @property $id
 * @property $Cedula
 * @property $PrimerNombre
 * @property $SegundoNombre
 * @property $PrimerApellido
 * @property $SegundoApellido
 * @property $Celular
 * @property $id_departamento
 * @property $id_municipio
 * @property $id_puesto
 * @property $mesa
 * @property $id_campaña
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Testigo extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Cedula','PrimerNombre', 'SegundoNombre','PrimerApellido', 'SegundoApellido','Celular','id_departamento','id_municipio','id_puesto','mesa','id_campaña'];



}
