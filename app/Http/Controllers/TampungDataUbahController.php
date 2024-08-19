<?php

namespace App\Http\Controllers;

use App\Models\DataPemilih;
use App\Models\TampungDataUbah;
use App\Models\UbahPendukung;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TampungDataUbahController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $search = '';
        $from = 0;
        $limit = null;
        $sort = null;
        $order = null;

        foreach ($request->input() as $key => $value) {
            if ($key === 'search') $search = $value;
            if ($key === 'term') $search = $value;
            if ($key === 'from') $from = $value;
            if ($key === 'offset') $from = $value;
            if ($key === 'limit') $limit = $value;
            if ($key === 'sort') $sort = $value;
            if ($key === 'order') $order = $value;
        }

        if ($limit === null) $limit = 80;

        $queryResult = TampungDataUbah::where('nama','like','%'.$search.'%')->whereNull('data_ubah_id');

        if ($sort && $order) {
            $queryResult = $queryResult->orderBy($sort, strtoupper($order));
        }

        // dd($queryResult->toSql());

        $queryResultCount = $queryResult->get()->count();
        if ($limit > 0) {
            $queryResult = $queryResult->offset($from)->limit($limit)->get(['id','nkk','nik','nama','tempat_l','tanggal_l','status','jenkel','jln_dukuh','rt','rw','disabilitas']);
        } else {
            $queryResult = $queryResult->get(['id','nkk','nik','nama','tempat_l','tanggal_l','status','jenkel','jln_dukuh','rt','rw','disabilitas']);
        }


        if ($request->wantsJson()) {
            return $this->sendResponse($queryResult, [
                'total' => $queryResultCount,
                'from' => $from,
                'limit' => $limit,
            ]);
        } else {
            return view('dataUbah');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'pendukung' => 'required',
            'pendukung.*' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $tampungDataUbah = new TampungDataUbah();
        foreach ($request->input() as $key => $value) {
            if ($key === "nkk") $tampungDataUbah->nkk = strtoupper($value);
            if ($key === "nik") $tampungDataUbah->nik = strtoupper($value);
            if ($key === "nama") $tampungDataUbah->nama = strtoupper($value);
            if ($key === "tempat_l") $tampungDataUbah->tempat_l = strtoupper($value);
            if ($key === "tanggal_l") $tampungDataUbah->tanggal_l = strtoupper($value);
            if ($key === "status") $tampungDataUbah->status = strtoupper($value);
            if ($key === "jenkel") $tampungDataUbah->jenkel = strtoupper($value);
            if ($key === "jln_dukuh") $tampungDataUbah->jln_dukuh = strtoupper($value);
            if ($key === "rt") $tampungDataUbah->rt = strtoupper($value);
            if ($key === "rw") $tampungDataUbah->rw = strtoupper($value);
            if ($key === "disabilitas") $tampungDataUbah->disabilitas = strtoupper($value);
            if ($key === "data_pemilih_id") $tampungDataUbah->data_pemilih_id = strtoupper($value);
        }
        $tampungDataUbah->save();

        $pendukung = [];
        foreach ($request->file('pendukung') as $file) {
            $fileName = $file->getClientOriginalName();
            if (file_exists(public_path('uploads') . '/' . $fileName)) {
                $fnamearray = explode('.', $fileName);
                $fileName = implode('.', array_slice($fnamearray, 0, count($fnamearray) - 1)) . '-' . Carbon::now()->timestamp . '.' . $file->extension();
            }
            $file->move(public_path('uploads'), $fileName);
            $ubahPendukung = new UbahPendukung();
            $ubahPendukung->tampung_data_ubah_id = $tampungDataUbah->id;
            $ubahPendukung->url = '/uploads/'.$fileName;
            $ubahPendukung->save();
            array_push($pendukung, $ubahPendukung);
        }

        return view('konfirmasiDataUbah', ['data' => $tampungDataUbah, 'pendukung' => $pendukung]);
    }

    public function show(DataPemilih $dataPemilih, $nik=null, $nama=null)
    {
        return view('dataUbah', ['data' => $dataPemilih, 'nik'=>$nik, 'nama'=>$nama]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TampungDataUbah  $tampungDataUbah
     * @return \Illuminate\Http\Response
     */
    public function edit(TampungDataUbah $tampungDataUbah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TampungDataUbah  $tampungDataUbah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TampungDataUbah $tampungDataUbah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TampungDataUbah  $tampungDataUbah
     * @return \Illuminate\Http\Response
     */
    public function destroy(TampungDataUbah $tampungDataUbah)
    {
        //
    }
}
