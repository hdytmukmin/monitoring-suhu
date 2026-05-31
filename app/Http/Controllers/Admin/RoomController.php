<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoomRequest;
use App\Models\Room;
use Illuminate\Database\QueryException;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::query()
            ->withCount(['devices', 'readings'])
            ->latest()
            ->paginate(10);

        return view('admin.rooms.index', [
            'rooms' => $rooms,
        ]);
    }

    public function create()
    {
        return view('admin.rooms.create', [
            'room' => new Room([
                'warning_temperature' => 30,
                'danger_temperature' => 35,
                'is_active' => true,
            ]),
        ]);
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', [
            'room' => $room,
        ]);
    }

    public function store(RoomRequest $request)
    {
        Room::query()->create($request->validated());

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function update(RoomRequest $request, Room $room)
    {
        $room->update($request->validated());

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy(Room $room)
    {
        if ($room->devices()->exists() || $room->readings()->exists()) {
            return redirect()
                ->route('admin.rooms.index')
                ->with('error', 'Ruangan tidak dapat dihapus karena sudah memiliki device atau histori suhu.');
        }

        try {
            $room->delete();
        } catch (QueryException) {
            return redirect()
                ->route('admin.rooms.index')
                ->with('error', 'Ruangan tidak dapat dihapus karena masih dipakai data lain.');
        }

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Ruangan berhasil dihapus.');
    }
}
