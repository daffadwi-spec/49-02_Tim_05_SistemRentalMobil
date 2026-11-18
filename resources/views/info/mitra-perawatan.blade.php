@extends('layouts.app')
@section('title', 'Langganan Mitra Perawatan')

@section('content')
<div class="card mx-auto" style="max-width: 550px;">
    <div class="card-header">Langganan Mitra Perawatan</div>
    <div class="card-body">
        <p>Hubungi kontak yang tertera: <strong>{{ $telepon_mitra ?? '089663132784' }}</strong></p>
        <p>Pelanggan bisa mendapatkan service gratis ke bengkel yang telah ditetapkan seperti:</p>
        <ol class="mb-4">
            <li>Ganti oli</li>
            <li>Service rutin</li>
            <li>Ganti ban dan Spooring</li>
        </ol>
        <a href="{{ url('/') }}" class="btn btn-secondary btn-sm">&larr; Kembali ke Menu Utama</a>
    </div>
</div>
@endsection