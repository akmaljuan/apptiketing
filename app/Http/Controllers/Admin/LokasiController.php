<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasis = Lokasi::all();
        return view('admin.lokasi.index', compact('lokasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required|max:255'
        ]);

        Lokasi::create($request->all());
        return back()->with('success', 'Lokasi berhasil ditambahkan');
    }

    public function update(Request $request, Lokasi $lokasi)
    {
        $request->validate([
            'nama_lokasi' => 'required|max:255'
        ]);

        $lokasi->update($request->all());
        return back()->with('success', 'Lokasi berhasil diupdate');
    }

    public function destroy(Lokasi $lokasi)
    {
        $lokasi->delete();
        return back()->with('success', 'Lokasi berhasil dihapus');
    }
}
