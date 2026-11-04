<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Perpustakaan Senandika') · {{ config('app.name', 'Senandika') }}</title>
    <style>
        :root {
            color-scheme: light;
            --ink: #22352d;
            --muted: #78847b;
            --paper: #f7f5ef;
            --surface: #fffefa;
            --line: #e8e5dc;
            --green: #355b48;
            --green-dark: #284638;
            --green-soft: #edf3ee;
            --orange: #c97745;
            --orange-soft: #fbf0e8;
            --red: #a7443e;
            --red-soft: #fbefed;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-synthesis: none;
            text-rendering: optimizeLegibility;
        }
        * { box-sizing: border-box; }
        body { margin: 0; background: var(--paper); color: var(--ink); font-size: 15px; line-height: 1.6; }
        a { color: inherit; text-decoration: none; }
        button, input, select, textarea { font: inherit; }
        .site-header { background: var(--surface); border-bottom: 1px solid var(--line); }
        .nav-wrap, .page-wrap, .footer-wrap { width: min(1120px, calc(100% - 40px)); margin: 0 auto; }
        .nav-wrap { min-height: 76px; display: flex; align-items: center; justify-content: space-between; gap: 24px; }
        .brand { display: flex; align-items: center; gap: 12px; font-family: Georgia, "Times New Roman", serif; font-size: 21px; font-weight: 700; letter-spacing: -.3px; }
        .brand-mark { width: 38px; height: 38px; display: grid; place-items: center; border-radius: 12px; background: var(--green); color: white; font-family: ui-sans-serif, sans-serif; font-size: 19px; }
        .nav-links { display: flex; align-items: center; gap: 8px; }
        .nav-link { padding: 9px 13px; border-radius: 8px; color: var(--muted); font-weight: 600; }
        .nav-link:hover, .nav-link.active { background: var(--green-soft); color: var(--green); }
        .page-wrap { min-height: calc(100vh - 151px); padding: 46px 0 64px; }
        .eyebrow { margin: 0 0 7px; color: var(--orange); font-size: 12px; font-weight: 800; letter-spacing: 1.6px; text-transform: uppercase; }
        h1, h2, h3, p { margin-top: 0; }
        h1, h2, h3 { font-family: Georgia, "Times New Roman", serif; line-height: 1.2; }
        h1 { margin-bottom: 10px; font-size: clamp(30px, 4vw, 42px); letter-spacing: -.7px; }
        h2 { font-size: 25px; }
        .page-heading { display: flex; align-items: end; justify-content: space-between; gap: 20px; margin-bottom: 27px; }
        .page-heading p, .muted { color: var(--muted); }
        .page-heading p { margin: 0; }
        .btn { display: inline-flex; min-height: 42px; align-items: center; justify-content: center; gap: 8px; padding: 9px 16px; border: 1px solid transparent; border-radius: 9px; cursor: pointer; font-weight: 700; transition: background .15s, transform .15s; }
        .btn:hover { transform: translateY(-1px); }
        .btn-primary { background: var(--green); color: white; }
        .btn-primary:hover { background: var(--green-dark); }
        .btn-secondary { background: var(--surface); border-color: var(--line); color: var(--ink); }
        .btn-secondary:hover { background: #f4f2eb; }
        .btn-danger { background: var(--red); color: white; }
        .btn-danger:hover { background: #8d3934; }
        .btn-small { min-height: 34px; padding: 6px 10px; border-radius: 7px; font-size: 13px; }
        .panel { overflow: hidden; border: 1px solid var(--line); border-radius: 15px; background: var(--surface); box-shadow: 0 8px 24px rgb(34 53 45 / 4%); }
        .panel-body { padding: 27px; }
        .notice { margin-bottom: 20px; padding: 13px 16px; border: 1px solid #cce0d0; border-radius: 10px; background: #eff7f0; color: #2f6744; font-weight: 650; }
        .notice-error { border-color: #efc9c5; background: var(--red-soft); color: var(--red); }
        .table-scroll { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th { padding: 14px 18px; background: #f5f4ee; color: #68746b; font-size: 11px; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; white-space: nowrap; }
        td { padding: 16px 18px; border-top: 1px solid #efede6; vertical-align: middle; }
        tbody tr:hover { background: #fcfbf7; }
        .book-title { font-weight: 750; }
        .book-author { color: var(--muted); font-size: 13px; }
        .badge { display: inline-flex; align-items: center; gap: 6px; padding: 4px 9px; border-radius: 99px; background: var(--green-soft); color: var(--green); font-size: 12px; font-weight: 750; white-space: nowrap; }
        .badge-muted { background: #f1f0eb; color: #68746b; }
        .badge-orange { background: var(--orange-soft); color: #9c542b; }
        .actions { display: flex; flex-wrap: wrap; gap: 6px; }
        .empty-state { padding: 58px 24px; text-align: center; }
        .empty-icon { width: 58px; height: 58px; display: grid; place-items: center; margin: 0 auto 15px; border-radius: 18px; background: var(--green-soft); color: var(--green); font-size: 27px; }
        .empty-state h2 { margin-bottom: 8px; }
        .empty-state p { margin-bottom: 20px; color: var(--muted); }
        .hero { position: relative; overflow: hidden; display: grid; grid-template-columns: 1.2fr .8fr; align-items: center; gap: 40px; padding: clamp(32px, 6vw, 66px); border-radius: 22px; background: var(--green); color: white; }
        .hero:after { position: absolute; right: -80px; bottom: -180px; width: 430px; height: 430px; border: 1px solid rgb(255 255 255 / 12%); border-radius: 50%; content: ""; box-shadow: 0 0 0 42px rgb(255 255 255 / 4%), 0 0 0 84px rgb(255 255 255 / 3%); }
        .hero-copy, .hero-art { position: relative; z-index: 1; }
        .hero .eyebrow { color: #efb58c; }
        .hero h1 { max-width: 580px; margin-bottom: 16px; font-size: clamp(38px, 6vw, 58px); }
        .hero p { max-width: 520px; margin-bottom: 25px; color: #d7e3da; font-size: 17px; }
        .hero .btn-primary { background: #fffefa; color: var(--green); }
        .hero .btn-primary:hover { background: #f0eee6; }
        .hero-art { display: flex; min-height: 230px; align-items: center; justify-content: center; }
        .book-stack { position: relative; width: 220px; height: 200px; transform: rotate(-7deg); }
        .book { position: absolute; width: 166px; height: 205px; padding: 22px 18px; border: 1px solid rgb(255 255 255 / 30%); border-radius: 7px 13px 13px 7px; box-shadow: 8px 14px 25px rgb(10 25 17 / 23%); }
        .book:before { position: absolute; top: 0; bottom: 0; left: 12px; border-left: 1px solid rgb(255 255 255 / 30%); content: ""; }
        .book-one { top: 8px; left: 4px; background: #cb8051; transform: rotate(-10deg); }
        .book-two { top: -1px; left: 45px; background: #d8c28c; color: #38503f; transform: rotate(7deg); }
        .book-three { top: 18px; left: 78px; background: #78907a; transform: rotate(15deg); }
        .book-lines { width: 68px; height: 50px; margin: 35px auto 0; border-top: 2px solid rgb(255 255 255 / 75%); border-bottom: 2px solid rgb(255 255 255 / 75%); opacity: .8; }
        .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; margin-top: 20px; }
        .stat-card { padding: 20px 22px; border: 1px solid var(--line); border-radius: 13px; background: var(--surface); }
        .stat-label { display: block; margin-bottom: 3px; color: var(--muted); font-size: 13px; }
        .stat-value { font-family: Georgia, "Times New Roman", serif; font-size: 27px; font-weight: 700; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 19px 22px; }
        .field { min-width: 0; }
        .field-full { grid-column: 1 / -1; }
        .field label, .field-label { display: block; margin-bottom: 7px; font-size: 13px; font-weight: 750; }
        .required { color: var(--orange); }
        .control { width: 100%; min-height: 45px; padding: 10px 12px; border: 1px solid #dcded6; border-radius: 8px; outline: none; background: #fff; color: var(--ink); }
        textarea.control { min-height: 112px; resize: vertical; }
        .control:focus { border-color: #789681; box-shadow: 0 0 0 3px rgb(83 126 98 / 12%); }
        .control.is-invalid { border-color: #cb736c; }
        .field-error { margin: 5px 0 0; color: var(--red); font-size: 12px; }
        .field-help { margin: 5px 0 0; color: var(--muted); font-size: 12px; }
        .checkbox-wrap { display: flex; min-height: 45px; align-items: center; gap: 10px; }
        .checkbox-wrap input { width: 18px; height: 18px; accent-color: var(--green); }
        .form-actions { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 25px; padding-top: 21px; border-top: 1px solid var(--line); }
        .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0 26px; }
        .detail-item { padding: 16px 0; border-bottom: 1px solid #efede6; }
        .detail-item-full { grid-column: 1 / -1; }
        .detail-label { display: block; margin-bottom: 5px; color: var(--muted); font-size: 12px; font-weight: 800; letter-spacing: .7px; text-transform: uppercase; }
        .detail-value { overflow-wrap: anywhere; font-weight: 600; }
        .detail-synopsis { white-space: pre-line; font-weight: 400; }
        .confirm-icon { width: 54px; height: 54px; display: grid; place-items: center; margin-bottom: 18px; border-radius: 16px; background: var(--red-soft); color: var(--red); font-size: 24px; }
        .confirm-copy { max-width: 680px; color: var(--muted); }
        .site-footer { border-top: 1px solid var(--line); background: var(--surface); }
        .footer-wrap { display: flex; min-height: 74px; align-items: center; justify-content: space-between; gap: 12px; color: var(--muted); font-size: 13px; }
        .footer-name { color: var(--ink); font-weight: 700; }
        @media (max-width: 760px) {
            .nav-wrap, .page-wrap, .footer-wrap { width: min(100% - 28px, 1120px); }
            .nav-wrap { min-height: 68px; }
            .brand { font-size: 18px; }
            .nav-link { padding: 8px 9px; font-size: 13px; }
            .page-wrap { padding: 32px 0 44px; }
            .page-heading { align-items: start; flex-direction: column; }
            .hero { grid-template-columns: 1fr; gap: 14px; }
            .hero-art { min-height: 185px; }
            .stats { grid-template-columns: 1fr; gap: 10px; }
            .stat-card { padding: 15px 18px; }
            .stat-value { font-size: 23px; }
            .form-grid, .detail-grid { grid-template-columns: 1fr; }
            .field-full, .detail-item-full { grid-column: auto; }
            .panel-body { padding: 21px; }
            .footer-wrap { align-items: flex-start; flex-direction: column; justify-content: center; padding: 15px 0; }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="nav-wrap">
            <a class="brand" href="{{ route('home') }}">
                <span class="brand-mark" aria-hidden="true">B</span>
                <span>Senandika <span class="muted">/ Perpustakaan</span></span>
            </a>
            <nav class="nav-links" aria-label="Navigasi utama">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                <a class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}" href="{{ route('books.index') }}">Koleksi Buku</a>
            </nav>
        </div>
    </header>

    <main class="page-wrap">
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="footer-wrap">
            <span>© {{ date('Y') }} Senandika · Ruang untuk setiap cerita.</span>
            <span class="footer-name">{{ config('student.name') }} <span class="muted">· NIM {{ config('student.nim') }}</span></span>
        </div>
    </footer>
</body>
</html>
