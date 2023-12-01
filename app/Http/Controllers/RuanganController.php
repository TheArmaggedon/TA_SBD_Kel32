<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RuanganController extends Controller
{
    // Display a listing of the resource.
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $datas = DB::select("SELECT * from ruangan where terhapus = 0 AND (
                id_ruangan LIKE '%$searchTerm%' OR nama_ruangan LIKE '%$searchTerm' OR level_akses LIKE '%$searchTerm%'
                )");
        }

        else {
            $datas = DB::select("SELECT * from ruangan where terhapus is not null");
        }
        return view("ruangan.index")->with("datas", $datas);
    }

    public function create()
    {
        return view('ruangan.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_ruangan' => 'required',
            'nama_ruangan' => 'required',
            'level_akses' => 'required'
        ]);

        DB::insert(
            'INSERT INTO ruangan(id_ruangan, nama_ruangan, level_akses) VALUES (:id_ruangan, :nama_ruangan, :level_akses)',
            [
                'id_ruangan' => $request->id_ruangan,
                'nama_ruangan' => $request->nama_ruangan,
                'level_akses' => $request->level_akses,
            ]
        );

        return redirect()->route('ruangan.index')->with('success', 'Data Ruangan berhasil disimpan');
    }

    public function edit($id)
    {
        $ruangan = DB::table('ruangan')->where('id_ruangan', $id)->first();
        return view('ruangan.edit', ['ruangan' => $ruangan]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ruangan' => 'required',
            'level_akses' => 'required'
        ]);

        DB::update(
            'UPDATE ruangan SET nama_ruangan = :nama_ruangan, level_akses = :level_akses WHERE id_ruangan = :id_ruangan',
            [
                'id_ruangan' => $id,
                'nama_ruangan' => $request->nama_ruangan,
                'level_akses' => $request->level_akses,
            ]
        );

        return redirect()->route('ruangan.index')->with('success', 'Data Ruangan berhasil diperbarui');
    }

    public function softDelete($id){
        DB::update('UPDATE ruangan SET terhapus = TRUE WHERE id_ruangan = :id_ruangan', ['id_ruangan' => $id]);
        return redirect()->route('ruangan.index')->with('success','Data ruangan dipindahkan ke recycle bin');
    }

    public function hardDelete($id) {
        DB::delete('DELETE FROM ruangan WHERE id_ruangan = :id_ruangan ',['id_ruangan' => $id]);
        return redirect()->route('ruangan.index')->with('success','Data ruangan dihapus secara permanen');

    }
    public function restore($id) {
        DB::update('UPDATE ruangan SET terhapus = FALSE WHERE id_ruangan = :id_ruangan',['id_ruangan' => $id]);
        return redirect()->route('recyclebin.index')->with('sucess', 'data ruangan berhasil di-restore');
    }
}
