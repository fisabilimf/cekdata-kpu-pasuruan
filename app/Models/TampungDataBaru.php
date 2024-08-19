<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TampungDataBaru extends Model
{
    use HasFactory;

    public function pendukung()
    {
        return $this->hasMany(BaruPendukung::class);
    }
}
