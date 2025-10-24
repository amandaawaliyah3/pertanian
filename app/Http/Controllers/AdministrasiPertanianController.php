<?php

namespace App\Http\Controllers;

use App\Models\AdministrasiPertanian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdministrasiPertanianController extends Controller
{
    public function index()
    {
        $data = AdministrasiPertanian::all();
        return view('administrasi.index', compact('data'));
    }

    public function create()
    {
        return view('administrasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:administrasi_pertanian',
            'bidang' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto_administrasi', 'public');
        }

        AdministrasiPertanian::create($data);

        return redirect()->route('administrasi.index')
                         ->with('success', 'Data berhasil ditambahkan');
    }

    public function show($id)
    {
        $item = AdministrasiPertanian::findOrFail($id);
        return view('administrasi.show', compact('item'));
    }

    public function edit($id)
    {
        $item = AdministrasiPertanian::findOrFail($id);
        return view('administrasi.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:administrasi_pertanian,nip,'.$id,
            'bidang' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $item = AdministrasiPertanian::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($item->foto) {
                Storage::disk('public')->delete($item->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto_administrasi', 'public');
        }

        $item->update($data);

        return redirect()->route('administrasi.index')
                         ->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $item = AdministrasiPertanian::findOrFail($id);

        // Hapus foto jika ada
        if ($item->foto) {
            Storage::disk('public')->delete($item->foto);
        }

        $item->delete();

        return redirect()->route('administrasi.index')
                         ->with('success', 'Data berhasil dihapus');
    }
}
