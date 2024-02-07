<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengarang;

class PengarangController extends Controller
{

    public function index()
    {
        $data_pengarang = Pengarang::all();

        return view('pengarang.index', compact('data_pengarang'));
    }

    public function tambah()
    {
        return view('pengarang.create');
    }


    public function proses_tambah(Request $request)
    {
        
        // Aturan Validasi
        $rule_validasi = [
            'nama'            => 'required|min:3',
            'demografi'       => 'required|min:3',
        ];

        // Custom Message
        $pesan_validasi = [
            'nama.required'             => 'Nama Harus di Isi !',
            'nama.min'                  => 'Nama Minimal 3 Karakter !',

            'demografi.required'        => 'Pengarang Harus di Isi !',
            'demografi.min'             => 'Pengarang Minimal 3 Karakter !',
        ];

        // Lakukan Validasi
        $request->validate($rule_validasi, $pesan_validasi);
        // Mapping All Request
        $data_to_save                    = new pengarang();
        $data_to_save->nama              = $request->nama;
        $data_to_save->demografi         = $request->demografi;
        
        // Save to DB
        $data_to_save->save();

        // Kembali dengan Flash Session Data
        return back()->with('status', 'Data Telah Disimpan !');
    }

    public function detail($id)
    {
        $detail_pengarang = Pengarang::findOrFail($id);

        return view('pengarang.detail', compact('detail_pengarang'));
    }

    public function hapus($id)
    {
        $detail_pengarang = Pengarang::findOrFail($id);

        if ($detail_pengarang->manga()->exists()) {
            return back()->with('status', 'Tidak dapat hapus data ber-relasi !');
        }

        $detail_pengarang->delete();

        return back()->with('status', 'Data Berhasil di Hapus !');
    }

    public function ubah($id)
    {
        $detail_pengarang = Pengarang::findOrFail($id);

        return view('pengarang.edit', compact('detail_pengarang'));
    }

    public function proses_ubah(Request $request, $id)
    {

        // Aturan Validasi
        $rule_validasi = [
            'nama'            => 'required|min:3',
            'demografi'       => 'required|min:3',
        ];

        // Custom Message
        $pesan_validasi = [
            'nama.required'        => 'Nama Harus di Isi !',
            'nama.min'             => 'Nama Minimal 3 Karakter !',

            'demografi.required'        => 'Demografi Harus di Isi !',
            'demografi.min'             => 'Demografi Minimal 3 Karakter !',
        ];

        // Lakukan Validasi
        $request->validate($rule_validasi, $pesan_validasi);

        // Mapping All Request
        $data_to_save                  = Pengarang::findOrFail($id);
        $data_to_save->nama            = $request->nama;
        $data_to_save->demografi       = $request->demografi;

        // Save to DB
        $data_to_save->save();

        // Kembali dengan Flash Session Data
        return back()->with('status', 'Data Telah Disimpan !');
    }

}
