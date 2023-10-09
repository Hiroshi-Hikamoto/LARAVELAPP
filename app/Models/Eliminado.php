<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Eliminado
 *
 * @property $ID
 * @property $ID_AFILIADO
 * @property $ID_MOTIVO_ELIMINACION
 * @property $OTRO
 * @property $updated_at
 * @property $created_at
 *
 * @property Eliminado $eliminado
 * @property Eliminado $eliminado
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Eliminado extends Model
{
    
    static $rules = [
		'ID' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ID','ID_AFILIADO','ID_MOTIVO_ELIMINACION','OTRO'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function eliminado()
    {
        return $this->hasOne('App\Models\Eliminado', 'PK__eliminad__3214EC27D148400E', 'ID');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function eliminados()
    {
        return $this->hasOne('App\Models\Eliminado', 'PK__eliminad__3214EC27D148400E', 'ID');
    }
    

}
