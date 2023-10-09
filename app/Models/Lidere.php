<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * Class Lidere
 *
 * @property $id
 * @property $Cedula
 * @property $nom_completo
 * @property $Celular
 * @property $Org_departamento
 * @property $Org_Ciudad
 * @property $Org_Comuna
 * @property $Puesto_Votacion
 * @property $Colb_Org
 * @property $Colb_Mpio
 * @property $Autorizo
 * @property $Grupo_Primario
 * @property $Equipo_Coord_Comuna
 * @property $Equipo_Direccion_Com
 * @property $Jefe_Zona_Electoral
 * @property $Jefe_Puesto_Electoral
 * @property $Capitan_Barrio
 * @property $Capitan_Cuadra
 * @property $Vehiculos
 * @property $Sitios
 * @property $Observacion
 * @property $cod_coordinador
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Lidere extends Model
{
    use Searchable;
    static $rules = [
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id','Cedula','nom_completo','Celular','Org_departamento','Org_Ciudad','Org_Comuna','Puesto_Votacion','Colb_Org','Colb_Mpio','Autorizo','Grupo_Primario','Equipo_Coord_Comuna','Equipo_Direccion_Com','Jefe_Zona_Electoral','Jefe_Puesto_Electoral','Capitan_Barrio','Capitan_Cuadra','Vehiculos','Sitios','Observacion','cod_coordinador','foto'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lidere()
    {
        return $this->hasOne('App\Models\Lidere', 'PK__Lideres__3213E83F6E083497', 'id');
    }

}