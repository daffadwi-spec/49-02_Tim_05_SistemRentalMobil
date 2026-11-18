@extends('layouts.app')
@php $isEdit = isset($rental); @endphp
@section('title', ($isEdit ? 'Edit' : 'Tambah') . ' Data Armada')

@section('content')
<div class="card mx-auto" style="max-width: 600px;">
    <div class="card-header">{{ $isEdit ? 'Edit Data Armada' : 'Tambah Data Armada Baru' }}</div>
    <div class="card-body">
        <form method="POST" action="{{ $isEdit ? route('armada.update', $rental) : route('armada.store') }}">
            @csrf
            @if($isEdit) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label">Plat Nomor</label>
                <input type="text" name="plat_nomor" class="form-control" value="{{ old('plat_nomor', $rental->plat_nomor ?? '') }}" {{ $isEdit ? 'readonly' : 'required' }}>
            </div>
            <div class="mb-3">
                <label class="form-label">Merk</label>
                <input type="text" name="merk" class="form-control" value="{{ old('merk', $rental->merk ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tahun</label>
                <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $rental->tahun ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Transmisi</label>
                <select name="transmisi" class="form-select" required>
                    @foreach(['Manual', 'Matic'] as $t)
                        <option value="{{ $t }}" {{ old('transmisi', $rental->transmisi ?? '') == $t ? 'selected' : '' }}>{{ $t }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Simpan Perubahan' : 'Simpan' }}</button>
                <a href="{{ route('armada.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection