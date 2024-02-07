<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Manga;
use App\Models\Pengarang;

class MangaController extends Controller
{
    public function index(Request $request)
    {

        // Variable Pencarian
        $cari_judul = $request->cari_judul;
        $cari_nama_pengarang = $request->cari_nama_pengarang;

        $tipe_sort = 'desc';
        $var_sort = 'created_at';

        // Prepare Model
        $data_manga = Manga::query();

        // Kondisi Pencarian
        if ($request->filled('cari_judul')) {
            $data_manga = $data_manga->where('nama_manga', 'LIKE', '%' . $cari_judul . '%');
        }

        if ($request->filled('cari_nama_pengarang')) {
            $data_manga = $data_manga->whereHas('pengarang', function (Builder $query) use ($cari_nama_pengarang) {
                $query->where('nama', 'LIKE', '%' . $cari_nama_pengarang . '%');
            });
        }

        // Kondisi Sorting
        if( $request->has('tipe_sort') || $request->has('var_sort') ) {
            $tipe_sort = $request->tipe_sort;
            $var_sort = $request->var_sort;

            $data_manga = $data_manga->orderBy($var_sort, $tipe_sort);
        }

        // Kondisi Paginate

        $set_pagination = $request->set_pagination;

        if ($request->filled('set_pagination')) {
            $data_manga = $data_manga
                        ->orderBy($var_sort, $tipe_sort)
                        ->paginate($set_pagination);
        } else {
            $data_manga = $data_manga
                        ->orderBy($var_sort, $tipe_sort)
                        ->paginate(5);
        }

        // Append Query String to Pagination
        $data_manga = $data_manga->withQueryString();


        // Return View dengan Data
        return view('manga.index', compact(
            'data_manga',
            'cari_judul',
            'cari_nama_pengarang',

            'tipe_sort',
            'var_sort',

            'set_pagination'
        ));


    }

    public function tambah()
    {
        $data_pengarang = Pengarang::all();

        return view('manga.create', compact('data_pengarang'));
    }


    public function proses_tambah(Request $request)
    {

        // Aturan Validasi
        $rule_validasi = [
            'nama_manga'         => 'required|min:3',
            'jumlah_manga'       => 'required|numeric',
            'pengarang_ke'       => 'required',
        ];

        // Custom Message
        $pesan_validasi = [
            'nama_manga.required'        => 'Nama Manga Harus di Isi !',
            'nama_manga.min'             => 'Nama Manga Minimal 3 Karakter !',

            'jumlah_manga.required'     => 'Jumlah Manga Harus di Isi',
            'jumlah_manga.numeric'      => 'Jumlah Manga Harus Berupa Angka',
            'pengarang_ke.required'     => 'Pengarang Harus di Isi'  ,
        ];

        // Lakukan Validasi
        $request->validate($rule_validasi, $pesan_validasi);

        // Mapping All Request
        $data_to_save                    = new Manga();
        $data_to_save->nama_manga        = $request->nama_manga;
        $data_to_save->jumlah_manga      = $request->jumlah_manga;
        $data_to_save->pengarang_id      = $request->pengarang_ke;

        // Save to DB
        $data_to_save->save();

        // Kembali dengan Flash Session Data
        return back()->with('status', 'Data Telah Disimpan !');
    }

    public function detail($id)
    {
        $detail_manga = Manga::findOrFail($id);

        return view('manga.detail', compact('detail_manga'));
    }

    public function hapus($id)
    {
        $detail_manga = Manga::findOrFail($id);

        $detail_manga->delete();

        return back()->with('status', 'Data Berhasil di Hapus !');
    }

    public function ubah($id)
    {
        $detail_manga = Manga::findOrFail($id);
        $data_pengarang = Pengarang::all();

        return view('manga.edit', compact('detail_manga', 'data_pengarang'));
    }

    public function proses_ubah(Request $request, $id)
    {

        // Aturan Validasi
        $rule_validasi = [
            'nama_manga'             => 'required|min:3',
            'jumlah_manga'             => 'required|numeric',
            'pengarang_ke'      => 'required',
        ];

        // Custom Message
        $pesan_validasi = [
            'nama_manga.required'        => 'Nama manga Harus di Isi !',
            'nama_manga.min'             => 'Nama manga Minimal 3 Karakter !',

            'jumlah_manga.required'     => 'Jumlah Manga Harus di Isi',
            'jumlah_manga.numeric'      => 'Jumlah manga Harus Berupa Angka',
            'pengarang_ke.required'  => 'Pengarang Harus di Isi',
        ];

        // Lakukan Validasi
        $request->validate($rule_validasi, $pesan_validasi);

        // Mapping All Request
        $data_to_save                         = Manga::findOrFail($id);
        $data_to_save->nama_manga             = $request->nama_manga;
        $data_to_save->jumlah_manga           = $request->jumlah_manga;
        $data_to_save->pengarang_id        = $request->pengarang_ke;

        // Save to DB
        $data_to_save->save();

        // Kembali dengan Flash Session Data
        return back()->with('status', 'Update Data Berhasil !');
    }

}
