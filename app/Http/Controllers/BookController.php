<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        return view('books.index', [
            'books' => Book::query()->latest('id')->get(),
        ]);
    }

    public function create(): View
    {
        return view('books.form', ['book' => new Book()]);
    }

    public function store(Request $request): RedirectResponse
    {
        Book::create($this->validatedData($request));

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan ke koleksi.');
    }

    public function show(Book $book): View
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book): View
    {
        return view('books.form', compact('book'));
    }

    public function update(Request $request, Book $book): RedirectResponse
    {
        $book->update($this->validatedData($request));

        return redirect()
            ->route('books.index')
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    public function confirmDelete(Book $book): View
    {
        return view('books.confirm-delete', compact('book'));
    }

    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil dihapus dari koleksi.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:'.implode(',', Book::CATEGORIES)],
            'published_at' => ['required', 'date'],
            'stock' => ['required', 'integer', 'min:0'],
            'is_available' => ['required', 'boolean'],
            'synopsis' => ['nullable', 'string'],
            'isbn' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
