<?php

namespace App\Imports;

use App\Models\CargueContacto;
use Maatwebsite\Excel\Concerns\ToModel;

class cargueContactosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new cargueContactos([
            'contacto' => $row[0],
            'var1' => $row[1],
            'var2' => $row[2],
            'var3' => $row[3],
            'var4' => $row[4],
            'var5' => $row[5],
            'var6' => $row[6],
            'var7' => $row[7],
            'var8' => $row[8],
            'var9' => $row[9],
            'var10' => $row[10],
            'id_usuario' => $row[11],
            'id_campaña' => $row[12],
            'fec_creacion' => $row[13],
            'estado' => $row[14],
        ]);
    }
}
