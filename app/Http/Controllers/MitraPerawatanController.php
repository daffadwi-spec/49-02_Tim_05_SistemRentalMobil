<?php

namespace App\Http\Controllers;

use App\Models\MitraPerawatan;
use Illuminate\Http\Request;

class MitraPerawatanController extends Controller
{
    public function index()
    {
        $mitras = MitraPerawatan::all();
        return view('info.mitra-perawatan', compact('mitras'));
    }

    // Bisa diakses oleh Admin & Pelanggan
    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
        ]);

        MitraPerawatan::create([
            'nama_layanan' => $request->nama_layanan,
        ]);

        return redirect()->back()->with('success', 'Layanan mitra perawatan berhasil ditambahkan!');
    }

    // Hanya bisa diakses oleh Admin
    public function update(Request $request, $id)
    {
        if (strtolower(auth()->user()->role) !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengedit layanan.');
        }

        $request->validate([
            'nama_layanan' => 'required|string|max:255',
        ]);

        $mitra = MitraPerawatan::findOrFail($id);
        $mitra->update([
            'nama_layanan' => $request->nama_layanan,
        ]);

        return redirect()->back()->with('success', 'Layanan mitra perawatan berhasil diperbarui!');
    }

    // Hanya bisa diakses oleh Admin
    public function destroy($id)
    {
        if (strtolower(auth()->user()->role) !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menghapus layanan.');
        }

        $mitra = MitraPerawatan::findOrFail($id);
        $mitra->delete();

        return redirect()->back()->with('success', 'Layanan mitra perawatan berhasil dihapus!');
    }
}