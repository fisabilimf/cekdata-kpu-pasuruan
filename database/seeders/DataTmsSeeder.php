<?php

namespace Database\Seeders;

use App\Models\DataTms;
use Illuminate\Database\Seeder;

class DataTmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tms = new DataTms();
        $tms->kode = 1;
        $tms->save();
        $tms = new DataTms();
        $tms->kode = 2;
        $tms->save();
    }
}
