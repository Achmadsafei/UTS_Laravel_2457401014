@extends('layouts.app')

@section('title', 'Halaman Detail Data')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Detail koleksi</p>
            <h1>{{ $book->title }}</h1>
            <p>Informasi lengkap buku dalam katalog perpustakaan.</p>
        </div>
        <div class="actions">
            <a class="btn btn-secondary" href="{{ route('books.index') }}">Kembali ke daftar</a>
            <a class="btn btn-primary" href="{{ route('books.edit', $book) }}">Ubah data</a>
        </div>
    </div>

    <section class="panel">
        <div class="panel-body">
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label">Judul buku</span>
                    <div class="detail-value">{{ $book->title }}</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Penulis</span>
                    <div class="detail-value">{{ $book->author }}</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Kategori</span>
                    <div class="detail-value"><span class="badge badge-orange">{{ $book->category }}</span></div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Tanggal terbit</span>
                    <div class="detail-value">{{ $book->published_at->format('d F Y') }}</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Stok</span>
                    <div class="detail-value">{{ $book->stock }} eksemplar</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Ketersediaan</span>
                    <div class="detail-value">
                        <span class="badge {{ $book->is_available ? '' : 'badge-muted' }}">{{ $book->is_available ? 'Tersedia untuk dipinjam' : 'Tidak tersedia' }}</span>
                    </div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">ISBN</span>
                    <div class="detail-value">{{ $book->isbn ?: '—' }}</div>
                </div>
                <div class="detail-item detail-item-full">
                    <span class="detail-label">Sinopsis</span>
                    <div class="detail-value detail-synopsis">{{ $book->synopsis ?: 'Belum ada sinopsis.' }}</div>
                </div>
            </div>
            <div class="form-actions">
                <a class="btn btn-secondary" href="{{ route('books.index') }}">Kembali ke daftar</a>
                <a class="btn btn-primary" href="{{ route('books.edit', $book) }}">Ubah data</a>
                <a class="btn btn-secondary" href="{{ route('books.confirm-delete', $book) }}">Hapus buku</a>
            </div>
        </div>
    </section>
@endsection
