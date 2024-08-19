<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DataPemilih extends Model
{
    use HasFactory;
    protected $fillable = [
        'nkk',
        'nik',
        'nama',
        'tempat_l',
        'tanggal_l',
        'status',
        'jenkel',
        'jln_dukuh',
        'rt',
        'rw',
        'disabilitas',
        'tps',
        'data_tms_id',
        'data_ubah_id'
    ];

    public function tms() {
        return $this->belongsTo(DataTms::class, 'data_tms_id', 'id');
    }

    public function ubah()
    {
        return $this->belongsTo(DataUbah::class,'data_ubah_id', 'id');
    }
}
