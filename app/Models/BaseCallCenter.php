<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseCallCenter
 *
 * @property $id
 * @property $Tratamiento
 * @property $cedula
 * @property $Nombre
 * @property $Segundo_Nombre
 * @property $Apellido
 * @property $Segundo_Apellido
 * @property $Fecha_Nacimiento
 * @property $Direccion
 * @property $Telefono
 * @property $Celular
 * @property $Correo
 * @property $Inf_Laboral
 * @property $Profesion
 * @property $Referido_Por
 * @property $CC_Lider_FyA
 * @property $C_Referido
 * @property $C_FYA
 * @property $C_Org
 * @property $Apoya
 * @property $Autoriza
 * @property $Lider_Barrio
 * @property $updated_at
 * @property $created_at
 * @property $estadoContacto
 * @property $notWhatsapp
 * @property $Asiste
 * @property $Actualizo
 * @property $obs_llamada
 * @property $id_usuario
 * @property $id_evento
 *
 * @property BaseCallCenter $baseCallCenter
 * @property BaseCallCenter $baseCallCenter
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BaseCallCenter extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Tratamiento','cedula','Nombre','Segundo_Nombre','Apellido','Segundo_Apellido','Fecha_Nacimiento','Direccion','Telefono','Celular','Correo','Inf_Laboral','Profesion','Referido_Por','CC_Lider_FyA','C_Referido','C_FYA','C_Org','Apoya','Autoriza','Lider_Barrio','estadoContacto','notWhatsapp','Asiste','Actualizo','obs_llamada','id_usuario','id_evento'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function baseCallCenter()
    {
        return $this->hasOne('App\Models\BaseCallCenter', 'PK__base_cal__3213E83FE5138C34', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function baseCallCenters()
    {
        return $this->hasOne('App\Models\BaseCallCenter', 'PK__base_cal__3213E83FE5138C34', 'id');
    }
    

}
