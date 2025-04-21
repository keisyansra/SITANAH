@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @if(empty($lokasi))
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan </h5>
                Data yang Anda cari tidak ditemukan.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover table-sm">
                <tr>
                    <th>Kode Lokasi</th>
                    <td>{{ $lokasi->kode_lokasi }}</td>
                </tr>
                <tr>
                    <th>Alamat Lokasi</th>
                    <td>{{ $lokasi->alamat_lokasi }}</td>
                </tr>
                <tr>
                    <th>Kelurahan</th>
                    <td>{{ $lokasi->kelurahan_lokasi }}</td>
                </tr>
                <tr>
                    <th>Kecamatan</th>
                    <td>{{ $lokasi->kecamatn_lokasi }}</td>
                </tr>
                <tr>
                    <th>Kota/Kabupaten</th>
                    <td>{{ $lokasi->kota_kab_lokasi }}</td>
                </tr>
                <tr>
                    <th>Provinsi</th>
                    <td>{{ $lokasi->provinsi_lokasi }}</td>
                </tr>
            </table>
        @endif
        <a href="{{ url('lokasi') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    </div>
</div>
@endsection
@push('css')
@endpush
@push('js')
@endpush