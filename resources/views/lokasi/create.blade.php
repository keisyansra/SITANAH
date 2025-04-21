<form action="{{ url('/lokasi/store') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Lokasi Tanah Makam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><spanaria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kode Lokasi</label>
                    <input value="" type="text" name="kode_lokasi" id="kode_lokasi" class="form-control"required>
                    <small id="error-kode_lokasi" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input value="" type="text" name="alamat_lokasi" id="alamat_lokasi" class="form-control"required>
                    <small id="error-alamat_lokasi" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Kelurahan</label>
                    <input value="" type="text" name="kelurahan_lokasi" id="kelurahan_lokasi" class="form-control"required>
                    <small id="error-kelurahan_lokasi" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Kecamatan</label>
                    <input value="" type="text" name="kecamatn_lokasi" id="kecamatn_lokasi" class="form-control"required>
                    <small id="error-kecamatn_lokasi" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Kota / Kabupaten</label>
                    <input value="" type="text" name="kota_kab_lokasi" id="kota_kab_lokasi" class="form-control"required>
                    <small id="error-kota_kab_lokasi" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Provinsi</label>
                    <input value="" type="text" name="provinsi_lokasi" id="provinsi_lokasi" class="form-control"required>
                    <small id="error-provinsi_lokasi" class="error-text form-text text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    {{-- </div> --}}
</form>
<script>
    $(document).ready(function() {
        $("#form-tambah").validate({
            rules: {
                kode_lokasi: {
                    required: true,
                    minlength: 2,
                    // maxlength: 100
                },
                alamat_lokasi: {
                    required: true,
                    minlength: 2,
                    // maxlength: 100
                },
                kelurahan_lokasi: {
                    required: true,
                    minlength: 2,
                    // maxlength: 100
                },
                kecamatn_lokasi: {
                    required: true,
                    minlength: 2,
                    // maxlength: 100
                },
                kota_kab_lokasi: {
                    required: true,
                    minlength: 2,
                    // maxlength: 100
                },
                provinsi_lokasi: {
                    required: true,
                    minlength: 2,
                    // maxlength: 100
                },
            },
            messages: {
                kode_lokasi: {
                    required : "Kode lokasi wajib diisi",
                    minlength: "Kode lokasi minimal 2 karakter",
                },
                alamat_lokasi: {
                    required : "Alamat lokasi wajib diisi",
                    minlength: "Alamat lokasi minimal 2 karakter",
                },
                kelurahan_lokasi: {
                    required : "Kelurahan lokasi wajib diisi",
                    minlength: "Kelurahan lokasi minimal 2 karakter",
                },
                kecamatn_lokasi: {
                    required : "Kecamatan lokasi wajib diisi",
                    minlength: "Kecamatan lokasi minimal 2 karakter",
                },
                kota_kab_lokasi: {
                    required : "Kota / Kabupaten lokasi wajib diisi",
                    minlength: "Kota / Kabupaten lokasi minimal 2 karakter",
                },
                provinsi_lokasi: {
                    required : "Provinsi lokasi wajib diisi",
                    minlength: "Provinsi lokasi minimal 2 karakter",
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
                            dataLokasi.ajax.reload();
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
</script