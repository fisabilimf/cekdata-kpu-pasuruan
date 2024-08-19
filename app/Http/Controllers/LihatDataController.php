<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
class LihatDataController extends Controller
{
    public function index()
    {
        $datapemilih= DB::table('data_pemilihs')->get();
        return view('lihatData',['data_pemilih'=>$datapemilih]);

    }

}
