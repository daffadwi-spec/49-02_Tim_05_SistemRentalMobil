@extends('layouts.app')
@section('title', 'Lokasi')

@section('content')
<div class="card mx-auto" style="max-width: 550px;">
    <div class="card-header">Lokasi</div>
    <div class="card-body">
        <p>Silahkan gunakan Google Maps yang sudah disediakan:</p>
        <p class="mb-4"><a href="{{ $urlMaps }}" target="_blank">{{ $urlMaps }}</a></p>
        <a href="{{ url('/') }}" class="btn btn-secondary btn-sm">&larr; Kembali ke Menu Utama</a>
    </div>
</div>
@endsection