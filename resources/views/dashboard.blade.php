@extends('layouts.app')
@section('title', 'Dashboard - Sistem Informasi Rental Mobil')

@section('content')
<!-- Kotak Header Sederhana -->
<div class="card mb-4" style="border-left: 4px solid #0d6efd;">
    <div class="card-body">
        <h4 class="fw-bold mb-1">Sistem Informasi Rental Mobil</h4>
        <p class="text-muted mb-0">
            Pengelolaan data armada kendaraan, paket sewa, pengemudi, serta informasi layanan rental mobil.
        </p>
    </div>
</div>

<!-- Kotak Modul Utama (3 Kolom) -->
<div class="fw-semibold text-secondary small text-uppercase mb-2">Menu Utama</div>
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-header">Data Armada</div>
            <div class="card-body d-flex flex-column">
                <p class="text-muted small mb-3">Daftar unit mobil beserta plat nomor, merk, tahun keluaran, dan jenis transmisi.</p>
                <a href="{{ route('armada.index') }}" class="btn btn-primary btn-sm mt-auto align-self-start">Buka Data Armada</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-header">Paket Rental</div>
            <div class="card-body d-flex flex-column">
                <p class="text-muted small mb-3">Daftar pilihan paket sewa (Lepas Kunci, All-in, Luar Kota), durasi, dan ketentuan.</p>
                <a href="{{ route('paket.index') }}" class="btn btn-primary btn-sm mt-auto align-self-start">Buka Paket Rental</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-header">Data Driver</div>
            <div class="card-body d-flex flex-column">
                <p class="text-muted small mb-3">Daftar pengemudi aktif beserta umur, pengalaman mengemudi, nomor SIM, dan kontak.</p>
                <a href="{{ route('drivers.index') }}" class="btn btn-primary btn-sm mt-auto align-self-start">Buka Data Driver</a>
            </div>
        </div>
    </div>
</div>

<!-- Kotak Informasi Layanan (4 Kolom) -->
<div class="fw-semibold text-secondary small text-uppercase mb-2">Informasi Layanan</div>
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <a href="{{ url('/jenis-layanan') }}" class="box-link p-3 h-100">
            <div class="fw-bold mb-1">Jenis Layanan</div>
            <div class="text-muted small">Kategori layanan rental yang tersedia</div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="{{ url('/mitra-perawatan') }}" class="box-link p-3 h-100">
            <div class="fw-bold mb-1">Mitra Perawatan</div>
            <div class="text-muted small">Info bengkel rekanan & servis gratis</div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="{{ url('/lokasi') }}" class="box-link p-3 h-100">
            <div class="fw-bold mb-1">Lokasi</div>
            <div class="text-muted small">Alamat dan tautan Google Maps</div>
        </a>
    </div>
    <div class="col-6 col-md-3">
        <a href="{{ url('/kontak') }}" class="box-link p-3 h-100">
            <div class="fw-bold mb-1">Kontak</div>
            <div class="text-muted small">Nomor telepon resmi layanan</div>
        </a>
    </div>
</div>

<!-- Tabel Pelanggan (Khusus Owner) -->
@if(auth()->check() && in_array(auth()->user()->role, ['owner', 'admin']))
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Data Akun / Identitas Pelanggan (Khusus Owner)</span>
        <a href="{{ url('/login?role=pelanggan') }}" class="btn btn-primary btn-sm">+ Tambah Akun</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Nama Lengkap</th>
                    <th>NIK</th>
                    <th>Alamat</th>
                    <th style="width: 140px;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data_akun ?? [] as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->nik }}</td>
                    <td>{{ $row->alamat }}</td>
                    <td class="text-center">
                        <a href="{{ url('/login?id='.$row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ url('/hapus/'.$row->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-3">Belum ada data pelanggan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection