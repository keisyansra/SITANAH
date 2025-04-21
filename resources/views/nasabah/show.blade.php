@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @if(empty($nasabah))
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan </h5>
                Data yang Anda cari tidak ditemukan.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover table-sm">
                <tr>
                    <th>Kode Nasabah</th>
                    <td>{{ $nasabah->kode_nasabah }}</td>
                </tr>
                <tr>
                    <th>Nama Nasabah</th>
                    <td>{{ $nasabah->nama_nasabah }}</td>
                </tr>
                <tr>
                    <th>Alamat Nasabah</th>
                    <td>{{ $nasabah->alamat_nasabah }}</td>
                </tr>
                <tr>
                    <th>Telepon Nasabah</th>
                    <td>{{ $nasabah->telp_nasabah }}</td>
                </tr>
                <tr>
                    <th>Nama Kerabat</th>
                    <td>{{ $nasabah->nama_kerabat_nasabah }}</td>
                </tr>
                <tr>
                    <th>Telepon Kerabat</th>
                    <td>{{ $nasabah->telp_kerabat_nasabah }}</td>
                </tr>
            </table>
        @endif
        <a href="{{ url('nasabah') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    </div>
</div>
@endsection
@push('css')
@endpush
@push('js')
@endpush