<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    /**
     * 🧩 Menampilkan halaman Data Dosen (dengan Tab per Prodi)
     */
    public function index(Request $request)
    {
        // FIX: Mengganti 'dosen' menjadi 'dosens' di Eager Loading
        $prodis = Prodi::with(['dosens' => function ($query) {
            $query->orderByDesc('is_kaprodi')
                  ->orderBy('nama_dosen');
        }])
        ->orderBy('nama_prodi')
        ->get(); 

        $activeProdiId = $request->get('prodi_id') 
                         ?? ($prodis->first()->id ?? null);

        // Jika tidak ada parameter ID, set default ke prodi pertama untuk tampilan aktif
        if (!$request->get('prodi_id') && $prodis->isNotEmpty()) {
            $activeProdiId = $prodis->first()->id;
        }

        return view('dosens.index', compact('prodis', 'activeProdiId')); 
    }

    /**
     * 🧾 Simpan dosen baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_dosen'             => 'required|string|max:255',
            'nip'                    => 'required|string|max:255|unique:dosens,nip',
            'nidn'                   => 'nullable|string|max:255',
            'no_hp'                  => 'nullable|string|max:20',
            'email'                  => 'nullable|email|max:255',
            'bidang_keahlian'        => 'nullable|string',
            'riwayat_pendidikan'     => 'nullable|string',
            'pengalaman_kerja'       => 'nullable|string',
            'foto'                   => 'nullable|image|mimes:jpg,jpeg,png',
            'penelitian'             => 'nullable|string',
            'publikasi'              => 'nullable|string',
            'prodi_id'               => 'required|exists:prodis,id',
            'jabatan'                => 'nullable|string|max:255',
        ]);
        
        $dataToStore = array_map(function ($value) {
            return $value === '' ? null : $value;
        }, $validated);

        if ($request->hasFile('foto')) {
            $dataToStore['foto'] = $request->file('foto')->store('dosen', 'public');
        }

        Dosen::create($dataToStore);

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
            'nama_dosen'             => 'required|string|max:255',
            'nip'                    => 'required|string|max:255|unique:dosens,nip,' . $dosen->id,
            'nidn'                   => 'nullable|string|max:255',
            'no_hp'                  => 'nullable|string|max:20',
            'email'                  => 'nullable|email|max:255',
            'bidang_keahlian'        => 'nullable|string',
            'riwayat_pendidikan'     => 'nullable|string',
            'pengalaman_kerja'       => 'nullable|string',
            'foto'                   => 'nullable|image|mimes:jpg,jpeg,png',
            'penelitian'             => 'nullable|string',
            'publikasi'              => 'nullable|string',
            'prodi_id'               => 'required|exists:prodis,id',
            'jabatan'                => 'nullable|string|max:255',
        ]);

        $dataToUpdate = array_map(function ($value) {
            return $value === '' ? null : $value;
        }, $request->all());
        
        $dataToUpdate = array_intersect_key($dataToUpdate, $validated);

        if ($request->hasFile('foto')) {
            if ($dosen->foto) {
                Storage::disk('public')->delete($dosen->foto);
            }
            $dataToUpdate['foto'] = $request->file('foto')->store('dosen', 'public');
        } elseif (!isset($dataToUpdate['foto'])) {
             $dataToUpdate['foto'] = $dosen->foto; 
        }

        $dosen->update($dataToUpdate);

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