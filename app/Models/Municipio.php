<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Municipio
 *
 * @property $ID
 * @property $DPT
 * @property $Mpio
 * @property $municipio
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Municipio extends Model
{
    
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ID','DPT','Mpio','municipio'];

    public static function municipios($id){

        return Municipio::where('DPT', $id);

    }

}
