<?php

namespace App\Exports;

use App\Models\DataPemilih;
use App\Models\DataUbah;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataTmsExport implements FromCollection
{
    public function collection()
    {
        return DataPemilih::whereNotNull('data_tms_id')->get();
    }
}
