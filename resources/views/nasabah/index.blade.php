@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            {{-- <a class="btn btn-sm btn-primary mt-1" href="{{ url('/admin/create') }}">Tambah Admin</a>  --}}
            <button class="btn btn-sm btn-success mt-1" data-url="{{ url('/nasabah/create') }}" onclick="modalAction(this)">Tambah Data</button>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <select class="form-control" id="nasabah_filter" name="nasabah_filter">
                            <option value="">- Semua -</option>
                            @foreach($nasabah as $item)
                            <option value="{{ $item->id_nasabah }}">{{ $item->kode_nasabah }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Filter berdasarkan kode nasabah</small>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-bordered table-striped table-hover table-sm" id="table_nasabah">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Nasabah</th>
                    <th>Nama Nasabah</th>
                    <th>Alamat Nasabah</th>
                    <th>Telepon Nasabah</th>
                    <th>Nama Kerabat</th>
                    <th>Telepon Kerabat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-
backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
@endpush

@push('js')
<script>
    function modalAction(element) {
    let url = typeof element === "string" ? element : element.getAttribute("data-url");
    $('#myModal').load(url, function() {
        $('#myModal').modal('show');
    });
}
var dataNasabah;
    $(document).ready(function() {
         dataNasabah = $('#table_nasabah').DataTable({
            serverSide: true,
            ajax: {
                "url": "{{ url('nasabah/list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function(d) {
                    d.id_nasabah = $('#nasabah_filter').val();
                }
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "kode_nasabah",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "nama_nasabah",
                    className: "",
                    orderable: true,
                    searchable: true
                },{
                    data: "alamat_nasabah",
                    className: "",
                    orderable: true,
                    searchable: true
                },{
                    data: "telp_nasabah",
                    className: "",
                    orderable: true,
                    searchable: true
                },{
                    data: "nama_kerabat_nasabah",
                    className: "",
                    orderable: true,
                    searchable: true
                },{
                    data: "telp_kerabat_nasabah",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "aksi",
                    className: "",
                    orderable: true,
                    searchable: true
                },
            ]
        });

        $('#nasabah_filter').on('change', function() {
            dataNasabah.reload();
        });
    });
</script>
@endpush