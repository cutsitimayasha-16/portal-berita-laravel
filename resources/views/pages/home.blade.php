@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="stack">
    <section class="hero">
        <h1>Portal Berita</h1>
        <p>
            Baca berita terbaru dari para penulis di portal ini, atau tulis beritamu sendiri.
            @auth Kamu masuk sebagai <strong>{{ auth()->user()->name }}</strong>. @endauth
        </p>
        <div class="actions">
            @guest
                <a href="{{ route('register') }}" class="btn btn-accent">Daftar gratis</a>
                <a href="{{ route('login') }}" class="btn btn-ghost">Masuk</a>
            @endguest
            @auth
                <a href="{{ route('articles.create') }}" class="btn btn-accent">Tulis berita</a>
                <a href="{{ route('dashboard') }}" class="btn btn-ghost">Buka dashboard</a>
            @endauth
        </div>
    </section>

    @if ($articles->isNotEmpty())
        @php $featured = $articles->first(); @endphp

        <article class="featured c{{ $featured->id % 5 }}">
            <img src="{{ $featured->image_url }}" alt="Gambar {{ $featured->title }}">
            <div class="body">
                <span class="tag">Berita utama</span>
                <h2><a href="{{ route('articles.show', $featured) }}">{{ $featured->title }}</a></h2>
                <div class="byline">
                    <span class="avatar">{{ mb_strtoupper(mb_substr($featured->user->name, 0, 1)) }}</span>
                    <strong>{{ $featured->user->name }}</strong>
                    <span>{{ $featured->created_at->format('d M Y') }}</span>
                </div>
                <p class="muted">{{ \Illuminate\Support\Str::limit($featured->body, 200) }}</p>
                <div><a href="{{ route('articles.show', $featured) }}" class="btn btn-sm">Baca berita</a></div>
            </div>
        </article>

        @if ($articles->count() > 1)
            <section>
                <div class="section-title"><h3>Berita lainnya</h3></div>
                <div class="grid">
                    @foreach ($articles->slice(1) as $article)
                        <article class="news-card c{{ $article->id % 5 }}">
                            <img src="{{ $article->image_url }}" alt="Gambar {{ $article->title }}" loading="lazy">
                            <div class="body">
                                <h4><a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></h4>
                                <div class="byline">
                                    <span class="avatar">{{ mb_strtoupper(mb_substr($article->user->name, 0, 1)) }}</span>
                                    <strong>{{ $article->user->name }}</strong>
                                    <span>{{ $article->created_at->format('d M Y') }}</span>
                                </div>
                                <p class="muted small" style="margin:0;">
                                    {{ \Illuminate\Support\Str::limit($article->body, 110) }}
                                </p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif
    @else
        <section class="card empty">
            <h3>Belum ada berita</h3>
            <p class="muted">Berita yang dipublikasikan akan muncul di sini.</p>
            @auth
                <a href="{{ route('articles.create') }}" class="btn">Tulis berita pertama</a>
            @endauth
        </section>
    @endif
</div>
@endsection