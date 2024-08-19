<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUbah extends Model
{
    use HasFactory;

    public function dataLama()
    {
        return $this->hasOne(DataPemilih::class);
    }

    public function dataBaru()
    {
        return $this->belongsTo(DataPemilih::class, 'data_pemilih_id','id');
    }

    public function pendukung()
    {
        return $this->hasMany(UbahPendukung::class);
    }
}
