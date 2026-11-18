@extends('layouts.app')
@php $isEdit = isset($paket); @endphp
@section('title', ($isEdit ? 'Ubah' : 'Tambah') . ' Paket Rental')

@section('content')
<div class="card mx-auto" style="max-width: 600px;">
    <div class="card-header">{{ $isEdit ? 'Ubah Paket Rental' : 'Tambah Paket Baru' }}</div>
    <div class="card-body">
        <form action="{{ $isEdit ? route('paket.update', $paket->id) : route('paket.store') }}" method="POST">
            @csrf
            @if($isEdit) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label">Nama Paket</label>
                <input type="text" name="nama_paket" class="form-control" value="{{ old('nama_paket', $paket->nama_paket ?? '') }}" placeholder="Contoh: Paket 3 Hari" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Paket</label>
                <select name="jenis" class="form-select" required>
                    <option value="">- Pilih jenis -</option>
                    @foreach(['Lepas Kunci', 'All-in', 'Luar Kota'] as $j)
                        <option value="{{ $j }}" {{ old('jenis', $paket->jenis ?? '') == $j ? 'selected' : '' }}>{{ $j }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Durasi (Hari)</label>
                <input type="number" name="durasi" class="form-control" min="1" value="{{ old('durasi', $paket->durasi ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Ketentuan</label>
                <textarea name="ketentuan" class="form-control" rows="3" required>{{ old('ketentuan', $paket->ketentuan ?? '') }}</textarea>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Update' : 'Simpan' }}</button>
                <a href="{{ route('paket.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection