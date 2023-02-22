<?php

namespace App\Imports;

use App\Models\Santri;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Carbon\Carbon;

class ImportSantri implements ToModel, WithHeadingRow,  WithUpserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Santri([
            'nis' => $row['nis'],
            'namalengkap' => $row['nama_lengkap'],
            'tmplahir' => $row['tempat_lahir'],
            'tgllahir' => Carbon::parse($row['tanggal_lahir'])->format('Y-m-d'),
            'kelamin' => $row['jenis_kelamin'],
            'alamat' => $row['alamat'],
            'status' => $row['status']
        ]);
    }

    public function uniqueBy()
    {
        return 'nis';
    }
}
