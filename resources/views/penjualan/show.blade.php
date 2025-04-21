@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @if(empty($penjualan))
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan </h5>
                Data yang Anda cari tidak ditemukan.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover table-sm">
                <tr>
                    <th>Kode Penjualan</th>
                    <td>{{ $penjualan->kode_penjualan }}</td>
                </tr>
                <tr>
                    <th>Nama Nasabah</th>
                    <td>{{ $penjualan->nasabah->nama_nasabah ?? ''}}</td>
                </tr>
                <tr>
                    <th>Telepon Nasabah</th>
                    <td>{{ $penjualan->nasabah->telp_nasabah ?? ''}}</td>
                </tr>
                <tr>
                    <th>No Kavling</th>
                    <td>{{ $penjualan->tanah->no_kav_tanah ?? ''}}</td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>{{ $penjualan->tanah->harga ?? ''}}</td>
                </tr>
                <tr>
                    <th>Pembayaran</th>
                    <td>{{ $penjualan->pembayaran }}</td>
                </tr>
            </table>
        @endif
        <a href="{{ url('penjualan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    </div>
</div>
@endsection
@push('css')
@endpush
@push('js')
@endpush