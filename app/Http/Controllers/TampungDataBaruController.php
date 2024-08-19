<?php

namespace App\Http\Controllers;

use App\Models\BaruPendukung;
use App\Models\TampungDataBaru;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TampungDataBaruController extends BaseController
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

        // $queryResult = TampungDataBaru::where('nama','like','%'.$search.'%')->where('data_baru_id', '<>', '0')->orWhereNull('data_baru_id')->whereNull('data_baru_id');
        $queryResult = TampungDataBaru::where('nama','like','%'.$search.'%')->whereNull('data_baru_id');

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
            return view('dataBaru');
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
        //
        $this->validate($request, [
            'pendukung' => 'required',
        ]);


        $tampungDataBaru = new TampungDataBaru();
        foreach ($request->input() as $key => $value) {
            if ($key === "id") $tampungDataBaru->id = strtoupper($value);
            if ($key === "nkk") $tampungDataBaru->nkk = strtoupper($value);
            if ($key === "nik") $tampungDataBaru->nik = strtoupper($value);
            if ($key === "nama") $tampungDataBaru->nama = strtoupper($value);
            if ($key === "tempat_l") $tampungDataBaru->tempat_l = strtoupper($value);
            if ($key === "tanggal_l") $tampungDataBaru->tanggal_l = strtoupper($value);
            if ($key === "status") $tampungDataBaru->status = strtoupper($value);
            if ($key === "jenkel") $tampungDataBaru->jenkel = strtoupper($value);
            if ($key === "jln_dukuh") $tampungDataBaru->jln_dukuh = strtoupper($value);
            if ($key === "rt") $tampungDataBaru->rt = strtoupper($value);
            if ($key === "rw") $tampungDataBaru->rw = strtoupper($value);
            if ($key === "disabilitas") $tampungDataBaru->disabilitas = strtoupper($value);
        }
        $tampungDataBaru->save();

        $pendukung = [];
        foreach ($request->file('pendukung') as $file) {
            $fileName = $file->getClientOriginalName();
            if (file_exists(public_path('uploads') . '/' . $fileName)) {
                $fnamearray = explode('.', $fileName);
                $fileName = implode('.', array_slice($fnamearray, 0, count($fnamearray) - 1)) . '-' . Carbon::now()->timestamp . '.' . $file->extension();
            }
            $file->move(public_path('uploads'), $fileName);
            $baruPendukung = new BaruPendukung();
            $baruPendukung->tampung_data_baru_id = $tampungDataBaru->id;
            $baruPendukung->url = '/uploads/'.$fileName;
            $baruPendukung->save();
            array_push($pendukung, $baruPendukung);
        }
        return view('konfirmasiDataBaru', ['data' => $tampungDataBaru, 'pendukung' => $pendukung]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TampungDataBaru  $tampungDataBaru
     * @return \Illuminate\Http\Response
     */
    public function show(TampungDataBaru $tampungDataBaru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TampungDataBaru  $tampungDataBaru
     * @return \Illuminate\Http\Response
     */
    public function edit(TampungDataBaru $tampungDataBaru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TampungDataBaru  $tampungDataBaru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TampungDataBaru $tampungDataBaru)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TampungDataBaru  $tampungDataBaru
     * @return \Illuminate\Http\Response
     */
    public function destroy(TampungDataBaru $tampungDataBaru)
    {
        //
    }
}
