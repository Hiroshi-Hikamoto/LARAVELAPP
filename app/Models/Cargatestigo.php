<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cargatestigo
 *
 * @property $id
 * @property $idCargueArchivo
 * @property $Cedula
 * @property $PrimerNombre
 * @property $SegundoNombre
 * @property $PrimerApellido
 * @property $SegundoApellido
 * @property $Celular
 * @property $Correo
 * @property $Departamento
 * @property $Municipio
 * @property $Zona
 * @property $Puesto
 * @property $Mesa
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cargatestigo extends Model
{
    
    static $rules = [
		'idCargueArchivo' => 'requiered',
		'Cedula' => 'required',
		'PrimerNombre' => 'required',
		'SegundoNombre' => 'required',
		'PrimerApellido' => 'required',
		'SegundoApellido' => 'required',
		'Celular' => 'required',
		'Correo' => 'required',
		'Departamento' => 'required',
		'Municipio' => 'required',
		'Zona' => 'required',
		'Puesto' => 'required',
		'Mesa' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['idCargueArchivo', 'Cedula','PrimerNombre','SegundoNombre','PrimerApellido','SegundoApellido','Celular','Correo','Departamento','Municipio','Zona','Puesto','Mesa'];



}
