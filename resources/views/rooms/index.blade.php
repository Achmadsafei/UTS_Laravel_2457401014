@extends('layouts.app')

@php
    $successMessage = session('success');
    $pageTitle = match ($successMessage) {
        'Data kamar berhasil ditambahkan.' => 'Halaman Daftar Data dengan Pesan Sukses Setelah Menambah Data',
        'Data kamar berhasil dihapus.' => 'Halaman Daftar Data dengan Pesan Sukses Setelah Menghapus Data',
        default => 'Halaman Daftar Data',
    };
@endphp

@section('title', $pageTitle)

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Kos Achmad Safei</p>
            <h1>{{ $pageTitle }}</h1>
            <p>Kelola informasi kamar, fasilitas, dan ketersediaan kos.</p>
        </div>
        <a class="btn btn-primary" href="{{ route('rooms.create') }}"><span aria-hidden="true">＋</span> Tambah kamar</a>
    </div>

    @if ($successMessage)
        <div class="notice" role="status">{{ $successMessage }}</div>
    @endif

    <section class="panel" aria-label="Tabel daftar kamar">
        @if ($rooms->isEmpty())
            <div class="empty-state">
                <div class="empty-icon" aria-hidden="true">⌕</div>
                <h2>Belum ada data</h2>
                <p>Belum ada kamar yang tercatat. Tambahkan kamar pertama ke daftar kos.</p>
                <a class="btn btn-primary" href="{{ route('rooms.create') }}">Tambah kamar pertama</a>
            </div>
        @else
            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>Nomor kamar</th>
                            <th>Tipe</th>
                            <th>Lantai</th>
                            <th>Harga / bulan</th>
                            <th>Kapasitas</th>
                            <th>Ketersediaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $room)
                            <tr>
                                <td>
                                    <div class="room-title">{{ $room->room_number }}</div>
                                    <div class="room-meta">{{ $room->facilities }}</div>
                                </td>
                                <td><span class="badge badge-orange">{{ $room->room_type }}</span></td>
                                <td>Lantai {{ $room->floor }}</td>
                                <td>Rp{{ number_format($room->monthly_price, 0, ',', '.') }}</td>
                                <td>{{ $room->capacity }} orang</td>
                                <td>
                                    <span class="badge {{ $room->is_available ? '' : 'badge-muted' }}">
                                        {{ $room->is_available ? 'Tersedia' : 'Terisi' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a class="btn btn-secondary btn-small" href="{{ route('rooms.show', $room) }}">Detail</a>
                                        <a class="btn btn-secondary btn-small" href="{{ route('rooms.edit', $room) }}">Ubah</a>
                                        <a class="btn btn-secondary btn-small" href="{{ route('rooms.confirm-delete', $room) }}">Hapus</a>
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
