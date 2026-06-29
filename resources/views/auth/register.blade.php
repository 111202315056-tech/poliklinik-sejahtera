<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Pasien - Poliklinik Sejahtera</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'Plus Jakarta Sans',sans-serif;background:linear-gradient(135deg,#1d4ed8,#1e3a5f);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px;}
.card{background:white;border-radius:20px;overflow:hidden;width:100%;max-width:480px;box-shadow:0 20px 60px rgba(0,0,0,0.3);}
.card-header{background:linear-gradient(135deg,#1d4ed8,#1e3a5f);padding:32px;text-align:center;}
.card-header img{width:60px;height:60px;margin-bottom:12px;}
.card-header h1{color:white;font-size:22px;font-weight:700;margin-bottom:4px;}
.card-header p{color:#93c5fd;font-size:13px;}
.card-body{padding:32px;}
.form-group{margin-bottom:16px;}
label{display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:6px;}
input{width:100%;padding:12px 16px;border:1.5px solid #e5e7eb;border-radius:10px;font-size:14px;font-family:inherit;outline:none;transition:border 0.2s;}
input:focus{border-color:#1d4ed8;}
.input-icon{position:relative;}
.input-icon i{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#9ca3af;font-size:14px;}
.input-icon input{padding-left:40px;}
.btn{width:100%;padding:14px;background:linear-gradient(135deg,#1d4ed8,#1e3a5f);color:white;border:none;border-radius:10px;font-size:15px;font-weight:700;cursor:pointer;font-family:inherit;margin-top:8px;transition:opacity 0.2s;}
.btn:hover{opacity:0.9;}
.error{background:#fee2e2;border:1px solid #fca5a5;color:#dc2626;padding:12px;border-radius:8px;font-size:13px;margin-bottom:16px;}
.login-link{text-align:center;margin-top:20px;font-size:13px;color:#6b7280;}
.login-link a{color:#1d4ed8;font-weight:600;text-decoration:none;}
.divider{display:flex;align-items:center;gap:12px;margin:20px 0;}
.divider hr{flex:1;border:none;border-top:1px solid #e5e7eb;}
.divider span{color:#9ca3af;font-size:12px;}
</style>
</head>
<body>
<div class="card">
<div class="card-header">
<div style="width:64px;height:64px;background:rgba(255,255,255,0.2);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
<i class="fa fa-hospital" style="font-size:28px;color:white;"></i>
</div>
<h1>Poliklinik Sejahtera</h1>
<p>Daftar sebagai pasien baru</p>
</div>
<div class="card-body">
@if($errors->any())
<div class="error"><i class="fa fa-circle-exclamation" style="margin-right:6px;"></i>{{ $errors->first() }}</div>
@endif
@if(session('error'))
<div class="error"><i class="fa fa-circle-exclamation" style="margin-right:6px;"></i>{{ session('error') }}</div>
@endif
<form action="/register" method="POST">
@csrf
<div class="form-group">
<label>Nama Lengkap</label>
<div class="input-icon"><i class="fa fa-user"></i><input type="text" name="nama" placeholder="Nama lengkap Anda" value="{{ old('nama') }}" required></div>
</div>
<div class="form-group">
<label>Email</label>
<div class="input-icon"><i class="fa fa-envelope"></i><input type="email" name="email" placeholder="email@gmail.com" value="{{ old('email') }}" required></div>
</div>
<div class="form-group">
<label>Password</label>
<div class="input-icon"><i class="fa fa-lock"></i><input type="password" name="password" placeholder="Minimal 6 karakter" required></div>
</div>
<div class="form-group">
<label>No KTP</label>
<div class="input-icon"><i class="fa fa-id-card"></i><input type="text" name="no_ktp" placeholder="No KTP (16 digit)" value="{{ old('no_ktp') }}"></div>
</div>
<div class="form-group">
<label>No HP</label>
<div class="input-icon"><i class="fa fa-phone"></i><input type="text" name="no_hp" placeholder="No HP aktif" value="{{ old('no_hp') }}"></div>
</div>
<div class="form-group">
<label>Alamat</label>
<div class="input-icon"><i class="fa fa-map-marker-alt"></i><input type="text" name="alamat" placeholder="Alamat lengkap" value="{{ old('alamat') }}"></div>
</div>
<button type="submit" class="btn"><i class="fa fa-user-plus" style="margin-right:8px;"></i>Daftar Sekarang</button>
</form>
<div class="login-link">
Sudah punya akun? <a href="/login">Masuk di sini</a>
</div>
</div>
</div>
</body>
</html>