<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoRelacion
 *
 * @property $Id
 * @property $Tipo
 * @property $Observacion
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TipoRelacion extends Model
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
    protected $fillable = ['Id','Tipo','Observacion'];



}
