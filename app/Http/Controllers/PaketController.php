<?php
namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::all();
        return view('paket.index', compact('pakets'));
    }

    public function create()
    {
        return view('paket.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required',
            'jenis' => 'required|in:Lepas Kunci,All-in,Luar Kota',
            'durasi' => 'required|integer|min:1',
            'ketentuan' => 'required',
        ]);
        Paket::create($request->all());
        return redirect()->route('paket.index')->with('success', 'Paket rental berhasil ditambahkan.');
    }

    public function edit(Paket $paket)
    {
        return view('paket.form', compact('paket'));
    }

    public function update(Request $request, Paket $paket)
    {
        $paket->update($request->all());
        return redirect()->route('paket.index')->with('success', 'Paket rental berhasil diubah.');
    }

    public function destroy(Paket $paket)
    {
        $paket->delete();
        return redirect()->route('paket.index')->with('success', 'Paket rental berhasil dihapus.');
    }
}