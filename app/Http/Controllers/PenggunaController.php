<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = DB::select('SELECT * FROM pengguna');
        return view('pengguna.index', ['pengguna' => $pengguna]);
    }

    public function create()
    {
        return view('pengguna.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'pass' => 'required',
            'username' => 'required'
        ]);

        DB::insert(
            'INSERT INTO pengguna(id_user, pass, username) VALUES (:id_user, :pass, :username)',
            [
                'id_user' => $request->id_user,
                'pass' => $request->pass,
                'username' => $request->username,
            ]
        );

        return redirect()->route('pengguna.index')->with('success', 'Data Pengguna berhasil disimpan');
    }


    public function edit($id)
    {
        $pengguna = DB::table('pengguna')->where('id_user', $id)->first();
        return view('pengguna.edit')->with('pengguna', $pengguna);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pass' => 'required',
            'username' => 'required'
        ]);

        DB::update(
            'UPDATE pengguna SET pass = :pass, username = :username WHERE id_user = :id_user',
            [
                'id_user' => $id,
                'pass' => $request->pass,
                'username' => $request->username,
            ]
        );

        return redirect()->route('pengguna.index')->with('success', 'Data Pengguna berhasil diperbarui');
    }
    public function softDelete($id){
        DB::update('UPDATE pengguna SET terhapus = TRUE WHERE id_user = :id_user', ['id_user' => $id]);
        return redirect()->route('pengguna.index')->with('success','Data pengguna dipindahkan ke recycle bin');
    }

    public function hardDelete($id) {
        DB::delete('DELETE FROM pengguna WHERE id_user = :id_user ',['id_user' => $id]);
        return redirect()->route('pengguna.index')->with('success','Data berhasil dihapus secara permanen');

    }
    public function restore($id) {
        DB::update('UPDATE pengguna SET terhapus = FALSE WHERE id_user = :id_user',['id_user' => $id]);
        return redirect()->route('recyclebin.index')->with('sucess', 'data berhasil di-restore');
    }

    public function login(Request $request) {
      $request->validate([
        'pass' => 'required',
        'username' => 'required'
      ]);
      
      $result = null;
    }
}
