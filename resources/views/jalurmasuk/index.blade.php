@extends('layouts.app') {{-- Sesuaikan layout utama kamu --}}

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10">
    <h1 class="text-4xl font-bold text-green-800 mb-8">📋 Daftar Jalur Masuk</h1>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($jalurs as $jalur)
            <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition duration-300 p-6 border border-green-100">
                <h2 class="text-2xl font-semibold text-blue-700 hover:underline mb-2">
                    <a href="{{ route('jalurmasuk.show', $jalur->id) }}">
                        {{ ucfirst($jalur->nama_jalur) }}
                    </a>
                </h2>

                <p class="text-gray-700">
                    <strong>🗓 Periode:</strong> {{ \Carbon\Carbon::parse($jalur->tanggal_buka)->translatedFormat('d M Y') }} –
                    {{ \Carbon\Carbon::parse($jalur->tanggal_tutup)->translatedFormat('d M Y') }}
                </p>

                <p class="text-gray-700 mt-1">
                    <strong>👥 Kuota:</strong> {{ $jalur->kuota }}
                </p>

                <p class="text-gray-600 mt-3 text-sm">
                    {{ \Illuminate\Support\Str::limit($jalur->deskripsi, 100) }}
                </p>

                <div class="mt-4">
                    <a href="{{ route('jalurmasuk.show', $jalur->id) }}"
                        class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                        Lihat Detail
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
