<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Poliklinik Sejahtera</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Plus Jakarta Sans',sans-serif; background:#f0f4ff; min-height:100vh; display:flex; align-items:center; justify-content:center; padding:24px; }
        .card { background:white; border-radius:16px; box-shadow:0 4px 24px rgba(37,99,235,0.10); padding:36px 32px; width:100%; max-width:480px; }
        .logo { display:flex; align-items:center; gap:10px; margin-bottom:24px; }
        .logo-icon { width:40px; height:40px; background:#2563eb; border-radius:10px; display:flex; align-items:center; justify-content:center; color:white; font-weight:700; font-size:18px; }
        .logo-text { font-size:15px; font-weight:700; color:#1e293b; }
        h1 { font-size:20px; font-weight:700; color:#1e293b; margin-bottom:4px; }
        p.sub { font-size:13px; color:#64748b; margin-bottom:24px; }
        .alert-success { background:#dcfce7; border:1px solid #86efac; color:#166534; padding:12px 14px; border-radius:8px; font-size:13px; margin-bottom:16px; }
        .alert-error { background:#fee2e2; border:1px solid #fca5a5; color:#991b1b; padding:12px 14px; border-radius:8px; font-size:13px; margin-bottom:16px; }
        .form-group { margin-bottom:14px; }
        label { font-size:12px; font-weight:600; color:#374151; display:block; margin-bottom:5px; }
        input { width:100%; padding:10px 14px; border:1.5px solid #e2e8f0; border-radius:8px; font-size:14px; font-family:inherit; outline:none; transition:border .2s; }
        input:focus { border-color:#2563eb; }
        .row { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
        .btn { width:100%; padding:12px; background:#2563eb; color:white; border:none; border-radius:8px; font-size:14px; font-weight:600; cursor:pointer; margin-top:8px; }
        .btn:hover { background:#1d4ed8; }
        .login-link { text-align:center; margin-top:16px; font-size:13px; color:#64748b; }
        .login-link a { color:#2563eb; font-weight:600; text-decoration:none; }
    </style>
</head>
<body>
<div class="card">
    <div class="logo">
        <div class="logo-icon">P</div>
        <div class="logo-text">Poliklinik Sejahtera</div>
    </div>
    <h1>Daftar Akun Pasien</h1>
    <p class="sub">Isi data diri untuk membuat akun baru</p>
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert-error">
            @foreach($errors->all() as $e)<p>{{ $e }}</p>@endforeach
        </div>
    @endif
    <form method="POST" action="/register">
        @csrf
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" required>
        </div>
        <div class="row">
            <div class="form-group">
                <label>No. KTP</label>
                <input type="text" name="no_ktp" value="{{ old('no_ktp') }}" placeholder="16 digit NIK" required>
            </div>
            <div class="form-group">
                <label>No. HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx" required>
            </div>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan alamat lengkap" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="contoh@email.com" required>
        </div>
        <div class="row">
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Min. 6 karakter" required>
            </div>
            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="Ulangi password" required>
            </div>
        </div>
        <button type="submit" class="btn">Daftar Sekarang</button>
    </form>
    <div class="login-link">Sudah punya akun? <a href="/login">Login di sini</a></div>
</div>
</body>
</html>
