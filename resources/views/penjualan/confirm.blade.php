@empty($penjualan)
<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger">
                <h5><i class="icon fas fa-ban"></i> Kesalahan </h5>
                Data yang anda cari tidak ditemukan
            </div>
            <a href="{{ url('/penjualan') }}" class="btn btn-warning">Kembali</a>
        </div>
    </div>
</div>
@else
<form action="{{ url('/penjualan/' . $penjualan->id_penjualan . '/delete') }}" method="POST" id="form-delete-penjualan">
    @csrf
    @method('DELETE')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Penjualan Tanah Makam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <h5><i class="icon fas fa-ban"></i> Konfirmasi </h5>
                    Apakah Anda ingin menghapus data di bawah ini?
                </div>
                <table class="table table-sm table-bordered table-striped">
                <tr>
                        <th class="text-right col-3">Kode Penjualan :</th>
                        <td class="col-9">{{ $penjualan->kode_penjualan }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Nama Nasabah :</th>
                        <td class="col-9">{{ $penjualan->nasabah->nama_nasabah }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Telepon Nasabah :</th>
                        <td class="col-9">{{ $penjualan->nasabah->telp_nasabah }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">No Kavling :</th>
                        <td class="col-9">{{ $penjualan->tanah->no_kav_tanah }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Harga :</th>
                        <td class="col-9">{{ $penjualan->tanah->harga }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Pembayaran :</th>
                        <td class="col-9">{{ $penjualan->pembayaran }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Ya, Hapus</button>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $("#form-delete-penjualan").validate({
            rules: {
                'kode_penjualan' : { required: true, minlength: 2, maxlength: 100},
                'id_nasabah' : { required: true, numeric: true},
                'id_tanah' : { required: true, numeric: true},
                'pembayaran' : { required: true, minlength: 2, maxlength: 100},
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataPenjualan.reload();
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endempty