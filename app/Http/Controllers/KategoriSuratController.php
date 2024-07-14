<?php

namespace App\Http\Controllers;

use App\Models\KategoriSurat;
use Illuminate\Http\Request;

class KategoriSuratController extends Controller
{
    public function index()
    {
        $kategori = KategoriSurat::all();
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        $kategori = KategoriSurat::all();
        return view('kategori.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'keterangan' => 'required',
        ]);

        $kategori = new KategoriSurat();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->keterangan = $request->keterangan;
        $kategori->save();

        if ($kategori) {
            return redirect()->route('kategori.index')->with('success add', 'Data berhasil disimpan');
        } else {
            return redirect()->route('kategori.index')->with('error', 'Data gagal disimpan');
        }

    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $kategori = KategoriSurat::where('nama_kategori', 'like', "%" . $keyword . "%")
            ->orWhere('keterangan', 'like', "%" . $keyword . "%")
            ->get();
        return view('kategori.index', compact('kategori'));
    }

    public function edit($id)
    {
        $kategori = KategoriSurat::find($id);
        return view('kategori.update', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'keterangan' => 'required',
        ]);

        $kategori = KategoriSurat::find($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->keterangan = $request->keterangan;
        $kategori->save();

        if ($kategori) {
            return redirect()->route('kategori.index')->with('success edit', 'Data berhasil diupdate');
        } else {
            return redirect()->route('kategori.index')->with('error', 'Data gagal diupdate');
        }
    }

    public function destroy($id)
    {
        $kategori = KategoriSurat::find($id);
        if (!$kategori) {
            return redirect()->route('kategori.index')->with('error', 'Data tidak ditemukan');
        }

        $kategori->delete();

        return redirect()->route('kategori.index')->with('success delete', 'Data berhasil dihapus');
    }
}
