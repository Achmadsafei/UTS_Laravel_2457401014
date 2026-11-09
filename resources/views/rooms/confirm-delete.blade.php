@extends('layouts.app')

@section('title', 'Konfirmasi Sebelum Menghapus Data')

@section('content')
    <p class="eyebrow">Kos Achmad Safei</p>
    <section class="panel">
        <div class="panel-body">
            <div class="confirm-icon" aria-hidden="true">!</div>
            <h1>Konfirmasi Sebelum Menghapus Data</h1>
            <p class="confirm-copy">
                Kamu akan menghapus kamar <strong>{{ $room->room_number }}</strong> ({{ $room->room_type }}) dari daftar kos.
                Tindakan ini tidak dapat dibatalkan.
            </p>
            <div class="form-actions">
                <form action="{{ route('rooms.destroy', $room) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Ya, hapus kamar</button>
                </form>
                <a class="btn btn-secondary" href="{{ route('rooms.show', $room) }}">Batalkan</a>
            </div>
        </div>
    </section>
@endsection
