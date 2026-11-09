<?php

namespace Tests\Feature;

use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoomCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_and_room_pages_use_the_kos_theme_and_required_titles(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Halaman Beranda')
            ->assertSee('Kos Achmad Safei')
            ->assertSee('2457401014');

        $this->get(route('rooms.index'))
            ->assertOk()
            ->assertSee('Halaman Daftar Data')
            ->assertSee('Belum ada data');

        $this->get(route('rooms.create'))
            ->assertOk()
            ->assertSee('Form Tambah Data Kosong')
            ->assertSee('Nomor kamar')
            ->assertSee('Fasilitas kamar');
    }

    public function test_seeder_creates_fourteen_rooms_for_digit_four(): void
    {
        $this->seed();

        $this->assertDatabaseCount('rooms', 14);
        $this->assertDatabaseHas('rooms', [
            'room_number' => 'A01',
            'room_type' => 'Standar',
            'monthly_price' => 650000,
        ]);
    }

    public function test_invalid_room_input_keeps_old_values_and_shows_field_errors(): void
    {
        $response = $this->from(route('rooms.create'))
            ->post(route('rooms.store'), [
                'room_number' => '',
                'room_type' => 'Suite',
                'floor' => 0,
                'monthly_price' => -1,
                'capacity' => 0,
                'is_available' => '1',
                'facilities' => 'Fasilitas uji',
            ]);

        $response->assertRedirect(route('rooms.create'))
            ->assertSessionHasErrors(['room_number', 'room_type', 'floor', 'monthly_price', 'capacity'])
            ->assertSessionHasInput('facilities', 'Fasilitas uji');

        $this->get(route('rooms.create'))
            ->assertOk()
            ->assertSee('Form Tambah Data dengan Pesan Error Validasi')
            ->assertSee('kesalahan validasi')
            ->assertSee('Fasilitas uji');
    }

    public function test_room_can_be_created_and_success_message_is_shown(): void
    {
        $this->post(route('rooms.store'), $this->validRoom())
            ->assertRedirect(route('rooms.index'))
            ->assertSessionHas('success', 'Data kamar berhasil ditambahkan.');

        $room = Room::query()->firstOrFail();
        $this->assertSame('U01', $room->room_number);
        $this->assertTrue($room->is_available);

        $this->get(route('rooms.index'))
            ->assertOk()
            ->assertSee('Halaman Daftar Data dengan Pesan Sukses Setelah Menambah Data')
            ->assertSee('Data kamar berhasil ditambahkan.')
            ->assertSee('U01');
    }

    public function test_duplicate_room_number_shows_a_validation_error(): void
    {
        Room::create($this->validRoom());

        $this->from(route('rooms.create'))
            ->post(route('rooms.store'), $this->validRoom())
            ->assertRedirect(route('rooms.create'))
            ->assertSessionHasErrors([
                'room_number' => 'Nomor kamar sudah digunakan.',
            ]);
    }

    public function test_room_details_edit_form_and_update_work(): void
    {
        $room = Room::create($this->validRoom());

        $this->get(route('rooms.show', $room))
            ->assertOk()
            ->assertSee('Halaman Detail Data')
            ->assertSee($room->room_number)
            ->assertSee($room->facilities);

        $this->get(route('rooms.edit', $room))
            ->assertOk()
            ->assertSee('Form Ubah Data dengan Data Lama')
            ->assertSee('value="U01"', false)
            ->assertSee('value="850000"', false);

        $this->put(route('rooms.update', $room), array_merge($this->validRoom(), [
            'room_number' => 'U02',
            'is_available' => '0',
        ]))
            ->assertRedirect(route('rooms.index'))
            ->assertSessionHas('success', 'Data kamar berhasil diperbarui.');

        $this->assertDatabaseHas('rooms', [
            'id' => $room->id,
            'room_number' => 'U02',
            'is_available' => 0,
        ]);
    }

    public function test_room_deletion_requires_confirmation_and_shows_success_message(): void
    {
        $room = Room::create($this->validRoom());

        $this->get(route('rooms.confirm-delete', $room))
            ->assertOk()
            ->assertSee('Konfirmasi Sebelum Menghapus Data')
            ->assertSee(route('rooms.destroy', $room));

        $this->delete(route('rooms.destroy', $room))
            ->assertRedirect(route('rooms.index'))
            ->assertSessionHas('success', 'Data kamar berhasil dihapus.');

        $this->assertDatabaseMissing('rooms', ['id' => $room->id]);

        $this->get(route('rooms.index'))
            ->assertOk()
            ->assertSee('Halaman Daftar Data dengan Pesan Sukses Setelah Menghapus Data')
            ->assertSee('Data kamar berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validRoom(): array
    {
        return [
            'room_number' => 'U01',
            'room_type' => 'Deluxe',
            'floor' => 2,
            'monthly_price' => 850000,
            'capacity' => 1,
            'is_available' => '1',
            'facilities' => 'Kasur, lemari, AC, Wi-Fi',
            'description' => 'Kamar uji untuk tes CRUD.',
        ];
    }
}
