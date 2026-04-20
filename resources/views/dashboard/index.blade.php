@extends('layouts.app')

@section('title', 'Overview Dashboard      ////////////     I wish you healing here hehe i wish serius' )

@section(section: 'content')


<!-- 4 Statistik Utama -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm transition hover:shadow-md">
        <div class="flex justify-between items-center mb-4">
            <div class="p-2 bg-blue-50 text-blue-600 rounded-xl">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>
            <span class="text-[10px] font-bold text-green-500 bg-green-50 px-2 py-1 rounded-lg">Update</span>
        </div>
        <h4 class="text-gray-400 text-[10px] font-bold uppercase tracking-widest">Total Pasien</h4>
        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['total_pasien'] }}</p>
    </div>

    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm transition hover:shadow-md">
        <div class="flex justify-between items-center mb-4">
            <div class="p-2 bg-orange-50 text-orange-600 rounded-xl">
                <i data-lucide="calendar-clock" class="w-6 h-6"></i>
            </div>
            <span class="text-[10px] font-bold text-orange-500 bg-orange-50 px-2 py-1 rounded-lg">Hari Ini</span>
        </div>
        <h4 class="text-gray-400 text-[10px] font-bold uppercase tracking-widest">Pendaftaran</h4>
        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['antrean_hari_ini'] }}</p>
    </div>

    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm transition hover:shadow-md">
        <div class="flex justify-between items-center mb-4">
            <div class="p-2 bg-purple-50 text-purple-600 rounded-xl">
                <i data-lucide="stethoscope" class="w-6 h-6"></i>
            </div>
            <span class="text-[10px] font-bold text-purple-500 bg-purple-50 px-2 py-1 rounded-lg">Aktif</span>
        </div>
        <h4 class="text-gray-400 text-[10px] font-bold uppercase tracking-widest">Dokter</h4>
        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['dokter_aktif'] }}</p>
    </div>

    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm transition hover:shadow-md">
        <div class="flex justify-between items-center mb-4">
            <div class="p-2 bg-red-50 text-red-600 rounded-xl">
                <i data-lucide="bed" class="w-6 h-6"></i>
            </div>
            <span class=""></span>
        </div>
        <h4 class="text-gray-400 text-[10px] font-bold uppercase tracking-widest">Jumlah Kamar</h4>
        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['kamar_tersedia'] }}</p>
    </div>
</div>

<!-- Quick Action Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <a href="{{ route('dokter.create') }}" class="action-card bg-green-50 text-green-700">
        <i data-lucide="user-plus" class="w-8 h-8 mb-2"></i>
        <p class="font-bold">Tambah Dokter</p>
    </a>

    <a href="{{ route('pendaftaran.create') }}" class="action-card bg-blue-50 text-blue-700">
        <i data-lucide="clipboard-plus" class="w-8 h-8 mb-2"></i>
        <p class="font-bold">Pendaftaran Baru</p>
    </a>


</div>

<!-- Grafik Pendaftaran Mingguan -->
<div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm mb-10">
    <h3 class="text-gray-700 font-bold mb-4">Pendaftaran Minggu Ini</h3>
    <canvas id="pendaftaranChart" height="100"></canvas>
</div>

<!-- Tabel Dokter Terbaru -->
<div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm mb-10">
    <h3 class="text-gray-700 font-bold mb-4">5 Dokter Terbaru</h3>
    <table class="w-full text-left text-sm">
        <thead>
            <tr class="border-b">
                <th class="pb-2">No</th>
                <th class="pb-2">Nama Dokter</th>
                <th class="pb-2">Spesialisasi</th>
                <th class="pb-2">Departemen</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dokter_terbaru as $i => $dokter)
            <tr class="border-b hover:bg-gray-50 transition">
                <td class="py-2">{{ $i+1 }}</td>
                <td class="py-2">{{ $dokter->nama }}</td>
                <td class="py-2">{{ $dokter->spesialisasi }}</td>
                <td class="py-2">{{ $dokter->departemen->nama ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Tabel Antrian Hari Ini -->
<div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm mb-10">
    <h3 class="text-gray-700 font-bold mb-4">5 Antrian Terbaru Hari Ini</h3>
    <table class="w-full text-left text-sm">
        <thead>
            <tr class="border-b">
                <th class="pb-2">No</th>
                <th class="pb-2">Pasien</th>
                <th class="pb-2">Dokter</th>
                <th class="pb-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($antrian_hari_ini as $i => $item)
            <tr class="border-b hover:bg-gray-50 transition">
                <td class="py-2">{{ $i+1 }}</td>
                <td class="py-2">{{ $item->pasien->nama }}</td>
                <td class="py-2">{{ $item->dokter->nama }}</td>
                <td class="py-2">
                    <span class="px-2 py-1 rounded-lg text-xs 
                        {{ $item->status=='selesai' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('pendaftaranChart').getContext('2d');
const chartData = {!! json_encode($chart_data) !!};
const maxValue = Math.max(...chartData);

const chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($chart_labels) !!},
        datasets: [{
            label: 'Jumlah Pendaftaran',
            data: chartData,
            backgroundColor: 'rgba(13,110,253,0.2)',
            borderColor: 'rgba(13,110,253,1)',
            borderWidth: 2,
            tension: 0.3,
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: { 
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return 'Pendaftaran: ' + context.parsed.y;
                    }
                }
            }
        },
        scales: {
            y: { 
                beginAtZero: true,
                ticks: { 
                    stepSize: 1,
                    precision: 0
                },
                suggestedMax: maxValue + 2
            }
        }
    }
});
</script>

<!-- Tailwind tambahan untuk action card -->
<style>
.action-card {
    @apply flex flex-col items-center justify-center p-6 rounded-3xl shadow-sm border transition hover:shadow-md hover:scale-105;
}
</style>


@endsection