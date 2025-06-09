@extends('layouts.app')

@section('title', $prodi->nama_prodi)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">{{ $prodi->nama_prodi }}</h2>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="text-primary">Masa Kuliah</h4>
                        <p class="fs-5">{{ $prodi->masa_kuliah }}</p>
                    </div>

                    <div class="mb-4">
                        <h4 class="text-primary">Visi</h4>
                        <div class="border p-3 bg-light rounded">
                            {!! nl2br(e($prodi->visi)) !!}
                        </div>
                    </div>

                    <div class="mb-4">
                        <h4 class="text-primary">Misi</h4>
                        <div class="border p-3 bg-light rounded">
                            {!! nl2br(e($prodi->misi)) !!}
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('d3.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Prodi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
