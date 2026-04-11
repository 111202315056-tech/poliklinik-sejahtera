<aside class="sidebar">
        <div class="sidebar-logo">
            <div class="sidebar-logo-icon">
                <i class="fa-solid fa-plus" style="color:white; font-size:16px;"></i>
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
            @endif

            @if(Auth::user()->role === "dokter")
            <div class="sidebar-section">Menu Dokter</div>
            <a href="/" class="sidebar-link {{ request()->is('/') ? 'active' : '' }}">
                <i class="fa fa-gauge"></i> Dashboard
            </a>
            <a href="/pendaftaran" class="sidebar-link {{ request()->is('pendaftaran*') ? 'active' : '' }}">
                <i class="fa fa-calendar-days"></i> Jadwal Periksa
            </a>
            <a href="/hasil-periksa" class="sidebar-link {{ request()->is('periksa*') ? 'active' : '' }}">
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
            <a href="/pendaftaran" class="sidebar-link {{ request()->is('pendaftaran*') ? 'active' : '' }}">
                <i class="fa fa-clipboard-list"></i> Pendaftaran
            </a>
            <a href="/hasil-periksa" class="sidebar-link {{ request()->is('hasil-periksa*') ? 'active' : '' }}">
                <i class="fa fa-file-medical"></i> Hasil Pemeriksaan
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