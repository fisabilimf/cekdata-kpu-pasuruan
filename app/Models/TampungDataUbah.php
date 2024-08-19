<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TampungDataUbah extends Model
{
    use HasFactory;

    public function data_pemilih()
    {
        return $this->belongsTo(DataPemilih::class);
    }

    public function pendukung()
    {
        return $this->hasMany(UbahPendukung::class);
    }
}
