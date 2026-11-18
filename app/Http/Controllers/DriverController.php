<?php
namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::all();
        return view('driver.index', compact('drivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'umur' => 'required|integer|min:18',
            'pengalaman_pengemudi' => 'required|integer|min:0',
            'nomor_sim_aktif' => 'required',
            'kontak' => 'required',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);
        Driver::create($request->all());
        return redirect()->route('drivers.index')->with('success', 'Data driver berhasil ditambahkan.');
    }

    public function edit(Driver $driver)
    {
        $drivers = Driver::all();
        return view('driver.index', ['drivers' => $drivers, 'editDriver' => $driver]);
    }

    public function update(Request $request, Driver $driver)
    {
        $driver->update($request->all());
        return redirect()->route('drivers.index')->with('success', 'Data driver berhasil diperbarui.');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('drivers.index')->with('success', 'Data driver berhasil dihapus.');
    }
}