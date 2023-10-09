<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AsistenciaEvento
 *
 * @property $id
 * @property $Cedula
 * @property $Nombre_completo
 * @property $Celular
 * @property $Direccion
 * @property $Correo
 * @property $Fecha_nacimiento
 * @property $Referido
 * @property $id_evento
 * @property $updated_at
 * @property $created_at
 * @property $Rept
 *
 * @property AsistenciaEvento $asistenciaEvento
 * @property AsistenciaEvento $asistenciaEvento
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class AsistenciaEvento extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Cedula','Nombre_completo','Celular','Direccion','Correo','Fecha_nacimiento','Referido','id_evento','Rept'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function asistenciaEvento()
    {
        return $this->hasOne('App\Models\AsistenciaEvento', 'PK_AsistenciaEvento', 'id');
    }

}
