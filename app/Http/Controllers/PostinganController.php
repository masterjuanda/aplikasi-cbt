<?php

namespace App\Http\Controllers;

use App\Models\Postingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostinganController extends Controller
{
    public function index()
    {
        $daftarPostingan = Postingan::all();
        return view('postingan.index', compact('daftarPostingan'));
    }

    public function create()
    {
        return view('postingan.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi'   => 'required',
        ]);

        Postingan::create([
            'id_pengguna' => auth()->id(),
            'judul'       => $request->judul,
            'isi'         => $request->isi,
        ]);

        return redirect()->route('postingan.index')->with('pesan', 'Postingan berhasil ditambahkan!');
    }

    public function edit(Postingan $postingan)
    {
        // Cek izin lewat Policy
        Gate::authorize('ubah', $postingan);
        return view('postingan.ubah', compact('postingan'));
    }

    public function update(Request $request, Postingan $postingan)
    {
        Gate::authorize('ubah', $postingan);

        $postingan->update($request->validate([
            'judul' => 'required',
            'isi'   => 'required',
        ]));

        return redirect()->route('postingan.index')->with('pesan', 'Postingan berhasil diubah!');
    }

    public function destroy(Postingan $postingan)
    {
        Gate::authorize('hapus', $postingan);
        $postingan->delete();

        return redirect()->route('postingan.index')->with('pesan', 'Postingan berhasil dihapus!');
    }
}
