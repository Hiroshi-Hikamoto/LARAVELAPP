<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Campaña
 *
 * @property $id
 * @property $nombre_campaña
 * @property $estado
 * @property $id_usuario
 * @property $created_at
 * @property $updated_at
 * @property $idTipo
 * @property $idNumero
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Campaña extends Model
{
    
    static $rules = [
		'id_usuario' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre_campaña','estado','id_usuario','idTipo','idNumero'];



}
