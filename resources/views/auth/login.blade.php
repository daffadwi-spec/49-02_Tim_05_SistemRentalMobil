<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>

        @if ($errors->any())
            <div class="alert-error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login.proses') }}">
            @csrf
            <div class="form-group">
                <label>Email:</label>
                <input type="text" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Masuk</button>
        </form>
    </div>
</body>
</html>