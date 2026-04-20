@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/jadwal-dokter-custom.css') }}">
@endpush
<style></style>
@section('content')
<div class="jadwal-container">
    
    <!-- SIDEBAR BUAT JANJI -->
    <div id="sidebarJanji" class="sidebar-janji">
        
        <div class="sidebar-header">
            <h2 class="sidebar-title">📋 Buat Janji Temu</h2>
            <button onclick="resetFormJanji()" class="btn-reset" title="Reset Form">↻</button>
        </div>

        <!-- Form Buat Janji -->
        <form id="formBuatJanji" action="{{ route('pendaftaran.store') }}" method="POST">
            @csrf
            
            <!-- Pilih Pasien -->
             <div class="form-group">
                <label class="form-label">
                    💬 nama pasien <span class="required">*</span>
                </label>
                <textarea name="pasien_id" id="pasien" required rows="4" 
                          placeholder="Jelaskan keluhan Anda..."
                          class="form-control form-textarea"></textarea>
                <small class="form-help">M</small>
            </div>
            <!-- Pilih Dokter -->
            <div class="form-group">
                <label class="form-label">
                    👨‍⚕️ Pilih Dokter <span class="required">*</span>
                </label>
                <select name="dokter_id" id="dokterSelect" required class="form-control form-select" onchange="updateInfoDokter(this)">
                    <option value="">-- Pilih Dokter --</option>
                    @foreach($dokter as $item)
                        <option value="{{ $item->id }}" 
                                data-spesialisasi="{{ $item->spesialisasi }}" 
                                data-departemen="{{ $item->departemen->nama ?? '-' }}">
                            Dr. {{ $item->nama }} - {{ $item->spesialisasi }}
                        </option>
                    @endforeach
                </select>
                
                <!-- Info Dokter Terpilih -->
                <div id="infoDokter" class="info-dokter">
                    <div class="info-spesialisasi" id="spesialisasiDokter"></div>
                    <div class="info-departemen" id="departemenDokter"></div>
                </div>
            </div>

            <!-- Pilih Tanggal -->
            <div class="form-group">
                <label class="form-label">
                    📅 Pilih Tanggal <span class="required">*</span>
                </label>
                <input type="date" name="tanggal_daftar" id="tanggalDaftar" required 
                       min="{{ date('Y-m-d') }}"
                       class="form-control" 
                       onchange="checkAntrianHari(this)">
                <small id="infoAntrian" class="info-antrian">
                    <!-- Info antrian akan muncul di sini -->
                </small>
            </div>

            <!-- Keluhan -->
            <div class="form-group">
                <label class="form-label">
                    💬 Keluhan <span class="required">*</span>
                </label>
                <textarea name="keluhan" id="keluhan" required rows="4" 
                          placeholder="Jelaskan keluhan Anda..."
                          class="form-control form-textarea"></textarea>
                <small class="form-help">Minimal 10 karakter</small>
            </div>

            <!-- Biaya Konsultasi -->
            <div class="form-group">
                <label class="form-label">💰 Biaya Konsultasi (Opsional)</label>
                <input type="number" name="biaya_konsultasi" id="biayaKonsultasi" 
                       placeholder="Rp 0" min="0" step="1000"
                       class="form-control">
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn-submit">
                ✅ Buat Janji Sekarang
            </button>

            <!-- Info Tambahan -->
            <div class="info-box">
                <div class="info-box-title">ℹ️ Informasi Penting</div>
                <ul class="info-box-list">
                    <li>Harap datang 15 menit sebelum jadwal</li>
                    <li>Bawa kartu identitas dan kartu BPJS (jika ada)</li>
                    <li>Konfirmasi akan dikirim via SMS/WhatsApp</li>
                </ul>
            </div>

        </form>

        <!-- Statistik Cepat -->
        <div class="stats-box">
            <div class="stats-title">📊 Statistik Hari Ini</div>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number primary">
                        {{ \App\Models\Pendaftaran::whereDate('tanggal_daftar', today())->count() }}
                    </div>
                    <div class="stat-label">Total Janji</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number success">
                        {{ \App\Models\Dokter::where('status', 'aktif')->count() }}
                    </div>
                    <div class="stat-label">Dokter Aktif</div>
                </div>
            </div>
        </div>

    </div>
    <!-- END SIDEBAR -->

    <!-- KONTEN UTAMA -->
    <div class="main-content">
        
        <!-- Header -->
        <div class="page-header">
            <h1 class="page-title">📅 Jadwal Dokter</h1>
            <a href="{{ route('beranda') }}" class="btn-back">← Kembali</a>
        </div>

        <!-- Month Navigation -->
        <div class="month-nav">
            <form method="GET" class="filter-form">
                <select name="bulan" class="filter-select">
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ $m == $bulan ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                        </option>
                    @endfor
                </select>
                
                <select name="tahun" class="filter-select">
                    @for ($y = now()->year - 1; $y <= now()->year + 1; $y++)
                        <option value="{{ $y }}" {{ $y == $tahun ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
                
                <button type="submit" class="btn-filter">Filter</button>
            </form>
            
            <h2 class="current-month">
                {{ date('F Y', mktime(0, 0, 0, $bulan, 1, $tahun)) }}
            </h2>
        </div>

        <!-- Calendar -->
        <div class="calendar-container">
            
            <!-- Days of Week Header -->
            <div class="calendar-header">
                <div class="calendar-day-name">Minggu</div>
                <div class="calendar-day-name">Senin</div>
                <div class="calendar-day-name">Selasa</div>
                <div class="calendar-day-name">Rabu</div>
                <div class="calendar-day-name">Kamis</div>
                <div class="calendar-day-name">Jumat</div>
                <div class="calendar-day-name">Sabtu</div>
            </div>

            <!-- Calendar Days -->
            <div class="calendar-grid">
                
                <!-- Empty cells for days before month starts -->
                @for ($i = 0; $i < $hari_pertama; $i++)
                    <div class="calendar-cell empty"></div>
                @endfor

                <!-- Days of month -->
                @for ($hari = 1; $hari <= $jumlah_hari; $hari++)
                    @php
                        $tanggal = \Carbon\Carbon::createFromDate($tahun, $bulan, $hari);
                        $jumlah_pendaftaran = isset($pendaftaran[$hari]) ? count($pendaftaran[$hari]) : 0;
                        $is_today = $tanggal->isToday();
                        $is_past = $tanggal->isPast();
                        $tanggal_formatted = $tanggal->format('Y-m-d');
                    @endphp
                    
                    <div onclick="pilihTanggalDariKalender('{{ $tanggal_formatted }}')" 
                         class="calendar-cell {{ $is_today ? 'today' : '' }} {{ $is_past ? 'past' : '' }}">
                        
                        <div class="calendar-date {{ $is_today ? 'today' : '' }}">
                            {{ $hari }}
                            @if ($is_today)
                                <span>●</span>
                            @endif
                        </div>
                        
                        @if ($jumlah_pendaftaran > 0)
                            <div class="calendar-info has-registration">
                                📅 {{ $jumlah_pendaftaran }} Pendaftaran
                            </div>
                        @else
                            <div class="calendar-info available">Tersedia</div>
                        @endif
                        
                        @if (!$is_past)
                            <div class="calendar-action active">Buat Janji →</div>
                        @else
                            <div class="calendar-action past">Sudah Lewat</div>
                        @endif
                        
                    </div>
                @endfor

                <!-- Empty cells for days after month ends -->
                @for ($i = ($hari_pertama + $jumlah_hari); $i < 42; $i++)
                    <div class="calendar-cell empty"></div>
                @endfor

            </div>

        </div>

        <!-- Dokter List -->
        <div class="dokter-section">
            <h2 class="section-title">👨‍⚕️ Dokter Tersedia</h2>
            
            <div class="dokter-grid">
                @foreach ($dokter as $item)
                    <div onclick="pilihDokterDariList({{ $item->id }})" class="dokter-card">
                        
                        <div class="dokter-avatar">👨‍⚕️</div>
                        
                        <h3 class="dokter-name">Dr. {{ $item->nama }}</h3>
                        
                        <p class="dokter-spesialisasi">{{ $item->spesialisasi }}</p>
                        
                        <p class="dokter-departemen">{{ $item->departemen->nama ?? '-' }}</p>
                        
                        <div class="dokter-btn">Pilih Dokter</div>
                        
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    <!-- END KONTEN UTAMA -->

</div>

<!-- JavaScript -->
@push('scripts')
<script>
// Fungsi untuk update info dokter saat dipilih
function updateInfoDokter(select) {
    const infoDokter = document.getElementById('infoDokter');
    const spesialisasi = document.getElementById('spesialisasiDokter');
    const departemen = document.getElementById('departemenDokter');
    
    if (select.value) {
        const option = select.options[select.selectedIndex];
        const dataSpesialisasi = option.getAttribute('data-spesialisasi');
        const dataDepartemen = option.getAttribute('data-departemen');
        
        spesialisasi.textContent = '🩺 ' + dataSpesialisasi;
        departemen.textContent = '🏥 ' + dataDepartemen;
        infoDokter.classList.add('show');
    } else {
        infoDokter.classList.remove('show');
    }
}

// Fungsi untuk cek antrian hari tertentu
function checkAntrianHari(input) {
    const tanggal = input.value;
    const dokterId = document.getElementById('dokterSelect').value;
    const infoAntrian = document.getElementById('infoAntrian');
    
    if (tanggal && dokterId) {
        infoAntrian.textContent = '✅ Tanggal tersedia. Klik untuk membuat janji.';
        infoAntrian.classList.add('show');
        
        if (window.innerWidth < 768) {
            document.getElementById('sidebarJanji').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    } else {
        infoAntrian.classList.remove('show');
    }
}

// Fungsi untuk reset form
function resetFormJanji() {
    document.getElementById('formBuatJanji').reset();
    document.getElementById('infoDokter').classList.remove('show');
    document.getElementById('infoAntrian').classList.remove('show');
}

// Fungsi untuk pilih tanggal dari kalender
function pilihTanggalDariKalender(tanggal) {
    const tanggalInput = document.getElementById('tanggalDaftar');
    const today = new Date().toISOString().split('T')[0];
    
    if (tanggal < today) {
        alert('❌ Tidak dapat memilih tanggal yang sudah lewat');
        return;
    }
    
    tanggalInput.value = tanggal;
    checkAntrianHari(tanggalInput);
    
    document.getElementById('sidebarJanji').scrollIntoView({ behavior: 'smooth', block: 'start' });
    
    tanggalInput.focus();
    tanggalInput.classList.add('highlight');
    setTimeout(() => tanggalInput.classList.remove('highlight'), 2000);
}

// Fungsi untuk pilih dokter dari list
function pilihDokterDariList(dokterId) {
    const dokterSelect = document.getElementById('dokterSelect');
    dokterSelect.value = dokterId;
    
    updateInfoDokter(dokterSelect);
    
    document.getElementById('sidebarJanji').scrollIntoView({ behavior: 'smooth', block: 'start' });
    
    dokterSelect.focus();
    dokterSelect.classList.add('highlight');
    setTimeout(() => dokterSelect.classList.remove('highlight'), 2000);
}

// Validasi form sebelum submit
document.getElementById('formBuatJanji').addEventListener('submit', function(e) {
    const keluhan = document.getElementById('keluhan').value;
    
    if (keluhan.length < 1) {
        e.preventDefault();
        alert('❌ Keluhan harus minimal 10 karakter');
        document.getElementById('keluhan').focus();
        return false;
    }
    
    if (!confirm('✅ Apakah data yang Anda masukkan sudah benar?')) {
        e.preventDefault();
        return false;
    }
});

// Auto-hide notifications
window.addEventListener('load', function() {
    const alerts = document.querySelectorAll('.notification');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });
});
</script>
@endpush

@if(session('success'))
<div class="notification success">
    ✅ {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="notification error">
    ❌ {{ session('error') }}
</div>
@endif

@endsection