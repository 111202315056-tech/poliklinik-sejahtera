@extends("layouts.app")
@section("content")
<div style="display:grid; grid-template-columns:1fr 2fr; gap:24px;">

    <div>
        <div style="background:white; border-radius:12px; box-shadow:0 1px 4px rgba(0,0,0,0.08); padding:24px;">
            <h2 style="font-size:16px; font-weight:700; color:#1e293b; margin-bottom:16px;">
                <i class="fa fa-hospital" style="color:#14b8a6; margin-right:8px;"></i>
                {{ isset($poli) ? "Edit Poli" : "Tambah Poli" }}
            </h2>
            <form action="{{ isset($poli) ? "/poli/".$poli->id."/update" : "/poli" }}" method="POST">
                @csrf

                @if(!isset($poli))
                <div style="margin-bottom:16px;">
                    <label style="font-size:13px; color:#64748b; display:block; margin-bottom:8px; font-weight:500;">Pilih Poli Cepat</label>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:8px;">
                        <button type="button" id="btn-umum"
                            style="padding:10px 8px; border:2px solid #e2e8f0; border-radius:10px; font-size:12px; cursor:pointer; background:#f8fafc; text-align:center; transition:all 0.2s;">
                            <i class="fa fa-user-doctor" style="color:#2563eb; display:block; font-size:20px; margin-bottom:6px;"></i>Poli Umum
                        </button>
                        <button type="button" id="btn-anak"
                            style="padding:10px 8px; border:2px solid #e2e8f0; border-radius:10px; font-size:12px; cursor:pointer; background:#f8fafc; text-align:center; transition:all 0.2s;">
                            <i class="fa fa-child" style="color:#16a34a; display:block; font-size:20px; margin-bottom:6px;"></i>Poli Anak
                        </button>
                        <button type="button" id="btn-gigi"
                            style="padding:10px 8px; border:2px solid #e2e8f0; border-radius:10px; font-size:12px; cursor:pointer; background:#f8fafc; text-align:center; transition:all 0.2s;">
                            <i class="fa fa-tooth" style="color:#d97706; display:block; font-size:20px; margin-bottom:6px;"></i>Poli Gigi
                        </button>
                        <button type="button" id="btn-mata"
                            style="padding:10px 8px; border:2px solid #e2e8f0; border-radius:10px; font-size:12px; cursor:pointer; background:#f8fafc; text-align:center; transition:all 0.2s;">
                            <i class="fa fa-eye" style="color:#9333ea; display:block; font-size:20px; margin-bottom:6px;"></i>Poli Mata
                        </button>
                        <button type="button" id="btn-jantung"
                            style="padding:10px 8px; border:2px solid #e2e8f0; border-radius:10px; font-size:12px; cursor:pointer; background:#f8fafc; text-align:center; transition:all 0.2s;">
                            <i class="fa fa-heart-pulse" style="color:#dc2626; display:block; font-size:20px; margin-bottom:6px;"></i>Poli Jantung
                        </button>
                        <button type="button" id="btn-kulit"
                            style="padding:10px 8px; border:2px solid #e2e8f0; border-radius:10px; font-size:12px; cursor:pointer; background:#f8fafc; text-align:center; transition:all 0.2s;">
                            <i class="fa fa-hand-dots" style="color:#ea580c; display:block; font-size:20px; margin-bottom:6px;"></i>Poli Kulit
                        </button>
                    </div>
                </div>
                <hr style="margin-bottom:16px; border-color:#f1f5f9;">
                @endif

                <div style="margin-bottom:12px;">
                    <label style="font-size:13px; color:#64748b; display:block; margin-bottom:6px; font-weight:500;">Nama Poli</label>
                    <input type="text" name="nama_poli" id="nama_poli" placeholder="Contoh: Poli Anak"
                        value="{{ isset($poli) ? $poli->nama_poli : "" }}"
                        style="border:1px solid #e2e8f0; border-radius:8px; width:100%; padding:8px 12px; font-size:14px; outline:none;">
                </div>

                <div style="margin-bottom:12px;">
                    <label style="font-size:13px; color:#64748b; display:block; margin-bottom:6px; font-weight:500;">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="2" placeholder="Keterangan poli..."
                        style="border:1px solid #e2e8f0; border-radius:8px; width:100%; padding:8px 12px; font-size:14px; outline:none; resize:none;">{{ isset($poli) ? $poli->keterangan : "" }}</textarea>
                </div>

                <div style="margin-bottom:16px;">
                    <label style="font-size:13px; color:#64748b; display:block; margin-bottom:6px; font-weight:500;">
                        <i class="fa fa-user-doctor" style="color:#2563eb; margin-right:4px;"></i>Pilih Dokter
                    </label>
                    <div style="border:1px solid #e2e8f0; border-radius:8px; padding:8px; max-height:150px; overflow-y:auto;">
                        @foreach($dokters as $d)
                        <label style="display:flex; align-items:center; gap:8px; padding:6px 8px; border-radius:6px; cursor:pointer; font-size:13px; color:#1e293b;">
                            <input type="checkbox" name="id_dokter[]" value="{{ $d->id }}"
                                {{ isset($poli) && $d->id_poli == $poli->id ? "checked" : "" }}
                                style="width:16px; height:16px; accent-color:#2563eb;">
                            <div style="background:#dbeafe; border-radius:50%; width:28px; height:28px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:11px; color:#2563eb; flex-shrink:0;">
                                {{ strtoupper(substr($d->nama, 0, 1)) }}
                            </div>
                            {{ $d->nama }}
                        </label>
                        @endforeach
                        @if($dokters->count() == 0)
                        <p style="text-align:center; color:#94a3b8; font-size:12px; padding:8px;">Belum ada dokter</p>
                        @endif
                    </div>
                </div>

                <div style="display:flex; gap:8px;">
                    <button type="submit"
                        style="background:#14b8a6; color:white; border:none; padding:10px 16px; border-radius:8px; font-size:14px; font-weight:600; cursor:pointer; flex:1;">
                        <i class="fa fa-save" style="margin-right:6px;"></i>Simpan
                    </button>
                    @if(isset($poli))
                    <a href="/poli" style="background:#94a3b8; color:white; padding:10px 16px; border-radius:8px; font-size:14px; text-decoration:none; display:flex; align-items:center;">
                        <i class="fa fa-times"></i>
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div>
        <div style="background:white; border-radius:12px; box-shadow:0 1px 4px rgba(0,0,0,0.08); padding:24px;">
            <h2 style="font-size:16px; font-weight:700; color:#1e293b; margin-bottom:16px;">
                <i class="fa fa-list" style="color:#14b8a6; margin-right:8px;"></i>Daftar Poli
            </h2>
            <div style="display:flex; flex-direction:column; gap:12px;">
                @forelse($polis as $p)
                <div style="border:1px solid #e2e8f0; border-radius:12px; padding:16px;">
                    <div style="display:flex; align-items:flex-start; justify-content:space-between;">
                        <div style="display:flex; align-items:center; gap:12px;">
                            <div style="background:#ccfbf1; border-radius:50%; width:48px; height:48px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                <i class="fa fa-hospital" style="color:#14b8a6; font-size:20px;"></i>
                            </div>
                            <div>
                                <p style="font-weight:700; color:#1e293b; font-size:15px; margin-bottom:2px;">{{ $p->nama_poli }}</p>
                                <p style="font-size:12px; color:#94a3b8; margin-bottom:6px;">{{ $p->keterangan ?? "-" }}</p>
                                <span style="background:#ccfbf1; color:#0d9488; font-size:11px; padding:2px 10px; border-radius:20px; font-weight:600;">
                                    {{ $p->jumlah_dokter }} Dokter
                                </span>
                            </div>
                        </div>
                        <div style="display:flex; gap:6px; flex-shrink:0;">
                            <a href="/poli/{{ $p->id }}/edit"
                                style="background:#22c55e; color:white; padding:6px 12px; border-radius:8px; font-size:12px; text-decoration:none; font-weight:500;">
                                <i class="fa fa-edit" style="margin-right:4px;"></i>Ubah
                            </a>
                            <a href="/poli/{{ $p->id }}/delete" onclick="return confirm('Yakin hapus poli ini?')"
                                style="background:#ef4444; color:white; padding:6px 12px; border-radius:8px; font-size:12px; text-decoration:none; font-weight:500;">
                                <i class="fa fa-trash" style="margin-right:4px;"></i>Hapus
                            </a>
                        </div>
                    </div>
                    @if($p->dokters && $p->dokters->count() > 0)
                    <div style="margin-top:12px; padding-top:12px; border-top:1px solid #f1f5f9;">
                        <p style="font-size:11px; color:#94a3b8; font-weight:600; text-transform:uppercase; margin-bottom:8px;">Dokter & Jam Praktek</p>
                        <div style="display:flex; flex-direction:column; gap:6px;">
                            @foreach($p->dokters as $dokter)
                            <div style="display:flex; align-items:center; background:#f8fafc; border-radius:8px; padding:8px 12px; gap:8px;">
                                <div style="background:#dbeafe; border-radius:50%; width:32px; height:32px; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:12px; color:#2563eb; flex-shrink:0;">
                                    {{ strtoupper(substr($dokter->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <p style="font-size:13px; font-weight:600; color:#1e293b; margin:0;">{{ $dokter->nama }}</p>
                                    @if($dokter->jadwals && $dokter->jadwals->count() > 0)
                                    <div style="display:flex; gap:4px; flex-wrap:wrap; margin-top:2px;">
                                        @foreach($dokter->jadwals as $jadwal)
                                        <span style="background:#dbeafe; color:#2563eb; font-size:10px; padding:1px 6px; border-radius:4px;">
                                            {{ $jadwal->hari }} {{ $jadwal->jam_mulai }}-{{ $jadwal->jam_selesai }}
                                        </span>
                                        @endforeach
                                    </div>
                                    @else
                                    <p style="font-size:11px; color:#94a3b8; margin:0;">Belum ada jadwal</p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @empty
                <div style="text-align:center; padding:40px; color:#94a3b8;">
                    <i class="fa fa-hospital" style="font-size:40px; display:block; margin-bottom:8px;"></i>
                    Belum ada data poli
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
var poliData = {
    "btn-umum":    { nama: "Poli Umum",    ket: "Melayani pemeriksaan umum" },
    "btn-anak":    { nama: "Poli Anak",    ket: "Melayani pemeriksaan anak" },
    "btn-gigi":    { nama: "Poli Gigi",    ket: "Melayani pemeriksaan gigi" },
    "btn-mata":    { nama: "Poli Mata",    ket: "Melayani pemeriksaan mata" },
    "btn-jantung": { nama: "Poli Jantung", ket: "Melayani pemeriksaan jantung" },
    "btn-kulit":   { nama: "Poli Kulit",   ket: "Melayani pemeriksaan kulit" }
};
Object.keys(poliData).forEach(function(id) {
    var btn = document.getElementById(id);
    if (btn) {
        btn.addEventListener("click", function() {
            document.getElementById("nama_poli").value = poliData[id].nama;
            document.getElementById("keterangan").value = poliData[id].ket;
            Object.keys(poliData).forEach(function(k) {
                var b = document.getElementById(k);
                if (b) b.style.border = "2px solid #e2e8f0";
            });
            btn.style.border = "2px solid #14b8a6";
        });
    }
});
</script>
@endsection
