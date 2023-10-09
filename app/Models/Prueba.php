<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Prueba
 *
 * @property $id
 * @property $text
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Prueba extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['text'];



}
