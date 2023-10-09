<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Mapa
 *
 * @property $Comuna
 * @property $frame
 *
 * @property Mapa $mapa
 * @property Mapa $mapa
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Mapa extends Model
{
    
    static $rules = [
		'Comuna' => 'required',
		'frame' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Comuna','frame'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mapa()
    {
        return $this->hasOne('App\Models\Mapa', 'PK_Mapa', 'Comuna');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mapas()
    {
        return $this->hasOne('App\Models\Mapa', 'PK_Mapa', 'Comuna');
    }
    

}
