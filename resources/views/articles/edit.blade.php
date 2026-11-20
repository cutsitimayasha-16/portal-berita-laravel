@extends('layouts.app')

@section('title', 'Edit Artikel')

@section('content')
<div class="form-narrow">
    <div class="page-head">
        <div>
            <h1>Edit artikel</h1>
            <p class="muted">Kosongkan URL gambar untuk kembali memakai placeholder.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="error" role="alert">
            <strong>Perubahan belum bisa disimpan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.update', $article) }}" method="POST" class="card form-card">
        @csrf
        @method('PUT')

        <label for="title" style="margin-top: 0;">Judul</label>
        <input type="text" id="title" name="title"
               value="{{ old('title', $article->title) }}" required placeholder="Judul berita">

        <label for="image">URL gambar (opsional)</label>
        <input type="url" id="image" name="image"
               value="{{ old('image', $article->image) }}"
               placeholder="https://example.com/gambar.jpg">
        <img class="preview" src="{{ $article->image_url }}" alt="Gambar artikel saat ini">
        <p class="hint">Gambar saat ini.</p>

        <label for="body">Isi berita</label>
        <textarea id="body" name="body" rows="10" required>{{ old('body', $article->body) }}</textarea>

        <div class="form-actions">
            <button type="submit">Simpan perubahan</button>
            <a href="{{ route('articles.index') }}" class="btn btn-ghost">Batal</a>
        </div>
    </form>
</div>
@endsection