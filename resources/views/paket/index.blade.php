@extends('layouts.app')
@section('title', 'Daftar Paket Rental')

@section('content')
@php $isOwner = auth()->check() && in_array(auth()->user()->role, ['owner', 'admin']); @endphp

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Modul Paket Rental</span>
        @if($isOwner)
            <a href="{{ route('paket.create') }}" class="btn btn-primary btn-sm">+ Tambah Paket</a>
        @endif
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Paket</th>
                    <th>Jenis</th>
                    <th>Durasi</th>
                    <th>Ketentuan</th>
                    @if($isOwner)<th class="text-end">Aksi</th>@endif
                </tr>
            </thead>
            <tbody>
                @forelse($pakets as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="fw-semibold">{{ $row->nama_paket }}</td>
                    <td><span class="badge text-bg-info">{{ $row->jenis }}</span></td>
                    <td>{{ $row->durasi }} hari</td>
                    <td>{{ $row->ketentuan }}</td>
                    @if($isOwner)
                    <td class="text-end">
                        <a href="{{ route('paket.edit', $row->id) }}" class="btn btn-sm btn-outline-primary">Ubah</a>
                        <form action="{{ route('paket.destroy', $row->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                    @endif
                </tr>
                @empty
                <tr><td colspan="{{ $isOwner ? 6 : 5 }}" class="text-center text-muted py-4">Belum ada paket rental.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection