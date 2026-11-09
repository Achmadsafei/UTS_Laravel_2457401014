@extends('layouts.app')

@php
    $isEdit = $room->exists;
    $pageTitle = $isEdit
        ? 'Form Ubah Data dengan Data Lama'
        : ($errors->any() ? 'Form Tambah Data dengan Pesan Error Validasi' : 'Form Tambah Data Kosong');
@endphp

@section('title', $pageTitle)

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Kos Achmad Safei</p>
            <h1>{{ $pageTitle }}</h1>
            <p>{{ $isEdit ? 'Perbarui informasi kamar yang sudah terdaftar.' : 'Lengkapi detail kamar untuk menambahkannya ke daftar kos.' }}</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="notice notice-error" role="alert">
            Periksa kembali isian yang ditandai. Ada {{ $errors->count() }} kesalahan validasi.
        </div>
    @endif

    <section class="panel">
        <div class="panel-body">
            <form action="{{ $isEdit ? route('rooms.update', $room) : route('rooms.store') }}" method="POST">
                @csrf
                @if ($isEdit)
                    @method('PUT')
                @endif

                <div class="form-grid">
                    <div class="field">
                        <label for="room_number">Nomor kamar <span class="required">*</span></label>
                        <input class="control {{ $errors->has('room_number') ? 'is-invalid' : '' }}" id="room_number" name="room_number" type="text" value="{{ old('room_number', $room->room_number) }}" required maxlength="20" placeholder="Contoh: A01" aria-invalid="{{ $errors->has('room_number') ? 'true' : 'false' }}">
                        @error('room_number') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="field">
                        <label for="room_type">Tipe kamar <span class="required">*</span></label>
                        <select class="control {{ $errors->has('room_type') ? 'is-invalid' : '' }}" id="room_type" name="room_type" required aria-invalid="{{ $errors->has('room_type') ? 'true' : 'false' }}">
                            <option value="">Pilih tipe kamar</option>
                            @foreach (\App\Models\Room::TYPES as $type)
                                <option value="{{ $type }}" @selected(old('room_type', $room->room_type) === $type)>{{ $type }}</option>
                            @endforeach
                        </select>
                        @error('room_type') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="field">
                        <label for="floor">Lantai <span class="required">*</span></label>
                        <input class="control {{ $errors->has('floor') ? 'is-invalid' : '' }}" id="floor" name="floor" type="number" value="{{ old('floor', $room->floor) }}" required min="1" max="100" step="1" placeholder="1" aria-invalid="{{ $errors->has('floor') ? 'true' : 'false' }}">
                        @error('floor') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="field">
                        <label for="monthly_price">Harga per bulan (Rp) <span class="required">*</span></label>
                        <input class="control {{ $errors->has('monthly_price') ? 'is-invalid' : '' }}" id="monthly_price" name="monthly_price" type="number" value="{{ old('monthly_price', $room->monthly_price) }}" required min="0" step="1000" placeholder="650000" aria-invalid="{{ $errors->has('monthly_price') ? 'true' : 'false' }}">
                        @error('monthly_price') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="field">
                        <label for="capacity">Kapasitas penghuni <span class="required">*</span></label>
                        <input class="control {{ $errors->has('capacity') ? 'is-invalid' : '' }}" id="capacity" name="capacity" type="number" value="{{ old('capacity', $room->capacity) }}" required min="1" max="20" step="1" placeholder="1" aria-invalid="{{ $errors->has('capacity') ? 'true' : 'false' }}">
                        @error('capacity') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="field">
                        <span class="field-label">Status kamar <span class="required">*</span></span>
                        <div class="checkbox-wrap">
                            <input type="hidden" name="is_available" value="0">
                            <input id="is_available" name="is_available" type="checkbox" value="1" @checked((bool) old('is_available', $room->is_available))>
                            <label for="is_available">Kamar tersedia untuk disewa</label>
                        </div>
                        @error('is_available') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="field field-full">
                        <label for="facilities">Fasilitas kamar <span class="required">*</span></label>
                        <input class="control {{ $errors->has('facilities') ? 'is-invalid' : '' }}" id="facilities" name="facilities" type="text" value="{{ old('facilities', $room->facilities) }}" required maxlength="1000" placeholder="Kasur, lemari, Wi-Fi" aria-invalid="{{ $errors->has('facilities') ? 'true' : 'false' }}">
                        @error('facilities') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="field field-full">
                        <label for="description">Deskripsi <span class="muted">(opsional)</span></label>
                        <textarea class="control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="description" name="description" rows="4" maxlength="2000" placeholder="Keterangan tambahan tentang kamar..." aria-invalid="{{ $errors->has('description') ? 'true' : 'false' }}">{{ old('description', $room->description) }}</textarea>
                        @error('description') <p class="field-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <button class="btn btn-primary" type="submit">{{ $isEdit ? 'Simpan perubahan' : 'Simpan kamar' }}</button>
                    <a class="btn btn-secondary" href="{{ $isEdit ? route('rooms.show', $room) : route('rooms.index') }}">Batal</a>
                </div>
            </form>
        </div>
    </section>
@endsection
