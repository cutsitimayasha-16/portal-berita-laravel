@extends('layouts.app')

@section('title', 'Artikel')

@section('content')
<div class="page-head">
    <div>
        <h1>Daftar artikel</h1>
        <p class="muted">Semua artikel yang sudah dipublikasikan.</p>
    </div>
    <a href="{{ route('articles.create') }}" class="btn">Artikel baru</a>
</div>

@if (session('success'))
    <div class="flash" role="status">{{ session('success') }}</div>
@endif

@if ($articles->isNotEmpty())
    <div class="row-list">
        @foreach ($articles as $article)
            <div class="row-item">
                <img src="{{ $article->image_url }}" alt="Thumbnail {{ $article->title }}" loading="lazy">
                <div class="grow">
                    <h4>
                        <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                        @if ($article->user_id === auth()->id())
                            <span class="badge">Milikmu</span>
                        @endif
                    </h4>
                    <p class="meta">{{ $article->user->name }} &middot; {{ $article->created_at->format('d M Y') }}</p>
                </div>

                @if ($article->user_id === auth()->id())
                    <div class="row-actions">
                        <a href="{{ route('articles.edit', $article) }}" class="btn btn-ghost btn-sm">Edit</a>
                        <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline"
                              onsubmit="return confirm('Hapus artikel ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    {{ $articles->links('pagination::bootstrap-4') }}
@else
    <div class="card empty">
        <h3>Belum ada artikel</h3>
        <p class="muted">Mulai dengan menulis artikel pertama.</p>
        <a href="{{ route('articles.create') }}" class="btn">Tulis artikel</a>
    </div>
@endif
@endsection