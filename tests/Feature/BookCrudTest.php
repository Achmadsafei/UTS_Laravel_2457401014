<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_and_book_pages_use_the_shared_library_layout(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Temukan cerita yang terasa seperti rumah.')
            ->assertSee('NIM');

        $this->get(route('books.index'))
            ->assertOk()
            ->assertSee('Belum ada data');

        $this->get(route('books.create'))
            ->assertOk()
            ->assertSee('Tambah buku baru')
            ->assertSee('type="date"', false)
            ->assertSee('type="checkbox"', false);
    }

    public function test_seeder_creates_ten_books_for_digit_zero(): void
    {
        $this->seed();

        $this->assertDatabaseCount('books', 10);
        $this->assertDatabaseHas('books', [
            'title' => 'Belajar PHP dari Nol',
            'category' => 'Teknologi',
            'isbn' => '978-602-1234-56-7',
        ]);
    }

    public function test_invalid_book_input_keeps_old_values_and_shows_field_errors(): void
    {
        $response = $this->from(route('books.create'))
            ->post(route('books.store'), [
                'title' => '',
                'author' => 'Penulis Uji',
                'category' => 'Fantasi',
                'published_at' => 'tanggal-salah',
                'stock' => '-1',
                'is_available' => '1',
                'synopsis' => 'Sinopsis yang tetap tampil',
            ]);

        $response->assertRedirect(route('books.create'))
            ->assertSessionHasErrors(['title', 'category', 'published_at', 'stock'])
            ->assertSessionHasInput('author', 'Penulis Uji');

        $this->get(route('books.create'))
            ->assertOk()
            ->assertSee('Periksa kembali isian yang ditandai.')
            ->assertSee('Penulis Uji')
            ->assertSee('Sinopsis yang tetap tampil');
    }

    public function test_book_can_be_created_and_success_message_is_shown(): void
    {
        $this->post(route('books.store'), $this->validBook())
            ->assertRedirect(route('books.index'))
            ->assertSessionHas('success', 'Buku berhasil ditambahkan ke koleksi.');

        $book = Book::query()->firstOrFail();
        $this->assertSame('Buku Uji CRUD', $book->title);
        $this->assertTrue($book->is_available);

        $this->get(route('books.index'))
            ->assertOk()
            ->assertSee('Buku berhasil ditambahkan ke koleksi.')
            ->assertSee('Buku Uji CRUD');
    }

    public function test_book_details_edit_form_and_update_work(): void
    {
        $book = Book::create($this->validBook());

        $this->get(route('books.show', $book))
            ->assertOk()
            ->assertSee($book->title)
            ->assertSee($book->author)
            ->assertSee($book->isbn);

        $this->get(route('books.edit', $book))
            ->assertOk()
            ->assertSee('value="Buku Uji CRUD"', false)
            ->assertSee('value="Penulis Contoh"', false)
            ->assertSee('value="1"', false);

        $this->put(route('books.update', $book), array_merge($this->validBook(), [
            'title' => 'Judul Setelah Diubah',
            'is_available' => '0',
        ]))
            ->assertRedirect(route('books.index'))
            ->assertSessionHas('success', 'Data buku berhasil diperbarui.');

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Judul Setelah Diubah',
            'is_available' => 0,
        ]);
    }

    public function test_book_deletion_requires_confirmation_and_shows_success_message(): void
    {
        $book = Book::create($this->validBook());

        $this->get(route('books.confirm-delete', $book))
            ->assertOk()
            ->assertSee('Hapus buku ini?')
            ->assertSee(route('books.destroy', $book));

        $this->delete(route('books.destroy', $book))
            ->assertRedirect(route('books.index'))
            ->assertSessionHas('success', 'Buku berhasil dihapus dari koleksi.');

        $this->assertDatabaseMissing('books', ['id' => $book->id]);

        $this->get(route('books.index'))
            ->assertOk()
            ->assertSee('Buku berhasil dihapus dari koleksi.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validBook(): array
    {
        return [
            'title' => 'Buku Uji CRUD',
            'author' => 'Penulis Contoh',
            'category' => 'Novel',
            'published_at' => '2024-05-10',
            'stock' => 2,
            'is_available' => '1',
            'synopsis' => 'Sinopsis buku untuk pengujian.',
            'isbn' => '978-602-1234-50-0',
        ];
    }
}
