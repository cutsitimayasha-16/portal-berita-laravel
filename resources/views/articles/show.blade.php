@extends('layouts.app')

@section('title', $article->title)

@section('content')
<article class="article c{{ $article->id % 5 }}">
    <h1>{{ $article->title }}</h1>

    <div class="author-box">
        <span class="avatar lg">{{ mb_strtoupper(mb_substr($article->user->name, 0, 1)) }}</span>
        <div>
            <div class="name">{{ $article->user->name }}</div>
            <div class="date">Dipublikasikan {{ $article->created_at->format('d M Y') }}</div>
        </div>
    </div>

    <img class="cover" src="{{ $article->image_url }}" alt="Gambar untuk {{ $article->title }}">

    <div class="prose">
        {!! nl2br(e($article->body)) !!}
    </div>

    <div class="article-foot">
        <a href="{{ route('home') }}" class="btn btn-ghost btn-sm">Kembali ke beranda</a>
        <a href="{{ route('articles.index') }}" class="btn btn-ghost btn-sm">Semua artikel</a>
        @auth
            @if ($article->user_id === auth()->id())
                <a href="{{ route('articles.edit', $article) }}" class="btn btn-accent btn-sm">Edit artikel</a>
            @endif
        @endauth
    </div>
</article>
@endsection