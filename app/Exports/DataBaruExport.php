<?php

namespace App\Exports;

use App\Models\DataPemilih;
use App\Models\DataUbah;
use App\Models\TampungDataBaru;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataBaruExport implements FromCollection
{
    public function collection()
    {
        return DataPemilih::whereIn('id',TampungDataBaru::whereNotNull('data_baru_id')->pluck('data_baru_id'))->get();
    }
}
