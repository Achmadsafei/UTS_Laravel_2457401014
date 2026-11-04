@extends('layouts.app')

@section('title', 'Konfirmasi Hapus Data')

@section('content')
    <p class="eyebrow">Konfirmasi tindakan</p>
    <section class="panel">
        <div class="panel-body">
            <div class="confirm-icon" aria-hidden="true">!</div>
            <h1>Hapus buku ini?</h1>
            <p class="confirm-copy">
                Kamu akan menghapus <strong>{{ $book->title }}</strong> karya {{ $book->author }} dari koleksi.
                Tindakan ini tidak dapat dibatalkan.
            </p>
            <div class="form-actions">
                <form action="{{ route('books.destroy', $book) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Ya, hapus buku</button>
                </form>
                <a class="btn btn-secondary" href="{{ route('books.show', $book) }}">Batalkan</a>
            </div>
        </div>
    </section>
@endsection
