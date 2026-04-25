<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? "Aldi" }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(["resources/css/app.css", "resources/js/app.js"])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: "Plus Jakarta Sans", sans-serif; background: #f3f4f6; }
        .sidebar { width: 224px; background: #1e3a5f; color: white; display: flex; flex-direction: column; min-height: 100vh; position: fixed; top: 0; left: 0; z-index: 40; }
        .sidebar-logo { display: flex; align-items: center; gap: 12px; padding: 20px; border-bottom: 1px solid #2d5a8e; }
        .sidebar-logo-icon { background: #2563eb; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .sidebar-logo-text { font-weight: 700; font-size: 14px; line-height: 1.4; color: white; }
        .sidebar-user { display: flex; align-items: center; gap: 12px; padding: 16px 20px; border-bottom: 1px solid #2d5a8e; }
        .sidebar-avatar { background: #2563eb; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; color: white; flex-shrink: 0; }
        .sidebar-name { font-size: 14px; font-weight: 600; color: white; }
        .sidebar-role { font-size: 11px; color: #93c5fd; text-transform: capitalize; }
        .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }
        .sidebar-section { font-size: 11px; font-weight: 700; text-transform: uppercase; color: #93c5fd; padding: 0 12px; margin-bottom: 8px; margin-top: 8px; letter-spacing: 0.05em; }
        .sidebar-link { display: flex; align-items: center; gap: 10px; padding: 9px 12px; border-radius: 8px; margin-bottom: 3px; font-size: 13px; font-weight: 500; color: white !important; text-decoration: none !important; transition: background 0.2s; }
        .sidebar-link:hover { background: #1d4ed8; }
        .sidebar-link.active { background: #2563eb; }
        .sidebar-link i { width: 18px; text-align: center; font-size: 14px; }
        .sidebar-footer { padding: 12px; border-top: 1px solid #2d5a8e; }
        .logout-btn { display: flex; align-items: center; gap: 10px; padding: 9px 12px; border-radius: 8px; font-size: 13px; font-weight: 500; color: white; background: none; border: none; cursor: pointer; width: 100%; text-align: left; transition: background 0.2s; }
        .logout-btn:hover { background: #dc2626; }
        .logout-btn i { width: 18px; text-align: center; }
        .main-wrap { margin-left: 224px; width: calc(100% - 224px); display: flex; flex-direction: column; min-height: 100vh; }
        .top-header { background: #1d4ed8; color: white; padding: 12px 24px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 2px 4px rgba(0,0,0,0.15); }
        .top-header-brand { display: flex; align-items: center; gap: 8px; font-weight: 600; font-size: 14px; }
        .top-header-user { font-size: 14px; font-weight: 500; }
        .main-content { flex: 1; padding: 24px; }
        .main-footer { background: #1d4ed8; color: #bfdbfe; text-align: center; padding: 12px; font-size: 12px; }
        .alert-success { background: #dcfce7; border: 1px solid #86efac; color: #166534; padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; font-size: 14px; }
    </style>
</head>
<body>
<div style="display:flex;">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="sidebar-logo-icon">
                <img src="/logo.png" style="width:36px;height:36px;object-fit:contain;border-radius:50%;">
            </div>
            <span class="sidebar-logo-text">Poliklinik<br>Sejahtera</span>
        </div>

        <div class="sidebar-user">
            <div class="sidebar-avatar">
                {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
            </div>
            <div>
                <div class="sidebar-name">{{ Auth::user()->nama }}</div>
                <div class="sidebar-role">{{ Auth::user()->role }}</div>
            </div>
        </div>

        <nav class="sidebar-nav">

            @if(Auth::user()->role === "admin")
            <div class="sidebar-section">Kelola Data</div>
            <a href="/" class="sidebar-link {{ request()->is('/') ? 'active' : '' }}">
                <i class="fa fa-gauge"></i> Dashboard
            </a>
            <a href="/poli" class="sidebar-link {{ request()->is('poli*') ? 'active' : '' }}">
                <i class="fa fa-hospital"></i> Poliklinik
            </a>
            <a href="/dokter" class="sidebar-link {{ request()->is('dokter*') ? 'active' : '' }}">
                <i class="fa fa-user-doctor"></i> Dokter
            </a>
            <a href="/pasien" class="sidebar-link {{ request()->is('pasien*') ? 'active' : '' }}">
                <i class="fa fa-users"></i> Pasien
            </a>
            <a href="/obat" class="sidebar-link {{ request()->is('obat*') ? 'active' : '' }}">
                <i class="fa fa-pills"></i> Obat
            </a>
              <a href="/admin/pemeriksaan" class="sidebar-link {{ request()->is('admin/pemeriksaan*') ? 'active' : '' }}">
                  <i class="fa fa-file-medical"></i> Pemeriksaan
              </a>
            @endif

            @if(Auth::user()->role === "dokter")
            <div class="sidebar-section">Menu Dokter</div>
            <a href="/" class="sidebar-link {{ request()->is('/') ? 'active' : '' }}">
                <i class="fa fa-gauge"></i> Dashboard
            </a>
            <a href="/jadwal" class="sidebar-link {{ request()->is('jadwal*') ? 'active' : '' }}">
                <i class="fa fa-calendar-days"></i> Jadwal Periksa
            </a>
            <a href="/periksa" class="sidebar-link {{ request()->is('periksa*') ? 'active' : '' }}">
                <i class="fa fa-stethoscope"></i> Pemeriksaan
            </a>
            @endif

            @if(Auth::user()->role === "pasien")
            <div class="sidebar-section">Menu Pasien</div>
            <a href="/" class="sidebar-link {{ request()->is('/') ? 'active' : '' }}">
                <i class="fa fa-gauge"></i> Dashboard
            </a>
            <a href="/poli" class="sidebar-link {{ request()->is('poli*') ? 'active' : '' }}">
                <i class="fa fa-hospital"></i> Poliklinik
            </a>
            <a href="/jadwal" class="sidebar-link {{ request()->is('jadwal*') ? 'active' : '' }}">
                <i class="fa fa-clipboard-list"></i> Pendaftaran
            </a>
              <a href="/riwayat" class="sidebar-link {{ request()->is('riwayat*') ? 'active' : '' }}">
                  <i class="fa fa-clock-rotate-left"></i> Riwayat
              </a>
            <a href="/hasil-periksa" class="sidebar-link {{ request()->is('hasil-periksa*') ? 'active' : '' }}">
                <i class="fa fa-file-medical"></i> Hasil Pemeriksaan
            </a>
              <a href="/pembayaran" class="sidebar-link {{ request()->is('pembayaran*') ? 'active' : '' }}">
                  <i class="fa fa-credit-card"></i> Pembayaran
              </a>
            @endif

        </nav>

        <div class="sidebar-footer">
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fa fa-right-from-bracket"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main-wrap">
        <header class="top-header">
            <div class="top-header-brand">
                <i class="fa-solid fa-plus" style="color:#93c5fd;"></i>
                Aldi
            </div>
            <div class="top-header-user">{{ Auth::user()->nama }}</div>
        </header>

        <main class="main-content">
            @if(session("success"))
                <div class="alert-success">
                    <i class="fa fa-check-circle"></i> {{ session("success") }}
                </div>
            @endif
            @yield("content")
        </main>

        <footer class="main-footer">
            &copy;  Aldi {{ date("Y") }} . &nbsp;|&nbsp; Versi 1.0
        </footer>
    </div>
</div>
</body>
</html>
