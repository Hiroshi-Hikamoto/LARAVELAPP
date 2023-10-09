<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Apoyo
 *
 * @property $Id
 * @property $Apoyo
 * @property $Observacion
 * @property $Estado
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Apoyo extends Model
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
    protected $fillable = ['Id','Apoyo','Observacion','Estado'];



}
