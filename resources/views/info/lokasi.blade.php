@extends('layouts.app')
@section('title', 'Lokasi')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- Notifikasi Sukses --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Notifikasi Error Validasi --}}
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card mx-auto shadow-sm" style="max-width: 650px;">
                {{-- Header Card + Tombol Tambah (Tampil untuk Admin & Pelanggan) --}}
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Lokasi</span>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        + Tambah Lokasi
                    </button>
                </div>

                <div class="card-body">
                    <p>Silahkan gunakan Google Maps yang sudah disediakan:</p>

                    <table class="table table-hover align-middle mb-4">
                        <tbody>
                            @forelse($lokasis as $index => $item)
                                <tr>
                                    <td style="width: 40px;">{{ $index + 1 }}.</td>
                                    <td>
                                        <div class="fw-semibold">{{ $item->nama_lokasi }}</div>
                                        <a href="{{ $item->link_maps }}" target="_blank" class="small text-break">
                                            {{ $item->link_maps }}
                                        </a>
                                    </td>

                                    {{-- Tombol Edit & Hapus HANYA untuk Admin --}}
                                    @if(strtolower(auth()->user()->role) === 'admin')
                                        <td class="text-end" style="width: 140px;">
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">
                                                Edit
                                            </button>

                                            <form action="{{ route('lokasi.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus lokasi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>

                                {{-- Modal Edit HANYA untuk Admin --}}
                                @if(strtolower(auth()->user()->role) === 'admin')
                                    <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('lokasi.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Lokasi</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Lokasi</label>
                                                            <input type="text" name="nama_lokasi" class="form-control" value="{{ $item->nama_lokasi }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Link Google Maps</label>
                                                            <input type="text" name="link_maps" class="form-control" value="{{ $item->link_maps }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="{{ strtolower(auth()->user()->role) === 'admin' ? 3 : 2 }}" class="text-center text-muted py-3">
                                        Belum ada data lokasi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <a href="{{ url('/') }}" class="btn btn-secondary btn-sm">&larr; Kembali ke Menu Utama</a>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Modal Tambah Data (Untuk Admin & Pelanggan) --}}
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('lokasi.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Lokasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lokasi</label>
                        <input type="text" name="nama_lokasi" class="form-control" placeholder="Contoh: Telkom University Bandung" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Link Google Maps</label>
                        <input type="text" name="link_maps" class="form-control" placeholder="Contoh: https://maps.google.com/?q=Telkom+University+Bandung" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection