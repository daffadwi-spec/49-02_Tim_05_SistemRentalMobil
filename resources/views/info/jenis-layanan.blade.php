@extends('layouts.app')
@section('title', 'Jenis Layanan')

@section('content')
<div class="card mx-auto" style="max-width: 550px;">
    <div class="card-header">Jenis Layanan</div>
    <div class="card-body">
        <ol class="mb-4">
            @foreach($daftar_layanan as $layanan)
                <li class="mb-2">{{ $layanan }}</li>
            @endforeach
        </ol>
        <a href="{{ url('/') }}" class="btn btn-secondary btn-sm">&larr; Kembali ke Menu Utama</a>
    </div>
</div>
@endsection