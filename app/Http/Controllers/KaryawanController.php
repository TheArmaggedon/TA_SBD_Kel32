<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function create()
    {
        return view('karyawan.add');
    }
    public function index(){
        $datas = DB::select('SELECT * from karyawan where terhapus = 0');
        return view('karyawan.index', [
            'datas'=> $datas
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'id_karyawan'=>'required',
            'nama'=>'required',
            'alamat' => 'required'
        ]);

        DB::insert('INSERT INTO karyawan(id_karyawan, nama, alamat) VALUES(:id_karyawan, :nama, :alamat)',[
            'id_karyawan' => $request->id_karyawan,
            'nama' => $request->nama,
            'alamat' => $request ->alamat,
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil dimasukkan');


    }

    public function edit($id) {
        $data=DB::table('karyawan')->where('id_karyawan', $id)->first();
        return view('karyawan.edit')->with('data', $data);
    }

    public function update($id, Request $request) {
        $request->validate([
            'id_karyawan'=>'required',
            'nama'=>'required',
            'alamat' => 'required'
        ]);
        DB::update('UPDATE karyawan SET id_karyawan = :id_karyawan, nama = :nama, alamat = :alamat where id_karyawan = :id',[
            'id' => $id,
            'id_karyawan' => $request-> id_karyawan,
            'nama' => $request->nama,
            'alamat' => $request ->alamat,
            
        ]);

        return redirect()->route('karyawan.index')->with('success','data karyawan berhasil diubah');
    }

    public function softDelete($id){
        DB::update('UPDATE karyawan SET terhapus = TRUE WHERE id_karyawan = :id_karyawan', ['id_karyawan' => $id]);
        return redirect()->route('karyawan.index')->with('success','Data karyawan dipindahkan ke recycle bin');
    }

    public function hardDelete($id) {
        DB::delete('DELETE FROM karyawan WHERE id_karyawan = :id_karyawan ',['id_karyawan' => $id]);
        return redirect()->route('karyawan.index')->with('success','Data berhasil dihapus secara permanen');

    }
    public function restore($id) {
        DB::update('UPDATE karyawan SET terhapus = FALSE WHERE id_karyawan = :id_karyawan',['id_karyawan' => $id]);
        return redirect()->route('recyclebin.index')->with('success', 'data karyawan berhasil di-restore');
    }



}
