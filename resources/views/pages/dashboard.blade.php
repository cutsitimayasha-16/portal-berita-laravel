@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="stack">
    <section class="hero compact">
        <h1>Halo, {{ $user->name }}!</h1>
        <p>Ini ringkasan aktivitas artikel di aplikasi kamu.</p>
        <div class="actions">
            <a href="{{ route('articles.create') }}" class="btn btn-accent">Tulis artikel</a>
        </div>
    </section>

    <section class="stats">
        <div class="card stat s1">
            <div class="num">{{ $totalArticles }}</div>
            <div class="label">Total artikel di sistem</div>
        </div>
        <div class="card stat s2">
            <div class="num">{{ $myArticles }}</div>
            <div class="label">Artikel milikmu</div>
        </div>
        <div class="card quick">
            <h3>Aksi cepat</h3>
            <a href="{{ route('articles.create') }}">Tambah artikel baru</a>
            <a href="{{ route('articles.index') }}">Kelola semua artikel</a>
            <a href="{{ route('home') }}">Lihat halaman beranda</a>
        </div>
    </section>

    <section>
        <div class="section-title">
            <h3>Artikel terbaru</h3>
            <a href="{{ route('articles.index') }}" class="small">Lihat semua</a>
        </div>

        @if ($latestArticles->isNotEmpty())
            <div class="row-list">
                @foreach ($latestArticles as $article)
                    <div class="row-item c{{ $article->id % 5 }}">
                        <img src="{{ $article->image_url }}" alt="Thumbnail {{ $article->title }}" loading="lazy">
                        <div class="grow">
                            <h4><a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></h4>
                            <div class="byline">
                                <span class="avatar">{{ mb_strtoupper(mb_substr($article->user->name, 0, 1)) }}</span>
                                <strong>{{ $article->user->name }}</strong>
                                <span>{{ $article->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="card empty muted">Belum ada artikel yang bisa ditampilkan.</div>
        @endif
    </section>

    <section class="card">
        <h3>Info akun</h3>
        <dl class="info-list">
            <dt>Nama</dt><dd>{{ $user->name }}</dd>
            <dt>Email</dt><dd>{{ $user->email }}</dd>
        </dl>
    </section>
</div>
@endsection