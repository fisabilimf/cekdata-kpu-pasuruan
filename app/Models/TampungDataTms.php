<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TampungDataTms extends Model
{
    use HasFactory;

    public function pendukung()
    {
        return $this->hasMany(TmsPendukung::class);
    }

    public function data_pemilih()
    {
        return $this->belongsTo(DataPemilih::class);
    }
}
