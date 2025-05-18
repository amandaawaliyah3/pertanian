<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::orderBy('nama')->paginate(10);
        return view('dosen.index', compact('dosens'));
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nidn' => 'required|unique:dosens|max:20',
            'nama' => 'required|max:255',
            'email' => 'nullable|email',
            'no_hp' => 'nullable|max:20',
            'bidang_keahlian' => 'required',
            'riwayat_pendidikan' => 'nullable',
            'pengalaman_kerja' => 'nullable',
            'penelitian' => 'nullable',
            'publikasi' => 'nullable',
            'foto' => 'nullable|image|max:2048',
            'is_kaprodi' => 'boolean'
        ]);

        // Handle upload foto
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('dosen', 'public');
        }

        // Jika set sebagai kaprodi, nonaktifkan kaprodi sebelumnya
        if ($request->is_kaprodi) {
            Dosen::where('is_kaprodi', true)->update(['is_kaprodi' => false]);
        }

        Dosen::create($validated);

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan');
    }

    public function show(Dosen $dosen)
    {
        return view('dosen.show', compact('dosen'));
    }

    public function edit(Dosen $dosen)
    {
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $validated = $request->validate([
            'nidn' => 'required|max:20|unique:dosens,nidn,'.$dosen->id,
            'nama' => 'required|max:255',
            'email' => 'nullable|email',
            'no_hp' => 'nullable|max:20',
            'bidang_keahlian' => 'required',
            'riwayat_pendidikan' => 'nullable',
            'pengalaman_kerja' => 'nullable',
            'penelitian' => 'nullable',
            'publikasi' => 'nullable',
            'foto' => 'nullable|image|max:2048',
            'is_kaprodi' => 'boolean'
        ]);

        // Handle upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($dosen->foto) {
                Storage::disk('public')->delete($dosen->foto);
            }
            $validated['foto'] = $request->file('foto')->store('dosen', 'public');
        } else {
            // Pertahankan foto lama jika tidak ada upload baru
            $validated['foto'] = $dosen->foto;
        }

        // Jika set sebagai kaprodi, nonaktifkan kaprodi sebelumnya
        if ($request->is_kaprodi) {
            Dosen::where('is_kaprodi', true)
                ->where('id', '!=', $dosen->id)
                ->update(['is_kaprodi' => false]);
        }

        $dosen->update($validated);

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui');
    }

    public function destroy(Dosen $dosen)
    {
        // Hapus foto jika ada
        if ($dosen->foto) {
            Storage::disk('public')->delete($dosen->foto);
        }

        $dosen->delete();

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus');
    }

    // Bulk action untuk set kaprodi
    public function setKaprodi(Request $request)
    {
        $request->validate([
            'dosen_id' => 'required|exists:dosens,id'
        ]);

        // Nonaktifkan semua kaprodi terlebih dahulu
        Dosen::where('is_kaprodi', true)->update(['is_kaprodi' => false]);

        // Aktifkan dosen yang dipilih
        Dosen::find($request->dosen_id)->update(['is_kaprodi' => true]);

        return back()->with('success', 'Kaprodi berhasil diubah');
    }
}