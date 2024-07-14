<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use App\Models\KategoriSurat;
use Illuminate\Http\Request;

class ArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arsip = Arsip::with('kategori')->get();
        $kategori = KategoriSurat::all();
        return view('arsip.index', compact('arsip', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $arsip = Arsip::all();
        $kategori = KategoriSurat::all();
        return view('arsip.create', compact('arsip', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        date_default_timezone_set('Asia/Jakarta');

        $request->validate([
            'nomor_surat' => 'required',
            'kategori_id' => 'required',
            'judul' => 'required',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = storage_path('app/public/file_surat');
            $file->move($tujuan_upload, $nama_file);
        }

        $arsip = new Arsip();
        $arsip->nomor_surat = $request->nomor_surat;
        $arsip->kategori_id = $request->kategori_id;
        $arsip->judul = $request->judul;
        $arsip->waktu_pengarsipan = now();
        $arsip->file = $nama_file;
        $arsip->save();

        if ($arsip) {
            return redirect()->route('arsip.index')->with('success add', 'Data berhasil disimpan');
        } else {
            return redirect()->route('arsip.index')->with('error', 'Data gagal disimpan');
        }
    }

    public function show($id)
    {
        $arsip = Arsip::find($id);
        $kategori = KategoriSurat::all();
        return view('arsip.show', compact('arsip', 'kategori'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword'); // Ambil 'keyword' dari input form

        if (!$keyword) {
            return redirect()->route('arsip.index');
        }

        $arsip = Arsip::where('nomor_surat', 'like', '%' . $keyword . '%')
            ->orWhere('judul', 'like', '%' . $keyword . '%')
            ->orWhereHas('kategori', function ($query) use ($keyword) {
                $query->where('nama_kategori', 'like', '%' . $keyword . '%');
            })
            ->get();

        $kategori = KategoriSurat::all();

        return view('arsip.index', compact('arsip', 'kategori'));
    }

    public function download($id)
    {
        $arsip = Arsip::find($id);
        $path = storage_path('app/public/file_surat/' . $arsip->file);
        return response()->download($path, $arsip->file);
    }

    public function edit($id)
    {
        $arsip = Arsip::find($id);
        $kategori = KategoriSurat::all();
        return view('arsip.edit', compact('arsip', 'kategori'));
    }

    public function update($id)
    {
        date_default_timezone_set('Asia/Jakarta');

        $arsip = Arsip::find($id);
        if (!$arsip) {
            return redirect()->route('arsip.index')->with('error', 'Data tidak ditemukan');
        }

        $arsip->nomor_surat = request('nomor_surat');
        $arsip->kategori_id = request('kategori_id');
        $arsip->judul = request('judul');
        $arsip->waktu_pengarsipan = now();

        if (request()->hasFile('file')) {
            $file = request()->file('file');

            $nama_file = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = storage_path('app/public/file_surat');

            if ($file->isValid()) {
                // Menghapus file lama jika ada
                if ($arsip->file) {
                    $path_file_lama = $tujuan_upload . '/' . $arsip->file;
                    if (file_exists($path_file_lama)) {
                        unlink($path_file_lama);
                    }
                }

                // Memindahkan file baru ke direktori tujuan
                $file->move($tujuan_upload, $nama_file);

                $arsip->file = $nama_file;
            } else {
                return redirect()->route('arsip.index')->with('error', 'File tidak valid');
            }
        }

        $arsip->save();

        return redirect()->route('arsip.index')->with('success edit', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $arsip = Arsip::find($id);

        if (!$arsip) {
            return redirect()->route('arsip.index')->with('error', 'Data tidak ditemukan');
        }

        if ($arsip->file) {
            $tujuan_upload = storage_path('app/public/file_surat');
            $path_file = $tujuan_upload . '/' . $arsip->file;

            if (file_exists($path_file)) {
                try {
                    if (!unlink($path_file)) {
                        return redirect()->route('arsip.index')->with('error', 'Gagal menghapus file dari storage');
                    }
                } catch (\Exception $e) {
                    return redirect()->route('arsip.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
                }
            } else {
                return redirect()->route('arsip.index')->with('error', 'File tidak ditemukan di storage');
            }
        }

        $arsip->delete();
        return redirect()->route('arsip.index')->with('success delete', 'Data berhasil dihapus');
    }
}
