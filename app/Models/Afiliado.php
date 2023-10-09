<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Afiliado
 *
 * @property $id
 * @property $Cedula
 * @property $Primer_Nombre
 * @property $Segundo_Nombre
 * @property $Primer_Apellido
 * @property $Segundo_Apellido
 * @property $Telefono
 * @property $Direccion
 * @property $Fecha_Nacimiento
 * @property $Parentesco
 * @property $lider
 * @property $estado
 *
 * @property Afiliado $afiliado
 * @property Afiliado $afiliado
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Afiliado extends Model
{
    
    static $rules = [
		'Cedula' => 'required',
		'Primer_Nombre' => 'required',
		'Primer_Apellido' => 'required',
		//'Segundo_Apellido' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Cedula','Primer_Nombre','Segundo_Nombre','Primer_Apellido','Segundo_Apellido','Telefono','Direccion','Fecha_Nacimiento','Parentesco','lider','estado','invitacion','observacion','celular','departamento','ciudad','correo','profesion','universidad','apoyo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function afiliado()
    {
        return $this->hasOne('App\Models\Afiliado', 'PK__afiliado__3213E83FD4D65018', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function afiliadoS()
    {
        return $this->hasOne('App\Models\Afiliado', 'PK__afiliado__3213E83FD4D65018', 'id');
    }
    

}
