<?php

namespace App\Imports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\ToModel;

class BarangImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Barang([
            'nama' => $row[1],
            'code' => $row[2], 
            'beli' => $row[3], 
            'jual' => $row[4], 
            'jumlah' => $row[5], 
            'lokasi' => $row[6],
        ]);
    }
}
