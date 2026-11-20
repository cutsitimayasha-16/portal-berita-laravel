<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Portal Berita') - Portal Berita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f6f6fb;
            --surface: #ffffff;
            --ink: #1b1b3a;
            --muted: #62627f;
            --line: #e3e3f0;
            --navy: #1e1b4b;
            --brand: #4338ca;
            --brand-dark: #3730a3;
            --brand-soft: #e0e7ff;
            --coral: #e11d48;
            --amber: #f59e0b;
            --emerald: #059669;
            --sky: #0284c7;
            --danger: #be123c;
            --danger-soft: #ffe4e6;
            --ok: #047857;
            --ok-soft: #d1fae5;
            --radius: 14px;
            --font: 'Plus Jakarta Sans', system-ui, -apple-system, 'Segoe UI', sans-serif;
        }
        /* Warna bergilir untuk tiap artikel (dipakai lewat class c0..c4) */
        .c0 { --tone: #4338ca; --tone-soft: #e0e7ff; }
        .c1 { --tone: #e11d48; --tone-soft: #ffe4e6; }
        .c2 { --tone: #d97706; --tone-soft: #fef3c7; }
        .c3 { --tone: #059669; --tone-soft: #d1fae5; }
        .c4 { --tone: #0284c7; --tone-soft: #e0f2fe; }

        *, *::before, *::after { box-sizing: border-box; }
        html { -webkit-text-size-adjust: 100%; }
        body { margin: 0; background: var(--bg); color: var(--ink);
            font-family: var(--font); font-size: 16px; line-height: 1.65; }
        img { max-width: 100%; display: block; }
        a { color: var(--brand); text-decoration: none; }
        a:hover { text-decoration: underline; text-underline-offset: 3px; }
        :focus-visible { outline: 3px solid var(--amber); outline-offset: 2px; border-radius: 6px; }
        h1, h2, h3, h4 { line-height: 1.25; margin: 0 0 .5rem; font-weight: 800; letter-spacing: -.01em; }
        h1 { font-size: 2rem; } h2 { font-size: 1.5rem; } h3 { font-size: 1.2rem; } h4 { font-size: 1.05rem; }
        p { margin: 0 0 .75rem; }
        code { background: var(--brand-soft); color: var(--brand-dark); padding: .1rem .4rem;
            border-radius: 6px; font-size: .9em; }

        /* ---------- Layout ---------- */
        .wrap { max-width: 1080px; margin: 0 auto; padding: 0 1.25rem; }
        main.wrap { padding-top: 1.75rem; padding-bottom: 3rem; }
        .stack > * + * { margin-top: 1.75rem; }

        /* ---------- Navbar ---------- */
        .site-header { background: var(--navy); position: sticky; top: 0; z-index: 10; }
        .nav { display: flex; align-items: center; gap: .35rem; flex-wrap: wrap; min-height: 68px; }
        .brand { font-weight: 800; font-size: 1.3rem; color: #fff; margin-right: 1.25rem; }
        .brand:hover { text-decoration: none; }
        .brand span { color: var(--amber); }
        .nav a.link { color: #c9cbf5; font-weight: 600; padding: .45rem .9rem; border-radius: 99px; }
        .nav a.link:hover { background: rgba(255,255,255,.1); color: #fff; text-decoration: none; }
        .nav a.link.active { background: var(--amber); color: var(--navy); }
        .nav .right { margin-left: auto; display: flex; align-items: center; gap: .6rem; }
        .nav .who { color: #c9cbf5; font-size: .9rem; display: flex; align-items: center; gap: .5rem; }
        .inline { display: inline; margin: 0; }
        .site-header .btn-ghost { color: #fff; border-color: rgba(255,255,255,.4); }
        .site-header .btn-ghost:hover { background: rgba(255,255,255,.12); border-color: #fff; color: #fff; }

        /* ---------- Cards & text ---------- */
        .card { background: var(--surface); border: 1px solid var(--line); border-radius: var(--radius);
            padding: 1.5rem; }
        .muted { color: var(--muted); }
        .small { font-size: .875rem; }
        .page-head { display: flex; justify-content: space-between; align-items: flex-end;
            gap: 1rem; flex-wrap: wrap; margin-bottom: 1.25rem; }
        .page-head h1, .page-head h2 { margin: 0; }
        .page-head p { margin: .25rem 0 0; }
        .avatar { width: 28px; height: 28px; border-radius: 50%; background: var(--tone, var(--brand));
            color: #fff; font-size: .75rem; font-weight: 700; display: inline-grid; place-items: center;
            flex-shrink: 0; }
        .avatar.lg { width: 44px; height: 44px; font-size: 1rem; }
        .byline { display: flex; align-items: center; gap: .5rem; font-size: .85rem; color: var(--muted);
            margin-bottom: .6rem; flex-wrap: wrap; }
        .byline strong { color: var(--ink); font-weight: 600; }

        /* ---------- Buttons ---------- */
        button, .btn { display: inline-flex; align-items: center; justify-content: center; gap: .4rem;
            font: inherit; font-weight: 700; font-size: .95rem; cursor: pointer;
            padding: .6rem 1.15rem; border-radius: 99px; border: 2px solid var(--brand);
            background: var(--brand); color: #fff; line-height: 1.3; }
        button:hover, .btn:hover { background: var(--brand-dark); border-color: var(--brand-dark);
            color: #fff; text-decoration: none; }
        .btn-accent { background: var(--amber); border-color: var(--amber); color: var(--navy); }
        .btn-accent:hover { background: #d98a06; border-color: #d98a06; color: var(--navy); }
        .btn-ghost { background: transparent; color: var(--brand); border-color: var(--brand-soft); }
        .btn-ghost:hover { background: var(--brand-soft); border-color: var(--brand-soft); color: var(--brand-dark); }
        .btn-danger { background: transparent; color: var(--danger); border-color: #fecdd3; }
        .btn-danger:hover { background: var(--danger-soft); color: var(--danger); border-color: var(--danger); }
        .btn-sm { padding: .3rem .85rem; font-size: .85rem; }

        /* ---------- Alerts ---------- */
        .flash, .error { border-radius: 12px; padding: .8rem 1rem; margin-bottom: 1.25rem;
            border-left: 5px solid; font-weight: 500; }
        .flash { background: var(--ok-soft); border-color: var(--emerald); color: var(--ok); }
        .error { background: var(--danger-soft); border-color: var(--coral); color: #881337; }
        .error ul { margin: .4rem 0 0; padding-left: 1.2rem; font-weight: 400; }

        /* ---------- Forms ---------- */
        form label { display: block; margin: 1.1rem 0 .35rem; font-weight: 700; font-size: .95rem; }
        input[type=text], input[type=url], input[type=email], input[type=password], textarea {
            width: 100%; font: inherit; padding: .7rem .9rem; background: #fff; color: var(--ink);
            border: 2px solid var(--line); border-radius: 10px; }
        textarea { resize: vertical; min-height: 200px; }
        input:focus, textarea:focus { outline: none; border-color: var(--brand);
            box-shadow: 0 0 0 4px var(--brand-soft); }
        .hint { color: var(--muted); font-size: .85rem; margin: .35rem 0 0; }
        .form-actions { display: flex; gap: .75rem; align-items: center; margin-top: 1.5rem; }
        .form-narrow { max-width: 700px; }
        .form-card { border-top: 6px solid var(--brand); }
        .preview { width: 100%; max-width: 360px; aspect-ratio: 16/9; object-fit: cover;
            border-radius: 10px; border: 2px solid var(--line); margin-top: .6rem; }

        /* ---------- Hero ---------- */
        .hero { background: var(--navy); color: #fff; border-radius: 20px; padding: 2.5rem;
            position: relative; overflow: hidden; }
        .hero::before { content: ''; position: absolute; width: 220px; height: 220px; border-radius: 50%;
            background: var(--amber); right: -60px; top: -80px; }
        .hero::after { content: ''; position: absolute; width: 130px; height: 130px; border-radius: 50%;
            background: var(--coral); right: 110px; bottom: -70px; }
        .hero > * { position: relative; z-index: 1; }
        .hero h1 { font-size: 2.5rem; color: #fff; margin-bottom: .5rem; }
        .hero p { color: #d3d5ff; max-width: 52ch; font-size: 1.05rem; }
        .hero .actions { display: flex; gap: .6rem; flex-wrap: wrap; margin-top: 1.25rem; }
        .hero .btn-ghost { color: #fff; border-color: rgba(255,255,255,.45); }
        .hero .btn-ghost:hover { background: rgba(255,255,255,.14); border-color: #fff; color: #fff; }
        .hero.compact { padding: 1.75rem 2rem; }
        .hero.compact h1 { font-size: 2rem; margin-bottom: .25rem; }
        .hero.compact p { margin: 0; }

        /* ---------- Home ---------- */
        .featured { display: grid; grid-template-columns: 1.2fr 1fr; background: var(--surface);
            border: 1px solid var(--line); border-top: 6px solid var(--tone, var(--brand));
            border-radius: var(--radius); overflow: hidden; }
        .featured img { width: 100%; height: 100%; min-height: 280px; object-fit: cover; }
        .featured .body { padding: 1.75rem; display: flex; flex-direction: column; justify-content: center; }
        .featured h2 { font-size: 1.8rem; }
        .tag { display: inline-block; align-self: flex-start; font-size: .78rem; font-weight: 700;
            padding: .2rem .7rem; border-radius: 99px; background: var(--tone-soft, var(--brand-soft));
            color: var(--tone, var(--brand)); margin-bottom: .75rem; }
        .featured h2 a, .news-card h4 a, .row-item h4 a { color: var(--ink); }
        .featured h2 a:hover, .news-card h4 a:hover, .row-item h4 a:hover { color: var(--tone, var(--brand));
            text-decoration: none; }

        .grid { display: grid; gap: 1.25rem; grid-template-columns: repeat(auto-fill, minmax(290px, 1fr)); }
        .news-card { background: var(--surface); border: 1px solid var(--line);
            border-top: 6px solid var(--tone, var(--brand)); border-radius: var(--radius);
            overflow: hidden; display: flex; flex-direction: column; }
        .news-card img { width: 100%; aspect-ratio: 16/9; object-fit: cover; }
        .news-card .body { padding: 1.1rem 1.2rem 1.3rem; }
        .news-card h4 { margin-bottom: .4rem; }
        .meta { color: var(--muted); font-size: .85rem; margin-bottom: .5rem; }
        .section-title { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 1rem; }
        .section-title h2, .section-title h3 { margin: 0; padding-left: .75rem; border-left: 6px solid var(--amber); }

        /* ---------- Dashboard ---------- */
        .stats { display: grid; gap: 1.25rem; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); }
        .stat { color: #fff; border: 0; }
        .stat.s1 { background: var(--brand); }
        .stat.s2 { background: var(--coral); }
        .stat .num { font-size: 3rem; font-weight: 800; line-height: 1.1; }
        .stat .label { opacity: .92; font-weight: 500; }
        .quick { border-top: 6px solid var(--emerald); }
        .quick a { display: block; padding: .5rem 0; border-bottom: 1px solid var(--line); font-weight: 600; }
        .quick a:last-child { border-bottom: 0; }
        .info-list { display: grid; grid-template-columns: max-content 1fr; gap: .5rem 1.5rem; margin: 0; }
        .info-list dt { color: var(--muted); }
        .info-list dd { margin: 0; font-weight: 600; }

        /* ---------- List rows ---------- */
        .row-list { background: var(--surface); border: 1px solid var(--line); border-radius: var(--radius);
            overflow: hidden; }
        .row-item { display: flex; gap: 1rem; align-items: center; padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--line); border-left: 6px solid var(--tone, var(--brand)); }
        .row-item:last-child { border-bottom: 0; }
        .row-item:hover { background: var(--tone-soft, var(--brand-soft)); }
        .row-item img { width: 120px; height: 76px; object-fit: cover; border-radius: 10px; flex-shrink: 0; }
        .row-item .grow { flex: 1; min-width: 0; }
        .row-item h4 { margin: 0 0 .25rem; }
        .row-item .byline { margin: 0; }
        .row-actions { display: flex; gap: .5rem; align-items: center; flex-shrink: 0; }
        .badge { display: inline-block; font-size: .72rem; font-weight: 700; padding: .1rem .6rem;
            border-radius: 99px; background: var(--amber); color: var(--navy); margin-left: .5rem;
            vertical-align: middle; }
        .empty { text-align: center; padding: 3rem 1rem; }

        /* ---------- Article detail ---------- */
        .article { max-width: 740px; margin: 0 auto; }
        .article h1 { font-size: 2.4rem; }
        .article .cover { width: 100%; max-height: 400px; object-fit: cover; border-radius: 18px;
            margin: 1.25rem 0 1.5rem; }
        .author-box { display: flex; align-items: center; gap: .75rem; margin: 1rem 0; }
        .author-box .name { font-weight: 700; line-height: 1.2; }
        .author-box .date { color: var(--muted); font-size: .85rem; }
        .prose { font-size: 1.1rem; line-height: 1.8; max-width: 68ch; }
        .article-foot { display: flex; gap: .6rem; flex-wrap: wrap; margin-top: 2rem; padding-top: 1.25rem;
            border-top: 2px solid var(--line); }

        /* ---------- Pagination ---------- */
        .pagination { display: flex; flex-wrap: wrap; gap: .35rem; list-style: none; padding: 0;
            margin: 1.5rem 0 0; justify-content: center; }
        .pagination li a, .pagination li span { display: block; min-width: 2.5rem; text-align: center;
            padding: .4rem .75rem; border: 2px solid var(--line); border-radius: 99px;
            background: var(--surface); color: var(--ink); font-size: .9rem; font-weight: 600; }
        .pagination li a:hover { background: var(--brand-soft); border-color: var(--brand-soft); text-decoration: none; }
        .pagination li.active span { background: var(--brand); border-color: var(--brand); color: #fff; }
        .pagination li.disabled span { color: #a3a3bd; background: var(--bg); }

        footer.site-footer { background: var(--navy); color: #c9cbf5; font-size: .875rem; padding: 1.5rem 0; }

        /* ---------- Responsive ---------- */
        @media (max-width: 760px) {
            .hero { padding: 1.75rem; }
            .hero h1 { font-size: 1.9rem; }
            .featured { grid-template-columns: 1fr; }
            .featured img { min-height: 200px; }
            .row-item { flex-wrap: wrap; }
            .row-item img { width: 100%; height: 170px; }
            .row-actions { width: 100%; }
            .article h1 { font-size: 1.8rem; }
            .nav .who span.nm { display: none; }
        }
        @media (prefers-reduced-motion: reduce) { * { transition: none !important; } }
    </style>
</head>
<body>
    @include('partials.nav')

    <main class="wrap">
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="wrap">Portal Berita &middot; Praktikum Pemrograman Web, UIN Ar-Raniry Banda Aceh</div>
    </footer>
</body>
</html>