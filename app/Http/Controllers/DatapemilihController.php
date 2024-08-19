<?php

namespace App\Http\Controllers;

use App\Models\DataBaru;
use App\Models\DataPemilih;
use Illuminate\Http\Request;

class DatapemilihController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->has('nik') && ($request->has('nama'))) {
            $res = DataPemilih::where('nik', $request->nik)->where('nama', 'like', '%' . strtoupper($request->nama) . '%')->get();
        }

        if ($request->wantsJson()) {
            if ($res) {
                return $this->sendResponse(
                    $res,
                    ['message' => 'Data pemilih listed.']
                );
            } else {
                return $this->sendError('Current user doen\'t have active keranjang.');
            }
        } else {
            // return view('cart', ['data' => $retarr]);
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
    public function store(Request $request, DataBaru $dataBaru)
    {
        //
        $datapemilih = new DataPemilih();
        $datapemilih->nkk = $dataBaru->nkk;
        $datapemilih->nik = $dataBaru->nik;
        $datapemilih->nama = $dataBaru->nama;
        $datapemilih->tempat_l = $dataBaru->tempat_l;
        $datapemilih->tanggal_l = $dataBaru->tanggal_l;
        $datapemilih->status = $dataBaru->status;
        $datapemilih->jenkel = $dataBaru->jenkel;
        $datapemilih->jln_dukuh = $dataBaru->jln_dukuh;
        $datapemilih->rt = $dataBaru->rt;
        $datapemilih->rw = $dataBaru->rw;
        $datapemilih->disabilitas = $dataBaru->disabilitas;
        $datapemilih->tps = $dataBaru->tps;
        $datapemilih->save();

        if ($datapemilih) {
            return $this->sendResponse(
                $datapemilih,
                ['message' => 'Data pemilih listed.']
            );
        } else {
            return $this->sendError('Current user doen\'t have active keranjang.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\datapemilih  $datapemilih
     * @return \Illuminate\Http\Response
     */
    public function show(datapemilih $datapemilih)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\datapemilih  $datapemilih
     * @return \Illuminate\Http\Response
     */
    public function edit(datapemilih $datapemilih)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\datapemilih  $datapemilih
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, datapemilih $datapemilih, DataBaru $dataBaru)
    {
        //
        $datapemilih->nkk = $dataBaru->nkk;
        $datapemilih->nik = $dataBaru->nik;
        $datapemilih->nama = $dataBaru->nama;
        $datapemilih->tempat_l = $dataBaru->tempat_l;
        $datapemilih->tanggal_l = $dataBaru->tanggal_l;
        $datapemilih->status = $dataBaru->status;
        $datapemilih->jenkel = $dataBaru->jenkel;
        $datapemilih->jln_dukuh = $dataBaru->jln_dukuh;
        $datapemilih->rt = $dataBaru->rt;
        $datapemilih->rw = $dataBaru->rw;
        $datapemilih->disabilitas = $dataBaru->disabilitas;
        $datapemilih->tps = $dataBaru->tps;
        $datapemilih->save();

        if ($datapemilih) {
            return $this->sendResponse(
                $datapemilih,
                ['message' => 'Data pemilih listed.']
            );
        } else {
            return $this->sendError('Current user doen\'t have active keranjang.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\datapemilih  $datapemilih
     * @return \Illuminate\Http\Response
     */
    public function destroy(datapemilih $datapemilih)
    {
        //
    }

    public function cekdata(Request $request)
    {
        $retval = false;
        $datap = DataPemilih::where('NIK', $request->input('input-nik'))->whereNull('data_ubah_id')->first();

        if (!$datap) {
            $retval = false;
        } else if (similar_text(strtoupper($request->input('input-nama')), strtoupper($datap->nama), $percent)) {
            if ($percent > 70) {
                $retval = true;
            } else {
                $retval = false;
            }
        }

        if ($retval) {
            return view('cekData', ['data' => $datap,'nik'=>$request->input('input-nik'), 'nama'=>strtoupper($request->input('input-nama'))]);
        } else {
            return redirect(route('wellcome'))->with('errorNik','NIK Tidak Ditemukan');
        }
    }
}
