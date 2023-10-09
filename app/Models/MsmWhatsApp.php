<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MsmWhatsApp
 *
 * @property $id
 * @property $from
 * @property $to
 * @property $idMsg
 * @property $text
 * @property $tipo
 * @property $idMsgReference
 * @property $updated_at
 * @property $created_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class MsmWhatsApp extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['from','to','idMsg','text','tipo','idMsgReference','status'];



}
