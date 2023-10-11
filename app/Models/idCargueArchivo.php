<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cargatestigo
 *
 * @property $Id
 * @property $NombreArchivo
 * @property $idUser
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class idCargeArchivo extends Model
{
    static $rules = [

		'id' => 'required',
		'NombreArchivo' => 'required',
		'idUser' => 'required',
        
        ]
    protected $perPage = 20;
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id','NombreArchivo','idUser'];
}

