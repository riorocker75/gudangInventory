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
        $barcode=mt_rand(100000, 999999);
        return new Barang([
            'nama' => $row[1],
            'code' => $row[2], 
            'beli' => $row[3], 
            'jual' => $row[4], 
            'jumlah' => $row[5], 
            'lokasi' => $row[6],
            'barcode' => $barcode,
            'tgl' => date('Y-m-d'),
            'status' => 1,
        ]);
    }
}
