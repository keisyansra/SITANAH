<form action="{{ url('/nasabah/store') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Nasabah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><spanaria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kode Nasabah</label>
                    <input value="" type="text" name="kode_nasabah" id="kode_nasabah" class="form-control"required>
                    <small id="error-kode_nasabah" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input value="" type="text" name="nama_nasabah" id="nama_nasabah" class="form-control"required>
                    <small id="error-nama_nasabah" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Alamat Lengkap</label>
                    <input value="" type="text" name="alamat_nasabah" id="alamat_nasabah" class="form-control"required>
                    <small id="error-alamat_nasabah" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <input value="" type="text" name="telp_nasabah" id="telp_nasabah" class="form-control"required>
                    <small id="error-telp_nasabah" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Nama Kerabat</label>
                    <input value="" type="text" name="nama_kerabat_nasabah" id="nama_kerabat_nasabah" class="form-control"required>
                    <small id="error-nama_kerabat_nasabah" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Telp Kerabat</label>
                    <input value="" type="text" name="telp_kerabat_nasabah" id="telp_kerabat_nasabah" class="form-control"required>
                    <small id="error-telp_kerabat_nasabah" class="error-text form-text text-danger"></small>
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
                kode_nasabah: {
                    required: true,
                    minlength: 2,
                    maxlength: 100
                },
                nama_nasabah: {
                    required: true,
                    minlength: 2,
                    maxlength: 100
                },
                alamat_nasabah: {
                    required: true,
                    minlength: 2,
                    maxlength: 100
                },
                telp_nasabah: {
                    required: true,
                    minlength: 10,
                    maxlength: 100
                },
                nama_kerabat_nasabah: {
                    required: true,
                    minlength: 2,
                    maxlength: 100
                },
                telp_kerabat_nasabah: {
                    required: true,
                    minlength: 10,
                    maxlength: 100
                },
            },
            messages: {
                kode_nasabah: {
                    required : "Kode nasabah wajib diisi",
                    minlength: "Kode nasabah minimal 2 karakter",
                    maxlength: "Kode nasabah maksimal 10 karakter"
                },
                nama_nasabah: {
                    required : "Nama nasabah wajib diisi",
                    minlength: "Nama nasabah minimal 2 karakter",
                    maxlength: "Nama nasabah maksimal 10 karakter"
                },
                alamat_nasabah: {
                    required : "Alamat nasabah wajib diisi",
                    minlength: "Alamat nasabah minimal 2 karakter",
                    maxlength: "Alamat nasabah maksimal 10 karakter"
                },
                telp_nasabah: {
                    required : "Telepon nasabah wajib diisi",
                    minlength: "Telepon nasabah minimal 2 karakter",
                    maxlength: "Telepon nasabah maksimal 10 karakter"
                },
                nama_kerabat_nasabah: {
                    required : "Nama kerabat wajib diisi",
                    minlength: "Nama kerabat minimal 2 karakter",
                    maxlength: "Nama kerabat maksimal 10 karakter"
                },
                telp_kerabat_nasabah: {
                    required : "Telepon kerabat wajib diisi",
                    minlength: "Telepon kerabat minimal 2 karakter",
                    maxlength: "Telepon kerabat maksimal 10 karakter"
                },
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        console.log(response)
                        if (response.status) {
                            $('#myModal').modal('show');
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