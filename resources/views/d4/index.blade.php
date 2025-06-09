@extends('layouts.app')

@section('title', 'Program Studi D4')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Program Studi Diploma 4</h1>

    <div class="row">
        @foreach($prodis as $prodi)
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title mb-0">{{ $prodi->nama_prodi }}</h4>
                    <small class="text-light">Masa Kuliah: {{ $prodi->masa_kuliah }}</small>
                </div>
                <div class="card-body">
                    <h5 class="card-subtitle mb-2">Visi</h5>
                    <p class="card-text">{{ $prodi->visi }}</p>

                    <h5 class="card-subtitle mb-2 mt-3">Misi</h5>
                    <p class="card-text">{{ $prodi->misi }}</p>
                </div>
                <div class="card-footer bg-light">
                    <a href="{{ route('d4.show', $prodi->id) }}" class="btn btn-outline-primary">Detail Lengkap</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
