<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataTms extends Model
{
    use HasFactory;
    public function pendukung()
    {
        return $this->hasMany(TmsPendukung::class);
    }
}
