<?php

namespace App\Http\Controllers;

use App\Models\InfoBox;
use Illuminate\Http\Request;

class InfoBoxController extends Controller
{
    public function index()
    {
        $infoBoxes = InfoBox::all();
        return view('admin.infobox.index', compact('infoBoxes'));
    }

    public function create()
    {
        return view('admin.infobox.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ikon' => 'nullable|string|max:100',
        ]);

        InfoBox::create($request->all());

        return redirect()->route('infobox.index')->with('success', 'Info box berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $infoBox = InfoBox::findOrFail($id);
        return view('admin.infobox.edit', compact('infoBox'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'ikon' => 'nullable|string|max:100',
        ]);

        $infoBox = InfoBox::findOrFail($id);
        $infoBox->update($request->all());

        return redirect()->route('infobox.index')->with('success', 'Info box berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $infoBox = InfoBox::findOrFail($id);
        $infoBox->delete();

        return redirect()->route('infobox.index')->with('success', 'Info box berhasil dihapus.');
    }
}
