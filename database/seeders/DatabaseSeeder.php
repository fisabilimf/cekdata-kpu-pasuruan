<?php

namespace Database\Seeders;

use App\Models\KodeTms;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $kodeTms = new KodeTms();
        $kodeTms->kode = 1;
        $kodeTms->desripsi = '';

        $kodeTms = new KodeTms();
        $kodeTms->kode = 1;
        $kodeTms->deskripsi = 'Meninggal dunia';
        $kodeTms->save();
        $kodeTms = new KodeTms();
        $kodeTms->kode = 2;
        $kodeTms->deskripsi = 'Ditemukan data ganda';
        $kodeTms->save();
        $kodeTms = new KodeTms();
        $kodeTms->kode = 3;
        $kodeTms->deskripsi = 'Dibawah Umur';
        $kodeTms->save();
        $kodeTms = new KodeTms();
        $kodeTms->kode = 4;
        $kodeTms->deskripsi = 'Pindah Domisili';
        $kodeTms->save();
        $kodeTms = new KodeTms();
        $kodeTms->kode = 5;
        $kodeTms->deskripsi = 'Tidak Dikenal';
        $kodeTms->save();
        $kodeTms = new KodeTms();
        $kodeTms->kode = 6;
        $kodeTms->deskripsi = 'TNI';
        $kodeTms->save();
        $kodeTms = new KodeTms();
        $kodeTms->kode = 7;
        $kodeTms->deskripsi = 'Polri';
        $kodeTms->save();
        $kodeTms = new KodeTms();
        $kodeTms->kode = 8;
        $kodeTms->deskripsi = 'Hilang ingatan';
        $kodeTms->save();
        $kodeTms = new KodeTms();
        $kodeTms->kode = 9;
        $kodeTms->deskripsi = ' di Cabut';
        $kodeTms->save();
        $kodeTms = new KodeTms();
        $kodeTms->kode = 10;
        $kodeTms->deskripsi = 'Bukan Penduduk';
        $kodeTms->save();

        $user = new User();
        $user->name = 'super';
        $user->email = 'admin@example.com';
        $user->password = Hash::make('admin');
        $user->save();

        $this->call([
            DataPemilihSeeder::class,
            DataTmsSeeder::class,
            DataUbahSeeder::class,
        ]);
    }
}
