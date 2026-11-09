@extends('layouts.app')

@section('title', 'Halaman Beranda')

@section('content')
    <section class="hero">
        <div class="hero-copy">
            <p class="eyebrow">Halaman Beranda · Kos Achmad Safei</p>
            <h1>Tempat nyaman untuk pulang dan beristirahat.</h1>
            <p>Pilih kamar yang sesuai kebutuhanmu, dengan fasilitas lengkap dan suasana kos yang hangat.</p>
            <a class="btn btn-primary" href="{{ route('rooms.index') }}">Lihat daftar kamar <span aria-hidden="true">→</span></a>
        </div>
        <div class="hero-art" aria-hidden="true">
            <div class="room-illustration">
                <div class="room-window"></div>
                <div class="room-bed"><span></span></div>
                <div class="room-plant"></div>
            </div>
        </div>
    </section>

    <section class="stats" aria-label="Ringkasan kamar kos">
        <div class="stat-card">
            <span class="stat-label">Jumlah kamar</span>
            <span class="stat-value">{{ $roomCount }} kamar</span>
        </div>
        <div class="stat-card">
            <span class="stat-label">Kamar tersedia</span>
            <span class="stat-value">{{ $availableCount }} kamar</span>
        </div>
        <div class="stat-card">
            <span class="stat-label">Pilihan tipe</span>
            <span class="stat-value">3 tipe kamar</span>
        </div>
    </section>
@endsection
