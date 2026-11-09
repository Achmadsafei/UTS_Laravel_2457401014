@extends('layouts.app')

@section('title', 'Halaman Detail Data')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Kos Achmad Safei</p>
            <h1>Halaman Detail Data</h1>
            <p>Informasi lengkap kamar {{ $room->room_number }}.</p>
        </div>
        <div class="actions">
            <a class="btn btn-secondary" href="{{ route('rooms.index') }}">Kembali ke daftar</a>
            <a class="btn btn-primary" href="{{ route('rooms.edit', $room) }}">Ubah data</a>
        </div>
    </div>

    <section class="panel">
        <div class="panel-body">
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="detail-label">Nomor kamar</span>
                    <div class="detail-value">{{ $room->room_number }}</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Tipe kamar</span>
                    <div class="detail-value"><span class="badge badge-orange">{{ $room->room_type }}</span></div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Lantai</span>
                    <div class="detail-value">Lantai {{ $room->floor }}</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Harga per bulan</span>
                    <div class="detail-value">Rp{{ number_format($room->monthly_price, 0, ',', '.') }}</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Kapasitas</span>
                    <div class="detail-value">{{ $room->capacity }} orang</div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Status kamar</span>
                    <div class="detail-value">
                        <span class="badge {{ $room->is_available ? '' : 'badge-muted' }}">{{ $room->is_available ? 'Tersedia untuk disewa' : 'Terisi' }}</span>
                    </div>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Fasilitas</span>
                    <div class="detail-value">{{ $room->facilities }}</div>
                </div>
                <div class="detail-item detail-item-full">
                    <span class="detail-label">Deskripsi</span>
                    <div class="detail-value detail-synopsis">{{ $room->description ?: 'Belum ada deskripsi tambahan.' }}</div>
                </div>
            </div>
            <div class="form-actions">
                <a class="btn btn-secondary" href="{{ route('rooms.index') }}">Kembali ke daftar</a>
                <a class="btn btn-primary" href="{{ route('rooms.edit', $room) }}">Ubah data</a>
                <a class="btn btn-secondary" href="{{ route('rooms.confirm-delete', $room) }}">Hapus kamar</a>
            </div>
        </div>
    </section>
@endsection
