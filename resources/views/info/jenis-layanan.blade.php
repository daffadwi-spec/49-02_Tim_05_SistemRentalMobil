@extends('layouts.app')
@section('title', 'Jenis Layanan')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-7">

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

            <div class="card mx-auto shadow-sm" style="max-width: 550px;">
                {{-- Header Card + Tombol Tambah (Tampil untuk Admin & Pelanggan) --}}
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Jenis Layanan</span>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        + Tambah Layanan
                    </button>
                </div>

                <div class="card-body">
                    <table class="table table-hover align-middle mb-4">
                        <tbody>
                            @forelse($layanans as $index => $item)
                                <tr>
                                    <td style="width: 40px;">{{ $index + 1 }}.</td>
                                    <td>{{ $item->nama_layanan }}</td>

                                    {{-- Tombol Edit & Hapus HANYA untuk Admin --}}
                                    @if(strtolower(auth()->user()->role) === 'admin')
                                        <td class="text-end" style="width: 140px;">
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id }}">
                                                Edit
                                            </button>

                                            <form action="{{ route('jenis-layanan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
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
                                                <form action="{{ route('jenis-layanan.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Jenis Layanan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Layanan</label>
                                                            <input type="text" name="nama_layanan" class="form-control" value="{{ $item->nama_layanan }}" required>
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
                                        Belum ada data jenis layanan.
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
            <form action="{{ route('jenis-layanan.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jenis Layanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Layanan yang Diinginkan</label>
                        <input type="text" name="nama_layanan" class="form-control" placeholder="Contoh: Antar Jemput Bandara" required>
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