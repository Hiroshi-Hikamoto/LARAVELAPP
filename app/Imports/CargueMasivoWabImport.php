<?php

namespace App\Imports;

use App\Models\CargueMasivoWabUsers;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CargueMasivoWabImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CargueMasivoWabUsers([
            "Celular" => $row['celular'],
            "plantilla" => $row['plantilla'],
            "variable" => $row['variable'],
            "mobile_number" => $row['mobile_number'],
            "role_id" => 2, // User Type User
            "status" => 1,
            "password" => Hash::make('password')
        ]);
    }
}
