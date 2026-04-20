@extends('layouts.navter')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8fafc;
    }

    /* Layout Single Column */
    .jadwal-wrapper {
        padding: 40px;
        max-width: 1200px; /* Ukuran lebih pas untuk satu kolom */
        margin: 0 auto;
    }

    /* Main Content Styling */
    .page-header-minimal {
        margin-bottom: 30px;
    }

    .page-title {
        font-weight: 800;
        color: #1e293b;
        font-size: 2.25rem;
    }

    /* Calendar Grid Styling */
    .calendar-container {
        background: white;
        border-radius: 24px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        margin-bottom: 50px;
    }

    .calendar-header-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        text-align: center;
        background: #f8fafc;
        border-radius: 12px;
        margin-bottom: 15px;
    }

    .day-name {
        padding: 15px;
        font-weight: 700;
        color: #64748b;
        font-size: 0.85rem;
        text-transform: uppercase;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 15px;
    }

    .calendar-cell {
        min-height: 120px;
        border-radius: 20px;
        padding: 15px;
        border: 2px solid #f1f5f9;
        transition: all 0.3s ease;
        position: relative;
    }

    .calendar-cell.today {
        background: #eff6ff;
        border-color: #3b82f6;
    }

    .calendar-cell.past {
        background: #f8fafc;
        opacity: 0.6;
    }

    .date-number {
        font-weight: 700;
        color: #1e293b;
        font-size: 1.25rem;
    }

    .reg-count {
        background: #6366f1;
        color: white;
        font-size: 0.75rem;
        padding: 5px 10px;
        border-radius: 10px;
        margin-top: 10px;
        display: inline-block;
        font-weight: 600;
    }

    .available-tag {
        color: #10b981;
        font-size: 0.75rem;
        font-weight: 600;
        margin-top: 10px;
    }

    /* Doctor Cards List */
    .dokter-list-header {
        margin-bottom: 25px;
        font-weight: 800;
        color: #1e293b;
    }

    .dokter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
    }

    .dokter-card {
        background: white;
        border-radius: 24px;
        padding: 25px;
        border: 2px solid transparent;
        transition: all 0.3s ease;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }

    .avatar-circle {
        width: 70px;
        height: 70px;
        background: #f1f5f9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 2rem;
        color: #6366f1;
    }

    @media (max-width: 768px) {
        .calendar-cell { min-height: 80px; padding: 10px; }
        .date-number { font-size: 1rem; }
        .jadwal-wrapper { padding: 20px; }
    }
</style>

<div class="jadwal-wrapper">
    <main class="main-content">
        <div class="page-header-minimal d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3">
            <div>
                <h1 class="page-title">Jadwal Praktik</h1>
                <p class="text-muted mb-0">Informasi ketersediaan dokter dan antrean hari ini</p>
            </div>
            
            <form method="GET" class="d-flex gap-2">
                <select name="bulan" class="form-select border-0 shadow-sm px-3" style="border-radius: 12px;">
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ $m == $bulan ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                        </option>
                    @endfor
                </select>
                <button type="submit" class="btn btn-primary rounded-3 px-4 fw-bold shadow-sm">Filter</button>
            </form>
        </div>

        <hr class="my-4 opacity-0">

        <div class="calendar-container">
            <div class="calendar-header-grid">
                <div class="day-name text-danger">Min</div>
                <div class="day-name">Sen</div>
                <div class="day-name">Sel</div>
                <div class="day-name">Rab</div>
                <div class="day-name">Kam</div>
                <div class="day-name">Jum</div>
                <div class="day-name text-primary">Sab</div>
            </div>

            <div class="calendar-grid">
                @for ($i = 0; $i < $hari_pertama; $i++)
                    <div class="calendar-cell empty border-0"></div>
                @endfor

                @for ($hari = 1; $hari <= $jumlah_hari; $hari++)
                    @php
                        $tanggal = \Carbon\Carbon::createFromDate($tahun, $bulan, $hari);
                        $regCount = isset($pendaftaran[$hari]) ? count($pendaftaran[$hari]) : 0;
                        $isPast = $tanggal->isPast() && !$tanggal->isToday();
                    @endphp
                    
                    <div class="calendar-cell {{ $tanggal->isToday() ? 'today' : '' }} {{ $isPast ? 'past' : '' }}">
                        <div class="date-number">{{ $hari }}</div>
                        
                        @if ($regCount > 0)
                            <div class="reg-count">
                                <i class="bi bi-people-fill me-1"></i> {{ $regCount }} Pasien
                            </div>
                        @else
                            @if(!$isPast)
                                <div class="available-tag">
                                    <i class="bi bi-check2-circle me-1"></i>Tersedia
                                </div>
                            @endif
                        @endif
                    </div>
                @endfor
            </div>
        </div>

        <h3 class="dokter-list-header">Daftar Dokter Spesialis</h3>
        <div class="dokter-grid">
            @foreach ($dokter as $item)
                <div class="dokter-card">
                    <div class="avatar-circle">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <h5 class="mb-1 fw-bold">Dr. {{ $item->nama }}</h5>
                    <p class="text-primary small fw-semibold mb-2">{{ $item->spesialisasi }}</p>
                    <span class="badge bg-light text-muted rounded-pill px-3">
                        <i class="bi bi-building me-1"></i>{{ $item->departemen->nama ?? 'Umum' }}
                    </span>
                </div>
            @endforeach
        </div>
    </main>
</div>

@endsection