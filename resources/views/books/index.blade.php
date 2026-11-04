@extends('layouts.app')

@section('title', 'Halaman Daftar Data')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Katalog perpustakaan</p>
            <h1>Daftar Buku</h1>
            <p>Kelola koleksi dan temukan buku yang ingin kamu baca.</p>
        </div>
        <a class="btn btn-primary" href="{{ route('books.create') }}"><span aria-hidden="true">＋</span> Tambah buku</a>
    </div>

    @if (session('success'))
        <div class="notice" role="status">{{ session('success') }}</div>
    @endif

    <section class="panel" aria-label="Tabel daftar buku">
        @if ($books->isEmpty())
            <div class="empty-state">
                <div class="empty-icon" aria-hidden="true">⌕</div>
                <h2>Belum ada data</h2>
                <p>Koleksi masih kosong. Tambahkan buku pertama ke perpustakaan.</p>
                <a class="btn btn-primary" href="{{ route('books.create') }}">Tambah buku pertama</a>
            </div>
        @else
            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>Buku</th>
                            <th>Kategori</th>
                            <th>Tanggal terbit</th>
                            <th>Stok</th>
                            <th>Ketersediaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>
                                    <div class="book-title">{{ $book->title }}</div>
                                    <div class="book-author">{{ $book->author }}</div>
                                </td>
                                <td><span class="badge badge-orange">{{ $book->category }}</span></td>
                                <td>{{ $book->published_at->format('d M Y') }}</td>
                                <td>{{ $book->stock }} eksemplar</td>
                                <td>
                                    <span class="badge {{ $book->is_available ? '' : 'badge-muted' }}">
                                        {{ $book->is_available ? 'Tersedia' : 'Tidak tersedia' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a class="btn btn-secondary btn-small" href="{{ route('books.show', $book) }}">Detail</a>
                                        <a class="btn btn-secondary btn-small" href="{{ route('books.edit', $book) }}">Ubah</a>
                                        <a class="btn btn-secondary btn-small" href="{{ route('books.confirm-delete', $book) }}">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>
@endsection
