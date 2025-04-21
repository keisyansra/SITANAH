@empty($lokasi)
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
            <a href="{{ url('/lokasi') }}" class="btn btn-warning">Kembali</a>
        </div>
    </div>
</div>
@else
<form action="{{ url('/lokasi/' . $lokasi->id_lokasi . '/update') }}" method="POST" id="form-edit-lokasi">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Lokasi Tanah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kode Lokasi</label>
                    <input value="{{ $lokasi->kode_lokasi }}" type="text" name="kode_lokasi" id="kode_lokasi" class="form-control" required>
                    <small id="error-kode_lokasi" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Alamat Lokasi</label>
                    <input value="{{ $lokasi->alamat_lokasi }}" type="text" name="alamat_lokasi" id="alamat_lokasi" class="form-control" required>
                    <small id="error-alamat_lokasi" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Kelurahan Lokasi</label>
                    <input value="{{ $lokasi->kelurahan_lokasi }}" type="text" name="kelurahan_lokasi" id="kelurahan_lokasi" class="form-control" required>
                    <small id="error-kelurahan_lokasi" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Kecamatan Lokasi</label>
                    <input value="{{ $lokasi->kecamatn_lokasi }}" type="text" name="kecamatn_lokasi" id="kecamatn_lokasi" class="form-control" required>
                    <small id="error-kecamatn_lokasi" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Kota/Kabupaten Lokasi</label>
                    <input value="{{ $lokasi->kota_kab_lokasi }}" type="text" name="kota_kab_lokasi" id="kota_kab_lokasi" class="form-control" required>
                    <small id="error-kota_kab_lokasi" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Provinsi Lokasi</label>
                    <input value="{{ $lokasi->provinsi_lokasi }}" type="text" name="provinsi_lokasi" id="provinsi_lokasi" class="form-control" required>
                    <small id="error-provinsi_lokasi" class="error-text form-text text-danger"></small>
                </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $("#form-edit-nasabah").validate({
            rules: {
                kode_lokasi: {
                    required: true,
                    minlength: 2,
                    maxlength: 100
                },
                alamat_lokasi: {
                    required: true,
                    minlength: 2,
                    maxlength: 100
                },
                kelurahan_lokasi: {
                    required: true,
                    minlength: 2,
                    maxlength: 100
                },
                kecamatn_lokasi: {
                    required: true,
                    minlength: 2,
                    maxlength: 100
                },
                kota_kab_lokasi: {
                    required: true,
                    minlength: 2,
                    maxlength: 100
                },
                provinsi_lokasi: {
                    required: true,
                    minlength: 2,
                    maxlength: 100
                },
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
                            dataNasabah.ajax.reload();
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