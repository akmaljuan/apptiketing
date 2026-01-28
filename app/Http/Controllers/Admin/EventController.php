<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;     // ← INI WAJIB
use App\Models\Kategori;
use App\Models\Lokasi;


class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['kategori', 'lokasi'])->get();
        return view('admin.event.index', compact('events'));
    }

    public function create()
    {
        $categories = Kategori::all();
        $lokasis = Lokasi::all();

        return view('admin.event.create', compact('categories', 'lokasis'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_waktu' => 'required|date',
            'lokasi_id' => 'required|exists:lokasis,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('images/events'), $imageName);
            $validatedData['gambar'] = $imageName;
        }

        $validatedData['user_id'] = auth()->id();

        Event::create($validatedData);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $event = Event::with(['kategori', 'lokasi'])->findOrFail($id);
        return view('admin.event.show', compact('event'));
    }

    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        $categories = Kategori::all();
        $lokasis = Lokasi::all();

        return view('admin.event.edit', compact('event', 'categories', 'lokasis'));
    }

    public function update(Request $request, string $id)
    {
        $event = Event::findOrFail($id);

        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_waktu' => 'required|date',
            'lokasi_id' => 'required|exists:lokasis,id',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('images/events'), $imageName);
            $validatedData['gambar'] = $imageName;
        }

        $event->update($validatedData);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        Event::findOrFail($id)->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus');
    }
}
