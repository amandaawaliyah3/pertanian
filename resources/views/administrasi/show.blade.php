@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detail Administrasi</div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            @if($item->foto)
                                <img src="{{ asset('storage/'.$item->foto) }}" class="img-fluid">
                            @else
                                <div class="text-muted">Tidak ada foto</div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <table class="table">
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $item->nama }}</td>
                                </tr>
                                <tr>
                                    <th>NIP</th>
                                    <td>{{ $item->nip }}</td>
                                </tr>
                                <tr>
                                    <th>Bidang</th>
                                    <td>{{ $item->bidang }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <a href="{{ route('administrasi.index') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
