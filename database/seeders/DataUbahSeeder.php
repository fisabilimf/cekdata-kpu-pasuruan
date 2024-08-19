<?php

namespace Database\Seeders;

use App\Models\DataUbah;
use Illuminate\Database\Seeder;

class DataUbahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $ubah = new DataUbah();
        $ubah->data_pemilih_id = 273;
        $ubah->save();
        $ubah = new DataUbah();
        $ubah->data_pemilih_id = 274;
        $ubah->save();
    }
}
