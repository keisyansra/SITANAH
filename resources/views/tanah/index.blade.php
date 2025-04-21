@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            {{-- <a class="btn btn-sm btn-primary mt-1" href="{{ url('/admin/create') }}">Tambah Admin</a>  --}}
            <button class="btn btn-sm btn-success mt-1" data-url="{{ url('/tanah/create') }}" onclick="modalAction(this)">Tambah Data</button>
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
                        <select class="form-control" id="tanah_filter" name="tanah_filter">
                            <option value="">- Semua -</option>
                            @foreach($lokasi as $item)
                        <option value="{{ $item->id_lokasi }}">{{ $item->kota_kab_lokasi }}</option>
                        @endforeach
                        </select>
                        <small class="form-text text-muted">Filter berdasarkan kota / kabupaten</small>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-bordered table-striped table-hover table-sm" id="table_tanah">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Tanah</th>
                    <th>Alamat Tanah</th>
                    <th>Kota / Kab</th>
                    <th>No Kavling</th>
                    <th>Panjang Tanah</th>
                    <th>Lebar Tanah</th>
                    <th>Harga</th>
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
var dataTanah;
    $(document).ready(function() {
         dataTanah = $('#table_tanah').DataTable({
            serverSide: true,
            ajax: {
                "url": "{{ url('tanah/list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function(d) {
                    d.id_tanah = $('#tanah_filter').val();
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
                    data: "kode_tanah",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "lokasi.alamat_lokasi",
                    className: "",
                    orderable: true,
                    searchable: true
                },{
                    data: "lokasi.kota_kab_lokasi",
                    className: "",
                    orderable: true,
                    searchable: true
                },{
                    data: "no_kav_tanah",
                    className: "",
                    orderable: true,
                    searchable: true
                },{
                    data: "panjang_tanah",
                    className: "",
                    orderable: true,
                    searchable: true
                },{
                    data: "lebar_tanah",
                    className: "",
                    orderable: true,
                    searchable: true
                },{
                    data: "harga",
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

        $('#tanah_filter').on('change', function() {
            dataTanah.reload();
        });
    });
</script>
@endpush