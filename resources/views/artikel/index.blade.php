@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">📝 Manajemen Artikel</h2>
                <div class="btn-group">
                    <a href="{{ route('artikel.export', request()->query()) }}" class="btn btn-success">
                        <i class="fas fa-download"></i> Export CSV
                    </a>
                    <a href="{{ route('artikel.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Artikel
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Filter dan Search -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('artikel.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Cari Artikel</label>
                    <input type="text" name="search" class="form-control" placeholder="Cari judul, konten, atau penulis..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach($kategori_list as $kat)
                        <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Gambar</th>
                            <th width="25%">Judul</th>
                            <th width="15%">Kategori</th>
                            <th width="12%">Penulis</th>
                            <th width="8%">Views</th>
                            <th width="10%">Status</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($artikel as $index => $item)
                        <tr>
                            <td>{{ $artikel->firstItem() + $index }}</td>
                            <td>
                                @if($item->gambar)
                                <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="fas fa-image"></i>
                                </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $item->judul }}</strong><br>
                                <small class="text-muted">{{ $item->tanggal_formatted }}</small>
                            </td>
                            <td>
                                @if($item->kategori)
                                <span class="badge bg-info">{{ $item->kategori }}</span>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $item->penulis ?? '-' }}</td>
                            <td>
                                <span class="badge bg-secondary">
                                    <i class="fas fa-eye"></i> {{ $item->views }}
                                </span>
                            </td>
                            <td>
                                @if($item->status == 'published')
                                <span class="badge bg-success">Published</span>
                                @else
                                <span class="badge bg-warning text-dark">Draft</span>
                                @endif
                            </td>
                         <td>
    <div class="d-flex gap-2" role="group">
        <a href="{{ route('artikel.show', $item) }}" class="btn btn-sm btn-info text-white" title="Lihat">
            <i class="fas fa-eye">detail</i>
        </a>
        
        <a href="{{ route('artikel.edit', $item) }}" class="btn btn-sm btn-warning text-white" title="Edit">
            <i class="fas fa-edit">edit</i>
        </a>

        <form action="{{ route('artikel.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                <i class="fas fa-trash">hapus</i>
            </button>
        </form>
    </div>
</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Tidak ada artikel ditemukan</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $artikel->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
