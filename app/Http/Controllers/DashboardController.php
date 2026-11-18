<?php

namespace App\Http\Controllers;

use App\Models\AkunRental;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $data_akun = AkunRental::all();
        return view('dashboard', compact('data_akun'));
    }

    public function simpanAkun(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'nik' => 'required|digits:16',
            'alamat' => 'required|string',
        ]);

        $akun = AkunRental::updateOrCreate(
            ['id' => $request->id_akun],
            [
                'nama' => $request->nama,
                'nik' => $request->nik,
                'alamat' => $request->alamat,
                'role' => 'pelanggan',
            ]
        );

        // Otomatis login jika diisi oleh pelanggan (bukan owner yang sedang mengedit data)
        if (!Auth::check()) {
            $user = User::firstOrNew(['email' => $request->nik . '@pelanggan.local']);
            $user->name = $request->nama;
            $user->password = Hash::make($request->nik);
            $user->role = 'pelanggan';
            $user->save();

            Auth::login($user);
        }

        return redirect('/')->with('success', 'Selamat datang, ' . $akun->nama . '! Data akun berhasil disimpan.');
    }

    public function hapusAkun($id)
    {
        AkunRental::destroy($id);
        return redirect('/')->with('success', 'Data akun berhasil dihapus.');
    }

    public function jenisLayanan()
    {
        $daftar_layanan = [
            'Sewa Mobil Lepas Kunci',
            'Sewa Mobil + Driver (All-in)',
            'Paket Perjalanan Luar Kota',
        ];
        return view('info.jenis-layanan', compact('daftar_layanan'));
    }

    public function mitraPerawatan()
    {
        $telepon_mitra = '089663132784';
        return view('info.mitra-perawatan', compact('telepon_mitra'));
    }

    public function lokasi()
    {
        $urlMaps = 'https://maps.google.com/?q=Telkom+University+Bandung';
        return view('info.lokasi', compact('urlMaps'));
    }

    public function kontak()
    {
        $telepon_kontak = '0812-3456-7890';
        return view('info.kontak', compact('telepon_kontak'));
    }
}