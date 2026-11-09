<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoomController extends Controller
{
    public function index(): View
    {
        return view('rooms.index', [
            'rooms' => Room::query()->latest('id')->get(),
        ]);
    }

    public function create(): View
    {
        return view('rooms.form', ['room' => new Room()]);
    }

    public function store(Request $request): RedirectResponse
    {
        Room::create($this->validatedData($request));

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Data kamar berhasil ditambahkan.');
    }

    public function show(Room $room): View
    {
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room): View
    {
        return view('rooms.form', compact('room'));
    }

    public function update(Request $request, Room $room): RedirectResponse
    {
        $room->update($this->validatedData($request));

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Data kamar berhasil diperbarui.');
    }

    public function confirmDelete(Room $room): View
    {
        return view('rooms.confirm-delete', compact('room'));
    }

    public function destroy(Room $room): RedirectResponse
    {
        $room->delete();

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Data kamar berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedData(Request $request): array
    {
        return $request->validate([
            'room_number' => ['required', 'string', 'max:20', 'unique:rooms,room_number,'.($request->route('room')?->id ?? 'NULL').',id'],
            'room_type' => ['required', 'in:'.implode(',', Room::TYPES)],
            'floor' => ['required', 'integer', 'min:1', 'max:100'],
            'monthly_price' => ['required', 'integer', 'min:0'],
            'capacity' => ['required', 'integer', 'min:1', 'max:20'],
            'is_available' => ['required', 'boolean'],
            'facilities' => ['required', 'string', 'max:1000'],
            'description' => ['nullable', 'string', 'max:2000'],
        ], [
            'room_number.unique' => 'Nomor kamar sudah digunakan.',
        ]);
    }
}
