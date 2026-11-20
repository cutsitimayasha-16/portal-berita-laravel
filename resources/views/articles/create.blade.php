@extends('layouts.app')

@section('title', 'Tambah Artikel')

@section('content')
<div class="form-narrow">
    <div class="page-head">
        <div>
            <h1>Tulis artikel</h1>
            <p class="muted">Isi judul dan isi berita. Gambar boleh dikosongkan.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="error" role="alert">
            <strong>Artikel belum bisa disimpan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.store') }}" method="POST" class="card">
        @csrf

        <label for="title" style="margin-top: 0;">Judul</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}"
               required placeholder="Judul berita">

        <label for="image">URL gambar (opsional)</label>
        <input type="url" id="image" name="image" value="{{ old('image') }}"
               placeholder="https://example.com/gambar.jpg">
        <p class="hint">Jika kosong, sistem memakai gambar placeholder dari <code>picsum.photos</code>.</p>

        <label for="body">Isi berita</label>
        <textarea id="body" name="body" rows="10" required
                  placeholder="Tulis isi berita di sini...">{{ old('body') }}</textarea>

        <div class="form-actions">
            <button type="submit">Simpan artikel</button>
            <a href="{{ route('articles.index') }}" class="btn btn-ghost">Batal</a>
        </div>
    </form>
</div>
@endsection