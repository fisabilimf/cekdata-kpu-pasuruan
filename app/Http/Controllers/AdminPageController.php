<?php

namespace App\Http\Controllers;

use App\Exports\DataBaruExport;
use App\Exports\DataTmsExport;
use App\Exports\DataUbahExport;
use App\Imports\DataPemilihImport;
use App\Imports\DataPemilihImportSheet;
use App\Models\DataPemilih;
use App\Models\DataTms;
use App\Models\DataUbah;
use App\Models\TampungDataBaru;
use App\Models\TampungDataTms;
use App\Models\TampungDataUbah;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;

class AdminPageController extends Controller
{
    //
    public function dataBaru()
    {
        return (view('admin.dataBaru'));
    }

    public function periksaDataBaru(TampungDataBaru $tampungDataBaru)
    {
        return (view('admin.periksaDataBaru', ['data' => $tampungDataBaru]));
    }

    public function hapusDataBaru(TampungDataBaru $tampungDataBaru)
    {
        $tampungDataBaru->data_baru_id = 0;
        $tampungDataBaru->save();
        return (view('admin.konfirmasiHapusDataBaru', ['data' => $tampungDataBaru]));
    }

    public function terimaDataBaru(TampungDataBaru $tampungDataBaru)
    {
        $dataPemilih = new DataPemilih();
        $dataPemilih->nkk = $tampungDataBaru->nkk;
        $dataPemilih->nik = $tampungDataBaru->nik;
        $dataPemilih->nama = $tampungDataBaru->nama;
        $dataPemilih->tempat_l = $tampungDataBaru->tempat_l;
        $dataPemilih->tanggal_l = $tampungDataBaru->tanggal_l;
        $dataPemilih->status = $tampungDataBaru->status;
        $dataPemilih->jenkel = $tampungDataBaru->jenkel;
        $dataPemilih->jln_dukuh = $tampungDataBaru->jln_dukuh;
        $dataPemilih->rt = $tampungDataBaru->rt;
        $dataPemilih->rw = $tampungDataBaru->rw;
        $dataPemilih->disabilitas = $tampungDataBaru->disabilitas;
        $dataPemilih->save();

        $tampungDataBaru->data_baru_id = $dataPemilih->id;
        $tampungDataBaru->save();
        return (view('admin.konfirmasiTerimaDataBaru', ['data' => $tampungDataBaru]));
    }

    public function dataUbah()
    {
        return (view('admin.dataUbah'));
    }

    public function periksaDataUbah(TampungDataUbah $tampungDataUbah)
    {
        return (view('admin.periksaDataUbah', ['data' => $tampungDataUbah]));
    }

    public function hapusDataUbah(TampungDataUbah $tampungDataUbah)
    {
        $tampungDataUbah->data_ubah_id = 0;
        $tampungDataUbah->save();
        return (view('admin.konfirmasiHapusDataUbah', ['data' => $tampungDataUbah]));
    }

    public function terimaDataUbah(TampungDataUbah $tampungDataUbah)
    {
        $dataPemilih = new DataPemilih();
        $dataPemilih->nkk = $tampungDataUbah->nkk;
        $dataPemilih->nik = $tampungDataUbah->nik;
        $dataPemilih->nama = $tampungDataUbah->nama;
        $dataPemilih->tempat_l = $tampungDataUbah->tempat_l;
        $dataPemilih->tanggal_l = $tampungDataUbah->tanggal_l;
        $dataPemilih->status = $tampungDataUbah->status;
        $dataPemilih->jenkel = $tampungDataUbah->jenkel;
        $dataPemilih->jln_dukuh = $tampungDataUbah->jln_dukuh;
        $dataPemilih->rt = $tampungDataUbah->rt;
        $dataPemilih->rw = $tampungDataUbah->rw;
        $dataPemilih->disabilitas = $tampungDataUbah->disabilitas;
        $dataPemilih->save();

        $dataUbah = new DataUbah();
        $dataUbah->data_pemilih_id = $dataPemilih->id;
        $dataUbah->save();

        $tampungDataUbah->data_pemilih->data_ubah_id = $dataUbah->id;
        $tampungDataUbah->data_pemilih->save();
        $tampungDataUbah->data_ubah_id = $dataPemilih->id;
        $tampungDataUbah->save();

        return (view('admin.konfirmasiTerimaDataUbah', ['data' => $tampungDataUbah]));
    }

    public function dataTms()
    {
        return (view('admin.dataTms'));
    }

    public function importData(Request $request)
    {
        // $import = new DataPemilihImportSheet();
        if ($request->file()) {
            $fileName = time() . '_' . $request->formFile->getClientOriginalName();
            $filePath = $request->file('formFile')->store('uploads');
            Excel::import(new DataPemilihImport, $filePath);

            return back()
                ->with('success', 'File has been uploaded.')
                ->with('file', $fileName);
        }
    }

    public function exportData(Request $request)
    {
        $timestamp = (new DateTime())->getTimestamp();
        Excel::store(new DataUbahExport, 'dataubah-'.$timestamp.'.xlsx', 'public');
        Excel::store(new DataTmsExport, 'datatms-'.$timestamp.'.xlsx', 'public');
        Excel::store(new DataBaruExport, 'databaru-'.$timestamp.'.xlsx', 'public');
        // return Excel::download(new DataUbahExport, 'dataubah.xlsx');

        $zip = new ZipArchive;
        $fileName = 'data_ekspor-'.$timestamp.'.zip';

        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
            $files = Storage::disk('public')->files();
            foreach ($files as $key => $value) {
                if (str_ends_with($value, $timestamp.'.xlsx')) {
                    $value = 'storage/'.$value;
                    $relativeNameInZipFile = basename($value);
                    $zip->addFile($value, $relativeNameInZipFile);
                }
            }
            $zip->close();
            return response()->download(public_path($fileName));
        }
        // return Storage::download($fileName);

    }

    public function hapusData()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('baru_pendukungs')->truncate();
        DB::table('tms_pendukungs')->truncate();
        DB::table('ubah_pendukungs')->truncate();
        DB::table('data_tms')->truncate();
        DB::table('data_ubahs')->truncate();
        DB::table('tampung_data_barus')->truncate();
        DB::table('tampung_data_tms')->truncate();
        DB::table('tampung_data_ubahs')->truncate();
        DB::table('data_pemilihs')->truncate();

        Schema::enableForeignKeyConstraints();

        return redirect()->route('home');
    }

    public function manajemenData()
    {
        return (view('admin.manajemen'));
    }


    public function periksaDataTms(TampungDataTms $tampungDataTms)
    {
        return (view('admin.periksaDataTms', ['data' => $tampungDataTms]));
    }

    public function hapusDataTms(TampungDataTms $tampungDataTms)
    {
        $tampungDataTms->data_tms_id = 0;
        $tampungDataTms->save();
        return (view('admin.konfirmasiHapusDataTms', ['data' => $tampungDataTms]));
    }

    public function terimaDataTms(TampungDataTms $tampungDataTms)
    {
        $dataTms = new DataTms();
        $dataTms->kode = $tampungDataTms->kode;
        $dataTms->save();

        $tampungDataTms->data_pemilih->data_tms_id = $dataTms->id;
        $tampungDataTms->data_pemilih->save();
        $tampungDataTms->data_tms_id = $dataTms->id;
        $tampungDataTms->save();
        return (view('admin.konfirmasiTerimaDataTms', ['data' => $tampungDataTms]));
    }
}
