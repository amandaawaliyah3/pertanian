<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    /**
     * Tampilkan semua dosen.
     */
    public function index()
    {
        $dosens = Dosen::all();
        return view('dosens.index', compact('dosens'));
    }

    /**
     * Tampilkan form tambah dosen.
     */
    public function create()
    {
        return view('dosens.create');
    }

    /**
     * Simpan dosen baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'             => 'required|string|max:255',
            'nip'              => 'required|string|max:255|unique:dosens',
            'nidn'             => 'required|string|max:255',
            'no_hp'            => 'nullable|string|max:20',
            'email'            => 'nullable|email|max:255',
            'bidang_keahlian'  => 'nullable|string',
            'riwayat_pendidikan'   => 'nullable|string',
            'pengalaman_kerja'     => 'nullable|string',
            'foto'             => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'penelitian'       => 'nullable|array',
            'publikasi'        => 'nullable|array',
        ]);

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('dosen');
        }

        // Pakai casting di model untuk penelitian & publikasi
        $validated['penelitian'] = $request->input('penelitian', []);
        $validated['publikasi']  = $request->input('publikasi', []);

        Dosen::create($validated);

        return redirect()
            ->route('dosens.index')
            ->with('success', 'Dosen berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail satu dosen.
     */
    public function show($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('dosens.show', compact('dosen'));
    }

    /**
     * Tampilkan form edit dosen.
     */
    public function edit(Dosen $dosen)
    {
        return view('dosens.edit', compact('dosen'));
    }

    /**
     * Update data dosen.
     */
    public function update(Request $request, Dosen $dosen)
    {
        $validated = $request->validate([
            'nama'             => 'required|string|max:255',
            'nip'              => 'required|string|max:255|unique:dosens,nip,' . $dosen->id,
            'nidn'             => 'required|string|max:255',
            'no_hp'            => 'nullable|string|max:20',
            'email'            => 'nullable|email|max:255',
            'bidang_keahlian'  => 'nullable|string',
            'riwayat_pendidikan'   => 'nullable|string',
            'pengalaman_kerja'     => 'nullable|string',
            'foto'             => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'penelitian'       => 'nullable|array',
            'publikasi'        => 'nullable|array',
        ]);

        // Jika ada unggah foto baru, hapus yang lama lalu simpan
        if ($request->hasFile('foto')) {
            if ($dosen->foto) {
                Storage::delete($dosen->foto);
            }
            $validated['foto'] = $request->file('foto')->store('dosen');
        }

        $validated['penelitian'] = $request->input('penelitian', []);
        $validated['publikasi']  = $request->input('publikasi', []);

        $dosen->update($validated);

        return redirect()
            ->route('dosens.index')
            ->with('success', 'Data dosen berhasil diperbarui.');
    }

    /**
     * Hapus data dosen.
     */
    public function destroy(Dosen $dosen)
    {
        if ($dosen->foto) {
            Storage::delete($dosen->foto);
        }

        $dosen->delete();

        return redirect()
            ->route('dosens.index')
            ->with('success', 'Dosen berhasil dihapus.');
    }

    /**
     * Set seorang dosen sebagai Kaprodi.
     */
    public function setKaprodi($id)
    {
        // Reset semua
        Dosen::where('is_kaprodi', true)
            ->update(['is_kaprodi' => false]);

        // Tandai yang dipilih
        $dosen = Dosen::findOrFail($id);
        $dosen->update(['is_kaprodi' => true]);

        return redirect()
            ->route('dosens.index')
            ->with('success', 'Dosen berhasil dijadikan Kaprodi.');
    }
}
