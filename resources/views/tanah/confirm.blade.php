@empty($tanah)
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
            <a href="{{ url('/tanah') }}" class="btn btn-warning">Kembali</a>
        </div>
    </div>
</div>
@else
<form action="{{ url('/tanah/' . $tanah->id_tanah . '/delete') }}" method="POST" id="form-delete-tanah">
    @csrf
    @method('DELETE')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Tanah Makam</h5>
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
                        <th class="text-right col-3">Kode Tanah :</th>
                        <td class="col-9">{{ $tanah->kode_tanah }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Alamat Tanah :</th>
                        <td class="col-9">{{ $tanah->lokasi->alamat_lokasi }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Kota/Kab :</th>
                        <td class="col-9">{{ $tanah->lokasi->kota_kab_lokasi }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">No Kavling :</th>
                        <td class="col-9">{{ $tanah->no_kav_tanah }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Panjang Tanah :</th>
                        <td class="col-9">{{ $tanah->panjang_tanah }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Lebar Tanah :</th>
                        <td class="col-9">{{ $tanah->lebar_tanah }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Harga Tanah :</th>
                        <td class="col-9">{{ $tanah->harga }}</td>
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
        $("#form-delete-tanah").validate({
            rules: {
                'kode_tanah' : { required: true, minlength: 2, maxlength: 100},
                'id_lokasi' : { required: true, number: true},
                'no_kav_tanah' : { required: true, minlength: 2, maxlength: 100},
                'panjang_tanah' : { required: true, minlength: 2, maxlength: 100},
                'lebar_tanah' : { required: true, minlength: 2, maxlength: 100},
                'harga' : { required: true, minlength: 2, maxlength: 100},
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
                            dataTanah.reload();
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