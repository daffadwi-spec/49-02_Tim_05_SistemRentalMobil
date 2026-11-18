@extends('layouts.app')
@section('title', 'Data Armada')

@section('content')
@php $isOwner = auth()->check() && in_array(auth()->user()->role, ['owner', 'admin']); @endphp

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Data Armada Mobil</span>
        @if($isOwner)
            <a href="{{ route('armada.create') }}" class="btn btn-primary btn-sm">+ Tambah Armada</a>
        @endif
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Plat Nomor</th>
                    <th>Merk</th>
                    <th>Tahun</th>
                    <th>Transmisi</th>
                    @if($isOwner)<th class="text-end">Aksi</th>@endif
                </tr>
            </thead>
            <tbody>
                @forelse($rentals as $d)
                <tr>
                    <td class="fw-semibold">{{ $d->plat_nomor }}</td>
                    <td>{{ $d->merk }}</td>
                    <td>{{ $d->tahun }}</td>
                    <td>{{ $d->transmisi }}</td>
                    @if($isOwner)
                    <td class="text-end">
                        <a href="{{ route('armada.edit', $d) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('armada.destroy', $d) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                    @endif
                </tr>
                @empty
                <tr><td colspan="{{ $isOwner ? 5 : 4 }}" class="text-center text-muted py-4">Belum ada data armada.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection