<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KartuAksesController extends Controller
{
    public function create()
    {
        return view('kartu_akses.add');
    }
    public function index(Request $request){

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $datas = DB::select("SELECT * from kartu_akses where terhapus = 0 AND (
                no_kartu LIKE '%$searchTerm%' OR id_karyawan LIKE '%$searchTerm%' OR hak_akses LIKE '%$searchTerm%' OR id_ruangan LIKE '%$searchTerm'
                )");
            $datajoineds = DB::select("SELECT * from kartu_akses kak INNER JOIN karyawan k ON kak.id_karyawan = k.id_karyawan INNER JOIN ruangan r ON r.id_ruangan = kak.id_ruangan WHERE k.nama_karyawan LIKE 
             '%$searchTerm%' OR r.nama_ruangan LIKE '%$searchTerm%");
        }

        else {
            $datas = DB::select("SELECT * from kartu_akses where terhapus = 0");
            $datajoineds = DB::select("SELECT * from kartu_akses kak INNER JOIN karyawan k ON kak.id_karyawan = k.id_karyawan INNER JOIN ruangan r ON r.id_ruangan = kak.id_ruangan");
        }

        
        return view('kartu_akses.index', [
            'datas' => $datas,
            'datajoineds' =>$datajoineds
        ] );
    }

    public function store(Request $request) {
        $request->validate([
            'no_kartu' => 'required',
            'id_karyawan'=>'nullable',
            'hak_akses'=>'required',
            'id_ruangan' => 'nullable'
        ]);

        DB::insert('INSERT INTO kartu_akses(no_kartu, id_karyawan, hak_akses, id_ruangan) VALUES(:no_kartu, :id_karyawan, :hak_akses, :id_ruangan)',[
            'no_kartu' => $request->no_kartu,
            'id_karyawan' => $request->id_karyawan,
            'hak_akses' => $request ->hak_akses,
            'id_ruangan' => $request -> id_ruangan
        ]);

        return redirect()->route('kartu_akses.index')->with('success', 'Data kartu akses berhasil dimasukkan');


    }

    public function edit($id) {
        $data=DB::table('kartu_akses')->where('no_kartu', $id)->first();
        return view('kartu_akses.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'no_kartu'=>'required',
            'id_karyawan'=>'nullable',
            'hak_akses' => 'required',
            'id_ruangan' => 'nullable'
        ]);
        DB::update('UPDATE kartu_akses SET no_kartu = :no_kartu, id_karyawan = :id_karyawan, hak_akses = :hak_akses, id_ruangan = :id_ruangan',[
            'no_kartu' => $id,
            'id_karyawan' => $request->id_karyawan,
            'hak_akses' => $request ->hak_akses,
            'id_ruangan' => $request -> id_ruangan
        ]);

        return redirect()->route('karyawan.index')->with('success','Data kartu akses berhasil diubah');
    }

    public function softDelete($id){
        DB::update('UPDATE kartu_akses SET terhapus = TRUE WHERE no_kartu = :no_kartu', ['no_kartu' => $id]);
        return redirect()->route('kartu_akses.index')->with('success','Data kartu akses dipindahkan ke recycle bin');
    }

    public function hardDelete($id) {
        DB::delete('DELETE FROM kartu_akses WHERE no_kartu = :no_kartu ',['no_kartu' => $id]);
        return redirect()->route('recyclebin.index')->with('success','Data kartu akses berhasil dihapus secara permanen');

    }
    public function restore($id) {
        DB::update('UPDATE kartu_akses SET terhapus = FALSE WHERE no_kartu = :no_kartu',['no_kartu' => $id]);
        return redirect()->route('recyclebin.index')->with('sucess', 'data kartu akses berhasil di-restore');
    }

    
}
