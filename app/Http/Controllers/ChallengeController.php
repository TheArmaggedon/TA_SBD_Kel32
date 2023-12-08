<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChallengeController extends Controller
{
    public function index(Request $request) {

        if ($request->has("search")) {
            $searchTerm = $request->input("search");
            $dataKaryawan =  DB::select("SELECT * from karyawan where terhapus = 0 AND (id_karyawan LIKE '%$searchTerm%' OR nama LIKE '%$searchTerm%' OR alamat LIKE '%$searchTerm%')");
            $dataKartuAkses = DB::select("SELECT * from kartu_akses where terhapus = 0 AND (
                no_kartu LIKE '%$searchTerm%' OR id_karyawan LIKE '%$searchTerm' OR hak_akses LIKE '%$searchTerm%' OR id_ruangan LIKE '%$searchTerm'
                )");
            $dataRuangan = DB::select("SELECT * from ruangan where terhapus = 0 AND (
                id_ruangan LIKE '%$searchTerm%' OR nama_ruangan LIKE '%$searchTerm%' OR level_akses LIKE '%$searchTerm%'
                )");
        
        } else {
            $dataKaryawan = DB::select('SELECT * from karyawan where terhapus = 0');
            $dataKartuAkses = DB::select('SELECT * from kartu_akses where terhapus = 0');
            $dataRuangan = DB::select('SELECT * from ruangan where terhapus = 0');
        }

        return view('challenge.index', [
            'dataKaryawan' => $dataKaryawan, 
            'dataKartuAkses' => $dataKartuAkses, 
            'dataRuangan' => $dataRuangan
        ]);
    }
}
