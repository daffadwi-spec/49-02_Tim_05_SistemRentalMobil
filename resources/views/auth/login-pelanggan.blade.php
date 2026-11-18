@extends('layouts.app')
@section('title', isset($akun) ? 'Edit Akun Pelanggan' : 'Login / Identitas Pelanggan')

@section('content')
<div class="card mx-auto" style="max-width: 480px;">
    <div class="card-header">
        {{ isset($akun) ? 'Edit Akun / Identitas Pelanggan' : 'Masuk / Identitas Pelanggan' }}
    </div>
    <div class="card-body">
        <form action="{{ url('/simpan-akun') }}" method="POST">
            @csrf
            <input type="hidden" name="id_akun" value="{{ $akun->id ?? '' }}">

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" class="form-control"
                       value="{{ old('nama', $akun->nama ?? '') }}"
                       placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="mb-3">
                <label for="nik" class="form-label">NIK (16 Digit)</label>
                <input type="text" id="nik" name="nik" class="form-control"
                       value="{{ old('nik', $akun->nik ?? '') }}"
                       maxlength="16" pattern="[0-9]{16}"
                       placeholder="Masukkan 16 digit NIK" required>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea id="alamat" name="alamat" class="form-control" rows="3"
                          placeholder="Masukkan alamat lengkap" required>{{ old('alamat', $akun->alamat ?? '') }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    {{ isset($akun) ? 'Simpan Perubahan' : 'Masuk' }}
                </button>
                <a href="{{ url('/') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection