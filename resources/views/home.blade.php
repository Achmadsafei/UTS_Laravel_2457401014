@extends('layouts.app')

@section('title', 'Halaman Beranda')

@section('content')
    <section class="hero">
        <div class="hero-copy">
            <p class="eyebrow">Perpustakaan Achmad safei</p>
            <h1>Temukan cerita yang terasa seperti rumah.</h1>
            <p>Jelajahi koleksi buku pilihan, dari kisah yang menghangatkan hingga wawasan yang membuka cakrawala.</p>
            <a class="btn btn-primary" href="{{ route('books.index') }}">Jelajahi koleksi <span aria-hidden="true">→</span></a>
        </div>
        <div class="hero-art" aria-hidden="true">
            <div class="book-stack">
                <div class="book book-one"><div class="book-lines"></div></div>
                <div class="book book-two"><div class="book-lines"></div></div>
                <div class="book book-three"><div class="book-lines"></div></div>
            </div>
        </div>
    </section>

    <section class="stats" aria-label="Ringkasan koleksi">
        <div class="stat-card">
            <span class="stat-label">Judul dalam koleksi</span>
            <span class="stat-value">{{ $bookCount }} buku</span>
        </div>
        <div class="stat-card">
            <span class="stat-label">Siap dipinjam</span>
            <span class="stat-value">{{ $availableCount }} buku</span>
        </div>
        <div class="stat-card">
            <span class="stat-label">Kategori pilihan</span>
            <span class="stat-value">3 kategori</span>
        </div>
    </section>
@endsection
