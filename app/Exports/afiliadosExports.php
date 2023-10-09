<?php

namespace App\Exports;

use App\User;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;

class afiliadosExports implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'id',
            'Cedula',
            'primer_Nombre',
            'Segundo_Nombre',
            'primer_Apellido',
            'Segundo_Apellido',
            'Celular',
            'Telefono',
            'Direccion',
            'Observacion',
            'Departamento',
            'Municipio',
            'Puesto',
            'Mesa',
        ];
    }
    public function collection()
    {
        $idLider = auth()->user()->usuario;
        //  $afiliados = DB::table('Afiliados')->where('lider', $idLider)->select('id','Cedula','Primer_Nombre', 'Segundo_Nombre', 'Primer_Apellido', 'Segundo_Apellido', 'celular', 'Telefono', 'Direccion')->get();
         $afiliados = DB::select("select a.id,a.Cedula,a.primer_Nombre,a.Segundo_Nombre,a.primer_Apellido,a.Segundo_Apellido,a.Celular,a.Telefono,a.Direccion,a.observacion,
         d.depto as Departamento,e.municipio,c.Puesto,b.Mesa
         from afiliados a
         left join BD_Getion.dbo.Censo_Electoral b
         on a.Cedula = b.Cedula
         left join BD_Getion.dbo.Puestos_de_Votacion c
         on b.Id_Puesto = c.Id
         left join departamentos d
         on c.Dpt = d.ID_DPT
         left join municipios e
         on c.Mpio = e.ID
         where a.lider = $idLider;");
        //  print_r(collect($afiliados));die();
         return collect($afiliados);

    }
}