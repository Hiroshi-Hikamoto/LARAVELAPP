<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Cargatestigo;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
// WithCustomCsvSettings

class ImportTestigos implements ToModel, WithHeadingRow, WithCustomCsvSettings
{
    // HeadingRowFormatter::default('custom');

    public function model(array $row)
    {
        return new Cargatestigo([
            'Cedula' => $row['Cedula'],
            'PrimerNombre' => $row['PrimerNombre'],
            'SegundoNombre' => $row['SegundoNombre'],
            'PrimerApellido' => $row['PrimerApellido'],
            'SegundoApellido' => $row['SegundoApellido'],
            'Celular' => $row['Celular'],
            'Correo' => $row['Correo'],
            'Departamento' => $row['Departamento'],
            'Municipio' => $row['Municipio'],
            'Zona' => $row['Zona'],
            'Puesto' => $row['Puesto'],
            'Mesa' => $row['Mesa']
        ]);
    }
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ',',
            'enclosure' => '"',
        ];
    }
 
}