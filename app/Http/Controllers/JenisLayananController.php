<?php

namespace App\Http\Controllers;

use App\Models\JenisLayanan;
use Illuminate\Http\Request;

class JenisLayananController extends Controller
{
    public function index()
    {
        $layanans = JenisLayanan::all();
        return view('info.jenis-layanan', compact('layanans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
        ]);

        JenisLayanan::create([
            'nama_layanan' => $request->nama_layanan,
        ]);

        return redirect()->back()->with('success', 'Jenis layanan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        if (strtolower(auth()->user()->role) !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengedit layanan.');
        }

        $request->validate([
            'nama_layanan' => 'required|string|max:255',
        ]);

        $layanan = JenisLayanan::findOrFail($id);
        $layanan->update([
            'nama_layanan' => $request->nama_layanan,
        ]);

        return redirect()->back()->with('success', 'Jenis layanan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        if (strtolower(auth()->user()->role) !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menghapus layanan.');
        }

        $layanan = JenisLayanan::findOrFail($id);
        $layanan->delete();

        return redirect()->back()->with('success', 'Jenis layanan berhasil dihapus!');
    }
}