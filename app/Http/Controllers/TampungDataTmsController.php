<?php

namespace App\Http\Controllers;

use App\Models\DataPemilih;
use App\Models\TampungDataTms;
use App\Models\TmsPendukung;
use Carbon\Carbon;
use Illuminate\Http\Request;
use stdClass;

class TampungDataTmsController extends BaseController
{
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

        $queryResult = TampungDataTms::with(['data_pemilih' => function ($q) use ($search) {
            $q->where('nama', 'like', '%' . $search . '%');
        }]);

        $queryResult = $queryResult->whereNull('data_tms_id');

        if ($sort && $order) {
            $queryResult = $queryResult->orderBy($sort, strtoupper($order));
        }

        $queryResultCount = $queryResult->get()->count();
        if ($limit > 0) {
            $queryResult = $queryResult->offset($from)->limit($limit)->get();
        } else {
            $queryResult = $queryResult->get();
        }

        //['id','nkk','nik','nama','tempat_l','tanggal_l','status','jenkel','jln_dukuh','rt','rw','disabilitas']
        //['id','nkk','nik','nama','tempat_l','tanggal_l','status','jenkel','jln_dukuh','rt','rw','disabilitas']

        $retArr = [];
        foreach ($queryResult as $key => $value) {
            $retObj = new stdClass;
            $retObj->id = $value->id;
            $retObj->nkk = $value->data_pemilih->nkk;
            $retObj->nik = $value->data_pemilih->nik;
            $retObj->nama = $value->data_pemilih->nama;
            $retObj->tempat_l = $value->data_pemilih->tempat_l;
            $retObj->tanggal_l = $value->data_pemilih->tanggal_l;
            $retObj->status = $value->data_pemilih->status;
            $retObj->jenkel = $value->data_pemilih->jenkel;
            $retObj->jln_dukuh = $value->data_pemilih->jln_dukuh;
            $retObj->rt = $value->data_pemilih->rt;
            $retObj->rw = $value->data_pemilih->rw;
            $retObj->disabilitas = $value->data_pemilih->disabilitas;

            array_push($retArr, $retObj);
        }

        if ($request->wantsJson()) {
            return $this->sendResponse($retArr, [
                'total' => $queryResultCount,
                'from' => $from,
                'limit' => $limit,
            ]);
        } else {
            return view('dataTms');
        }
    }

    //
    public function show(DataPemilih $dataPemilih, $nik = null, $nama = null)
    {
        return view('dataTms', ['data' => $dataPemilih, 'nik' => $nik, 'nama' => $nama]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'pendukung' => 'required',
            'pendukung.*' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $tampungDataTms = new TampungDataTms();
        foreach ($request->input() as $key => $value) {
            if ($key === "dataTms") $tampungDataTms->kode = $value;
            if ($key === "data_pemilih_id") $tampungDataTms->data_pemilih_id = $value;
        }
        $tampungDataTms->save();

        $pendukung = [];
        foreach ($request->file('pendukung') as $file) {
            $fileName = $file->getClientOriginalName();
            if (file_exists(public_path('uploads') . '/' . $fileName)) {
                $fnamearray = explode('.', $fileName);
                $fileName = implode('.', array_slice($fnamearray, 0, count($fnamearray) - 1)) . '-' . Carbon::now()->timestamp . '.' . $file->extension();
            }
            $file->move(public_path('uploads'), $fileName);
            $tmsPendukung = new TmsPendukung();
            $tmsPendukung->tampung_data_tms_id = $tampungDataTms->id;
            $tmsPendukung->url = '/uploads/' . $fileName;
            $tmsPendukung->save();
            array_push($pendukung, $tmsPendukung);
        }

        return view('konfirmasiDataTms', ['data' => $tampungDataTms, 'pendukung' => $pendukung]);
    }
}
