@extends('layouts.app')
@section('title', 'Kontak')

@section('content')
<div class="card mx-auto" style="max-width: 550px;">
    <div class="card-header">Kontak</div>
    <div class="card-body">
        <p>Hubungi kontak yang tertera: <strong>{{ $telepon_kontak }}</strong></p>
        <p class="text-muted mb-4">Pastikan Anda menggunakan kontak yang tersedia untuk menghindari penipuan.</p>
        <a href="{{ url('/') }}" class="btn btn-secondary btn-sm">&larr; Kembali ke Menu Utama</a>
    </div>
</div>
@endsection