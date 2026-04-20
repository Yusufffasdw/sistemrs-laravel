@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2>✏️ Edit Artikel</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('artikel.index') }}">Artikel</a></li>
                    <li class="breadcrumb-item active">Edit Artikel</li>
                </ol>
            </nav>
        </div>
    </div>

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Terjadi Kesalahan!</strong>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('artikel.update', $artikel) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- Judul -->
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Artikel <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                   id="judul" name="judul" value="{{ old('judul', $artikel->judul) }}" required>
                            @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="draft" {{ old('status', $artikel->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $artikel->status) == 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <input type="text" class="form-control @error('kategori') is-invalid @enderror" 
                                   id="kategori" name="kategori" value="{{ old('kategori', $artikel->kategori) }}" 
                                   placeholder="Contoh: Kesehatan, Tips, Berita">
                            @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Penulis -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="penulis" class="form-label">Penulis</label>
                            <input type="text" class="form-control @error('penulis') is-invalid @enderror" 
                                   id="penulis" name="penulis" value="{{ old('penulis', $artikel->penulis) }}" 
                                   placeholder="Nama penulis">
                            @error('penulis')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Gambar -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar Artikel</label>
                            
                            @if($artikel->gambar)
                            <div class="mb-2">
                                <img src="{{ asset($artikel->gambar) }}" alt="Current Image" class="img-thumbnail" style="max-width: 200px;">
                                <p class="text-muted small mb-0">Gambar saat ini</p>
                            </div>
                            @endif
                            
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" 
                                   id="gambar" name="gambar" accept="image/*" onchange="previewImage(this)">
                            <small class="text-muted">Format: JPG, JPEG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar</small>
                            @error('gambar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div id="imagePreview" class="mt-2"></div>
                        </div>
                    </div>

                    <!-- Konten -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="konten" class="form-label">Konten Artikel <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('konten') is-invalid @enderror" 
                                      id="konten" name="konten" rows="15" required>{{ old('konten', $artikel->konten) }}</textarea>
                            @error('konten')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('artikel.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Artikel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <p class="text-muted small">Preview gambar baru:</p>
                <img src="${e.target.result}" class="img-thumbnail" style="max-width: 300px; max-height: 300px;">
            `;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
