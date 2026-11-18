@extends('layouts.app')
@section('title', 'Login Owner')

@section('content')
<div class="card mx-auto" style="max-width: 480px;">
    <div class="card-header">
        Login Owner / Admin
    </div>
    <div class="card-body">
        <form action="{{ route('login.proses') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control"
                       value="{{ old('email') }}"
                       placeholder="Masukkan email owner" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control"
                       placeholder="Masukkan password" required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    Masuk
                </button>
                <a href="{{ url('/') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection