<?php

namespace App\Exports;

use App\Models\DataPemilih;
use App\Models\DataUbah;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataUbahExport implements FromCollection
{
    public function collection()
    {
        $collect1 = collect();
        // dd(DataUbah::with('dataLama')->with('dataBaru')->get()->toArray());
        foreach (DataUbah::with('dataLama')->with('dataBaru')->get()->toArray() as $v1) {
            // dd($v1);
            $collect2 = collect();
            foreach ($v1['data_lama'] as $v2) {
                $collect2 = $collect2->concat([$v2]);
            }
            $collect2 = $collect2->concat([null]);
            foreach ($v1['data_baru'] as $v2) {
                $collect2 = $collect2->concat([$v2]);
            }
            $collect1 = $collect1->concat([$collect2->all()]);
        }

        return $collect1;
    }
}
