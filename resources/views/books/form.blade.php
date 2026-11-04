@extends('layouts.app')

@php
    $isEdit = $book->exists;
    $pageTitle = $isEdit ? 'Form Ubah Data' : 'Form Tambah Data';
@endphp

@section('title', $pageTitle)

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Katalog perpustakaan</p>
            <h1>{{ $isEdit ? 'Ubah data buku' : 'Tambah buku baru' }}</h1>
            <p>{{ $isEdit ? 'Perbarui informasi buku dalam koleksi.' : 'Lengkapi detail buku untuk menambahkannya ke koleksi.' }}</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="notice notice-error" role="alert">
            Periksa kembali isian yang ditandai. Ada {{ $errors->count() }} kesalahan pada formulir.
        </div>
    @endif

    <section class="panel">
        <div class="panel-body">
            <form action="{{ $isEdit ? route('books.update', $book) : route('books.store') }}" method="POST">
                @csrf
                @if ($isEdit)
                    @method('PUT')
                @endif

                <div class="form-grid">
                    <div class="field">
                        <label for="title">Judul buku <span class="required">*</span></label>
                        <input class="control {{ $errors->has('title') ? 'is-invalid' : '' }}" id="title" name="title" type="text" value="{{ old('title', $book->title) }}" required maxlength="255" placeholder="Contoh: Laskar Pelangi" aria-invalid="{{ $errors->has('title') ? 'true' : 'false' }}">
                        @error('title') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="field">
                        <label for="author">Penulis <span class="required">*</span></label>
                        <input class="control {{ $errors->has('author') ? 'is-invalid' : '' }}" id="author" name="author" type="text" value="{{ old('author', $book->author) }}" required maxlength="255" placeholder="Nama penulis" aria-invalid="{{ $errors->has('author') ? 'true' : 'false' }}">
                        @error('author') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="field">
                        <label for="category">Kategori <span class="required">*</span></label>
                        <select class="control {{ $errors->has('category') ? 'is-invalid' : '' }}" id="category" name="category" required aria-invalid="{{ $errors->has('category') ? 'true' : 'false' }}">
                            <option value="">Pilih kategori</option>
                            @foreach (\App\Models\Book::CATEGORIES as $category)
                                <option value="{{ $category }}" @selected(old('category', $book->category) === $category)>{{ $category }}</option>
                            @endforeach
                        </select>
                        @error('category') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="field">
                        <label for="published_at">Tanggal terbit <span class="required">*</span></label>
                        <input class="control {{ $errors->has('published_at') ? 'is-invalid' : '' }}" id="published_at" name="published_at" type="date" value="{{ old('published_at', $book->published_at?->format('Y-m-d')) }}" required aria-invalid="{{ $errors->has('published_at') ? 'true' : 'false' }}">
                        @error('published_at') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="field">
                        <label for="stock">Stok <span class="required">*</span></label>
                        <input class="control {{ $errors->has('stock') ? 'is-invalid' : '' }}" id="stock" name="stock" type="number" value="{{ old('stock', $book->stock) }}" required min="0" step="1" placeholder="0" aria-invalid="{{ $errors->has('stock') ? 'true' : 'false' }}">
                        @error('stock') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="field">
                        <span class="field-label">Ketersediaan <span class="required">*</span></span>
                        <div class="checkbox-wrap">
                            <input type="hidden" name="is_available" value="0">
                            <input id="is_available" name="is_available" type="checkbox" value="1" @checked((bool) old('is_available', $book->is_available))>
                            <label for="is_available">Buku tersedia untuk dipinjam</label>
                        </div>
                        @error('is_available') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="field field-full">
                        <label for="isbn">ISBN <span class="muted">(opsional)</span></label>
                        <input class="control {{ $errors->has('isbn') ? 'is-invalid' : '' }}" id="isbn" name="isbn" type="text" value="{{ old('isbn', $book->isbn) }}" maxlength="255" placeholder="Contoh: 978-602-1234-56-7" aria-invalid="{{ $errors->has('isbn') ? 'true' : 'false' }}">
                        @error('isbn') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="field field-full">
                        <label for="synopsis">Sinopsis <span class="muted">(opsional)</span></label>
                        <textarea class="control {{ $errors->has('synopsis') ? 'is-invalid' : '' }}" id="synopsis" name="synopsis" rows="4" placeholder="Ceritakan sedikit tentang buku ini..." aria-invalid="{{ $errors->has('synopsis') ? 'true' : 'false' }}">{{ old('synopsis', $book->synopsis) }}</textarea>
                        @error('synopsis') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <button class="btn btn-primary" type="submit">{{ $isEdit ? 'Simpan perubahan' : 'Simpan buku' }}</button>
                    <a class="btn btn-secondary" href="{{ $isEdit ? route('books.show', $book) : route('books.index') }}">Batal</a>
                </div>
            </form>
        </div>
    </section>
@endsection
