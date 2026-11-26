<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasis = Lokasi::all();
        return view('info.lokasi', compact('lokasis'));
    }

    // Bisa diakses oleh Admin & Pelanggan
    public function store(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'link_maps' => 'required|string|max:255',
        ]);

        Lokasi::create([
            'nama_lokasi' => $request->nama_lokasi,
            'link_maps' => $request->link_maps,
        ]);

        return redirect()->back()->with('success', 'Data lokasi berhasil ditambahkan!');
    }

    // Hanya bisa diakses oleh Admin
    public function update(Request $request, $id)
    {
        if (strtolower(auth()->user()->role) !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengedit lokasi.');
        }

        $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'link_maps' => 'required|string|max:255',
        ]);

        $lokasi = Lokasi::findOrFail($id);
        $lokasi->update([
            'nama_lokasi' => $request->nama_lokasi,
            'link_maps' => $request->link_maps,
        ]);

        return redirect()->back()->with('success', 'Data lokasi berhasil diperbarui!');
    }

    // Hanya bisa diakses oleh Admin
    public function destroy($id)
    {
        if (strtolower(auth()->user()->role) !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menghapus lokasi.');
        }

        $lokasi = Lokasi::findOrFail($id);
        $lokasi->delete();

        return redirect()->back()->with('success', 'Data lokasi berhasil dihapus!');
    }
}