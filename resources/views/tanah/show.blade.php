@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @if(empty($tanah))
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan </h5>
                Data yang Anda cari tidak ditemukan.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover table-sm">
                <tr>
                    <th>Kode Tanah</th>
                    <td>{{ $tanah->kode_tanah }}</td>
                </tr>
                <tr>
                    <th>Alamat Tanah</th>
                    <td>{{ $tanah->lokasi->alamat_lokasi ?? ''}}</td>
                </tr>
                <tr>
                    <th>Kota / Kab</th>
                    <td>{{ $tanah->lokasi->kota_kab_lokasi ?? ''}}</td>
                </tr>
                <tr>
                    <th>No Kavling</th>
                    <td>{{ $tanah->no_kav_tanah }}</td>
                </tr>
                <tr>
                    <th>Panjang Tanah</th>
                    <td>{{ $tanah->panjang_tanah }}</td>
                </tr>
                <tr>
                    <th>Lebar Tanah</th>
                    <td>{{ $tanah->lebar_tanah }}</td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>{{ $tanah->harga }}</td>
                </tr>
            </table>
        @endif
        <a href="{{ url('tanah') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    </div>
</div>
@endsection
@push('css')
@endpush
@push('js')
@endpush