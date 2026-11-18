@extends('layouts.app')
@section('title', 'Pengelolaan Driver')

@section('content')
@php $isOwner = auth()->check() && in_array(auth()->user()->role, ['owner', 'admin']); @endphp

<div class="mb-4">
    <h4 class="fw-bold mb-1">Driver / Pengemudi</h4>
    <p class="text-muted mb-0">Kelola informasi dan status pengemudi.</p>
</div>

@if($isOwner)
<div class="card mb-4">
    <div class="card-header">
        {{ isset($editDriver) && $editDriver ? 'Edit Data Driver' : 'Tambah Data Driver' }}
    </div>
    <div class="card-body">
        <form action="{{ isset($editDriver) && $editDriver ? route('drivers.update', $editDriver->id) : route('drivers.store') }}" method="POST">
            @csrf
            @if(isset($editDriver) && $editDriver)
                @method('PUT')
            @endif

            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label for="nama" class="form-label">Nama Driver</label>
                    <input type="text" class="form-control" id="nama" name="nama"
                           value="{{ old('nama', $editDriver->nama ?? '') }}"
                           placeholder="Masukkan nama driver" required>
                </div>
                <div class="col-12 col-md-6">
                    <label for="umur" class="form-label">Umur</label>
                    <input type="number" class="form-control" id="umur" name="umur" min="18"
                           value="{{ old('umur', $editDriver->umur ?? '') }}"
                           placeholder="Masukkan umur" required>
                </div>
                <div class="col-12 col-md-6">
                    <label for="pengalaman_pengemudi" class="form-label">Pengalaman Mengemudi (tahun)</label>
                    <input type="number" class="form-control" id="pengalaman_pengemudi" name="pengalaman_pengemudi" min="0"
                           value="{{ old('pengalaman_pengemudi', $editDriver->pengalaman_pengemudi ?? '') }}"
                           placeholder="Lama pengalaman mengemudi" required>
                </div>
                <div class="col-12 col-md-6">
                    <label for="nomor_sim_aktif" class="form-label">Nomor SIM Aktif</label>
                    <input type="text" class="form-control" id="nomor_sim_aktif" name="nomor_sim_aktif"
                           value="{{ old('nomor_sim_aktif', $editDriver->nomor_sim_aktif ?? '') }}"
                           placeholder="Masukkan nomor SIM" required>
                </div>
                <div class="col-12 col-md-6">
                    <label for="kontak" class="form-label">Kontak</label>
                    <input type="text" class="form-control" id="kontak" name="kontak"
                           value="{{ old('kontak', $editDriver->kontak ?? '') }}"
                           placeholder="Nomor telepon atau kontak" required>
                </div>
                <div class="col-12 col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="">Pilih status</option>
                        <option value="Aktif" {{ old('status', $editDriver->status ?? '') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Tidak Aktif" {{ old('status', $editDriver->status ?? '') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-success">
                    {{ isset($editDriver) && $editDriver ? 'Simpan Perubahan' : 'Tambah Driver' }}
                </button>
                @if(isset($editDriver) && $editDriver)
                    <a href="{{ route('drivers.index') }}" class="btn btn-secondary">Batal</a>
                @endif
            </div>
        </form>
    </div>
</div>
@endif

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Daftar Driver</span>
        <span class="badge text-bg-light border">{{ $drivers->count() }} data</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Pengalaman</th>
                    <th>Nomor SIM</th>
                    <th>Kontak</th>
                    <th>Status</th>
                    @if($isOwner)<th class="text-end">Aksi</th>@endif
                </tr>
            </thead>
            <tbody>
                @forelse($drivers as $driver)
                <tr>
                    <td class="text-secondary">{{ $loop->iteration }}</td>
                    <td class="fw-semibold">{{ $driver->nama }}</td>
                    <td>{{ $driver->umur }} th</td>
                    <td>{{ $driver->pengalaman_pengemudi }} tahun</td>
                    <td>{{ $driver->nomor_sim_aktif }}</td>
                    <td>{{ $driver->kontak }}</td>
                    <td>
                        @if($driver->status === 'Aktif')
                            <span class="badge rounded-pill text-bg-success">Aktif</span>
                        @else
                            <span class="badge rounded-pill text-bg-secondary">Tidak Aktif</span>
                        @endif
                    </td>
                    @if($isOwner)
                    <td class="text-end">
                        <a href="{{ route('drivers.edit', $driver->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('drivers.destroy', $driver->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data driver ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="{{ $isOwner ? 8 : 7 }}" class="text-center text-muted py-4">
                        Belum ada data driver.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection