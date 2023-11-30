<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecyclebinController extends Controller
{
    public function index() {
        $dataKaryawan = DB::select('SELECT * from karyawan where terhapus is TRUE');
        $dataKartuAkses = DB::select('SELECT * from kartu_akses where terhapus is TRUE');
        $dataRuangan = DB::select('SELECT * from ruangan where terhapus is TRUE');
        return view('recyclebin.index', [
            'dataKaryawan' => $dataKaryawan, 
            'dataKartuAkses' => $dataKartuAkses, 
            'dataRuangan' => $dataRuangan
        ]);
    }

}
