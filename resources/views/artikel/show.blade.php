@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2>📄 Detail Artikel</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('artikel.index') }}">Artikel</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <!-- Header -->
       <div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center bg-light p-3 rounded border">
            <div>
                <h3 class="mb-1">{{ $artikel->judul }}</h3>
                <div class="d-flex gap-2 align-items-center">
                    @if($artikel->status == 'published')
                        <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Published</span>
                    @else
                        <span class="badge bg-warning text-dark"><i class="fas fa-file-alt me-1"></i>Draft</span>
                    @endif
                    
                    @if($artikel->kategori)
                        <span class="badge bg-info text-dark"><i class="fas fa-tag me-1"></i>{{ $artikel->kategori }}</span>
                    @endif
                    
                    <span class="text-muted small">
                        <i class="fas fa-eye"></i> {{ $artikel->views }} views
                    </span>
                </div>
            </div>
            
            <div class="d-flex gap-2">
                <a href="{{ route('artikel.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <div class="btn-group" role="group">
                    <a href="{{ route('artikel.edit', $artikel) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>

                <form id="delete-form" action="{{ route('artikel.destroy', $artikel) }}" method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>
            <!-- Gambar -->
            @if($artikel->gambar)
            <div class="row mb-4">
                <div class="col-md-12">
                    <img src="{{ asset($artikel->gambar) }}" alt="{{ $artikel->judul }}" class="img-fluid rounded" style="max-height: 500px; width: 100%; object-fit: cover;">
                </div>
            </div>
            @endif

            <!-- Metadata -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <tr>
                            <th width="200">Penulis</th>
                            <td>{{ $artikel->penulis ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td><code>{{ $artikel->slug }}</code></td>
                        </tr>
                        <tr>
                            <th>Tanggal Dibuat</th>
                            <td>{{ $artikel->tanggal_formatted }}</td>
                        </tr>
                        <tr>
                            <th>Terakhir Diupdate</th>
                            <td>{{ $artikel->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Konten -->
            <div class="row">
                <div class="col-md-12">
                    <h5 class="mb-3">Konten Artikel:</h5>
                    <div class="border rounded p-4 bg-light" style="white-space: pre-wrap;">{{ $artikel->konten }}</div>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('artikel.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Artikel
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
