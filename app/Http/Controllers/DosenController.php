<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    /**
     * 🧩 Menampilkan halaman Data Dosen (dengan filter Prodi)
     */
    public function index(Request $request)
    {
        // Ambil semua prodi untuk dropdown
        $prodis = Prodi::orderBy('nama_prodi')->get();

        // Ambil parameter prodi_id dari URL (?prodi_id=3)
        $prodi_id = $request->get('prodi_id');

        // Default kosong dulu
        $dosens = collect();
        $selectedProdi = null;

        // Jika sudah memilih prodi
        if ($prodi_id) {
            $selectedProdi = Prodi::find($prodi_id);

            $dosens = Dosen::with('prodi')
                ->where('prodi_id', $prodi_id)
                ->orderByDesc('is_kaprodi')
                ->orderBy('nama_dosen')
                ->get();
        }

        // 🔥 FIX DI SINI: gunakan 'dosens.index' bukan 'dosen.index'
        return view('dosens.index', compact('dosens', 'prodis', 'selectedProdi'));
    }

    /**
     * 🧾 Simpan dosen baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_dosen'         => 'required|string|max:255',
            'nip'                => 'required|string|max:255|unique:dosens,nip',
            'nidn'               => 'nullable|string|max:255',
            'no_hp'              => 'nullable|string|max:20',
            'email'              => 'nullable|email|max:255',
            'bidang_keahlian'    => 'nullable|string',
            'riwayat_pendidikan' => 'nullable|string',
            'pengalaman_kerja'   => 'nullable|string',
            'foto'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'penelitian'         => 'nullable|string',
            'publikasi'          => 'nullable|string',
            'prodi_id'           => 'required|exists:prodis,id',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('dosen', 'public');
        }

        Dosen::create($validated);

        return redirect()->route('dosen.index')
            ->with('success', 'Data dosen berhasil ditambahkan.');
    }

    /**
     * 🔍 Detail dosen
     */
    public function show($id)
    {
        $dosen = Dosen::with('prodi')->findOrFail($id);
        return view('dosens.show', compact('dosen'));
    }

    /**
     * ✏️ Form edit
     */
    public function edit(Dosen $dosen)
    {
        $prodis = Prodi::all();
        return view('dosens.edit', compact('dosen', 'prodis'));
    }

    /**
     * ♻️ Update data dosen
     */
    public function update(Request $request, Dosen $dosen)
    {
        $validated = $request->validate([
            'nama_dosen'         => 'required|string|max:255',
            'nip'                => 'required|string|max:255|unique:dosens,nip,' . $dosen->id,
            'nidn'               => 'nullable|string|max:255',
            'no_hp'              => 'nullable|string|max:20',
            'email'              => 'nullable|email|max:255',
            'bidang_keahlian'    => 'nullable|string',
            'riwayat_pendidikan' => 'nullable|string',
            'pengalaman_kerja'   => 'nullable|string',
            'foto'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'penelitian'         => 'nullable|string',
            'publikasi'          => 'nullable|string',
            'prodi_id'           => 'required|exists:prodis,id',
        ]);

        if ($request->hasFile('foto')) {
            if ($dosen->foto) {
                Storage::disk('public')->delete($dosen->foto);
            }
            $validated['foto'] = $request->file('foto')->store('dosen', 'public');
        }

        $dosen->update($validated);

        return redirect()->route('dosen.index', ['prodi_id' => $dosen->prodi_id])
            ->with('success', 'Data dosen berhasil diperbarui.');
    }

    /**
     * 🗑️ Hapus dosen
     */
    public function destroy(Dosen $dosen)
    {
        if ($dosen->foto) {
            Storage::disk('public')->delete($dosen->foto);
        }

        $dosen->delete();

        return redirect()->back()->with('success', 'Dosen berhasil dihapus.');
    }

    /**
     * 👑 Jadikan sebagai Kaprodi
     */
    public function setKaprodi($id)
    {
        $dosen = Dosen::findOrFail($id);

        Dosen::where('prodi_id', $dosen->prodi_id)->update(['is_kaprodi' => false]);
        $dosen->update(['is_kaprodi' => true]);

        return redirect()->route('dosen.index', ['prodi_id' => $dosen->prodi_id])
            ->with('success', "{$dosen->nama_dosen} telah dijadikan Kaprodi.");
    }
}
