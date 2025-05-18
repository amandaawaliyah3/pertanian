<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Galeri extends Model
{
    protected $fillable = ['judul', 'kategori', 'foto', 'deskripsi', 'tanggal'];

    // Cek keberadaan file foto
    public function fotoExists()
    {
        return Storage::disk('public')->exists($this->foto);
    }

    // Akses URL foto
    public function getFotoUrlAttribute()
    {
        return $this->fotoExists()
            ? asset('storage/' . $this->foto)
            : asset('storage/galeri/default-gallery.jpg');
    }

    // Format tanggal
    public function getTanggalFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->tanggal)->translatedFormat('d F Y');
    }

    // Scope untuk filter
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['kategori'] ?? false, fn($q, $kategori) =>
            $q->where('kategori', $kategori));

        $query->when($filters['search'] ?? false, fn($q, $search) =>
            $q->where('judul', 'like', '%' . $search . '%'));
    }
}
