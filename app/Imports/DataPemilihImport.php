<?php

namespace App\Imports;

use App\Models\DataPemilih;
use Hamcrest\Type\IsNumeric;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;

class DataPemilihImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    private $tps = null;

    public function model(array $row)
    {
        if ($row[7] === 'TPS') {
            $this->tps = intval(preg_replace("/[^0-9]/", "", $row[9]));
        }

        if ((!is_numeric($row[0])) || ($row[0] == 0)) {
            return null;
        }

        // dd(date_create_from_format('d\|m\|Y',$row[6]));


        return new DataPemilih([
            //
            'nkk' => $row[2],
            'nik' => $row[3],
            'nama' => $row[4],
            'tempat_l' => $row[5],
            'tanggal_l' => date_format(date_create_from_format('d\|m\|Y',$row[6]), 'Y-m-d'),
            'status' => $row[8],
            'jenkel' => $row[9],
            'jln_dukuh' => $row[10],
            'rt' => $row[11],
            'rw' => $row[12],
            'tps' => $this->tps,
            'disabilitas' => $row[13],
        ]);
    }
}
