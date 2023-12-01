<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecyclebinController extends Controller
{
    public function index(Request $request) {

        if ($request->has("search")) {
            $searchTerm = $request->input("search");
            $dataKaryawan =  DB::select("SELECT * from karyawan where terhapus = 1 AND (id_karyawan LIKE '%$searchTerm%' OR nama LIKE '%$searchTerm%' OR alamat LIKE '%$searchTerm%')");
            $dataKartuAkses = DB::select("SELECT * from kartu_akses where terhapus = 1 AND (
                no_kartu LIKE '%$searchTerm%' OR id_karyawan LIKE '%$searchTerm' OR hak_akses LIKE '%$searchTerm%' OR id_ruangan LIKE '%$searchTerm'
                )");
            $dataRuangan = DB::select("SELECT * from ruangan where terhapus = 1 AND (
                id_ruangan LIKE '%$searchTerm%' OR nama_ruangan LIKE '%$searchTerm' OR level_akses LIKE '%$searchTerm%'
                )");
        
        } else {
            $dataKaryawan = DB::select('SELECT * from karyawan where terhapus = 1');
            $dataKartuAkses = DB::select('SELECT * from kartu_akses where terhapus = 1');
            $dataRuangan = DB::select('SELECT * from ruangan where terhapus = 1');
        }

        return view('recyclebin.index', [
            'dataKaryawan' => $dataKaryawan, 
            'dataKartuAkses' => $dataKartuAkses, 
            'dataRuangan' => $dataRuangan
        ]);
    }

   

}
