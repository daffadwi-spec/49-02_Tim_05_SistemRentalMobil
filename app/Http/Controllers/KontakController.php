<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $kontaks = Kontak::all();
        return view('info.kontak', compact('kontaks'));
    }

    // Bisa diakses oleh Admin & Pelanggan
    public function store(Request $request)
    {
        $request->validate([
            'nama_kontak' => 'required|string|max:255',
            'nomor_kontak' => 'required|string|max:50',
        ]);

        Kontak::create([
            'nama_kontak' => $request->nama_kontak,
            'nomor_kontak' => $request->nomor_kontak,
        ]);

        return redirect()->back()->with('success', 'Data kontak berhasil ditambahkan!');
    }

    // Hanya bisa diakses oleh Admin
    public function update(Request $request, $id)
    {
        if (strtolower(auth()->user()->role) !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengedit kontak.');
        }

        $request->validate([
            'nama_kontak' => 'required|string|max:255',
            'nomor_kontak' => 'required|string|max:50',
        ]);

        $kontak = Kontak::findOrFail($id);
        $kontak->update([
            'nama_kontak' => $request->nama_kontak,
            'nomor_kontak' => $request->nomor_kontak,
        ]);

        return redirect()->back()->with('success', 'Data kontak berhasil diperbarui!');
    }

    // Hanya bisa diakses oleh Admin
    public function destroy($id)
    {
        if (strtolower(auth()->user()->role) !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menghapus kontak.');
        }

        $kontak = Kontak::findOrFail($id);
        $kontak->delete();

        return redirect()->back()->with('success', 'Data kontak berhasil dihapus!');
    }
}