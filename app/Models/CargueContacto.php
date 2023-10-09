<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CargueContacto
 *
 * @property $id
 * @property $contacto
 * @property $var1
 * @property $var2
 * @property $var3
 * @property $var4
 * @property $var5
 * @property $var6
 * @property $var7
 * @property $var8
 * @property $var9
 * @property $var10
 * @property $id_usuario
 * @property $id_campaña
 * @property $fec_creacion
 * @property $estado
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CargueContacto extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['contacto','var1','var2','var3','var4','var5','var6','var7','var8','var9','var10','id_usuario','id_campaña','fec_creacion','estado'];



}
