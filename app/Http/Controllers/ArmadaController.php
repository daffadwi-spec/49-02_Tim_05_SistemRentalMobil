<?php
namespace App\Http\Controllers;

use App\Models\Armada;
use Illuminate\Http\Request;

class ArmadaController extends Controller
{
    public function index()
    {
        $rentals = Armada::all();
        return view('armada.index', compact('rentals'));
    }

    public function create()
    {
        return view('armada.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'plat_nomor' => 'required|unique:tabel_armada,plat_nomor',
            'merk' => 'required',
            'tahun' => 'required|integer',
            'transmisi' => 'required|in:Manual,Matic',
        ]);
        Armada::create($request->all());
        return redirect()->route('armada.index')->with('success', 'Data armada berhasil ditambahkan.');
    }

    public function edit(Armada $armada)
    {
        return view('armada.form', ['rental' => $armada]);
    }

    public function update(Request $request, Armada $armada)
    {
        $armada->update($request->only(['merk', 'tahun', 'transmisi']));
        return redirect()->route('armada.index')->with('success', 'Data armada berhasil diperbarui.');
    }

    public function destroy(Armada $armada)
    {
        $armada->delete();
        return redirect()->route('armada.index')->with('success', 'Data armada berhasil dihapus.');
    }
}