<header class="site-header">
    <nav class="wrap nav" aria-label="Navigasi utama">
        <a href="{{ route('home') }}" class="brand">Portal<span>Berita</span></a>

        <a href="{{ route('home') }}"
           class="link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>

        @auth
            <a href="{{ route('dashboard') }}"
               class="link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('articles.index') }}"
               class="link {{ request()->routeIs('articles.*') ? 'active' : '' }}">Artikel</a>

            <div class="right">
                <span class="who">
                    <span class="avatar">{{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}</span>
                    <span class="nm">{{ auth()->user()->name }}</span>
                </span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="btn-ghost btn-sm">Keluar</button>
                </form>
            </div>
        @endauth

        @guest
            <div class="right">
                <a href="{{ route('login') }}"
                   class="link {{ request()->routeIs('login') ? 'active' : '' }}">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-accent btn-sm">Daftar</a>
            </div>
        @endguest
    </nav>
</header>