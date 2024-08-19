<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DataPemilihImportSheet implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new DataPemilihImport()
        ];
    }

}
