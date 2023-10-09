<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Escrutinio
 *
 * @property $id
 * @property $cedula_testigo
 * @property $id_puesto
 * @property $num_mesa
 * @property $votos_camara
 * @property $foto_camara
 * @property $fec_creacion
 * @property $votos_senado
 * @property $foto_senado
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Escrutinio extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cedula_testigo','id_puesto','num_mesa','votos_camara','foto_camara','fec_creacion','votos_senado','foto_senado'];



}
