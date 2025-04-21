@empty($nasabah)
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
            <a href="{{ url('/nasabah') }}" class="btn btn-warning">Kembali</a>
        </div>
    </div>
</div>
@else
<form action="{{ url('/nasabah/' . $nasabah->id_nasabah . '/update') }}" method="POST" id="form-edit-nasabah">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Nasabah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kode Nasabah</label>
                    <input value="{{ $nasabah->kode_nasabah }}" type="text" name="kode_nasabah" id="kode_nasabah" class="form-control" required>
                    <small id="error-kode_nasabah" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Nama Nasabah</label>
                    <input value="{{ $nasabah->nama_nasabah }}" type="text" name="nama_nasabah" id="nama_nasabah" class="form-control" required>
                    <small id="error-nama_nasabah" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Alamat Nasabah</label>
                    <input value="{{ $nasabah->alamat_nasabah }}" type="text" name="alamat_nasabah" id="alamat_nasabah" class="form-control" required>
                    <small id="error-alamat_nasabah" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Telepon Nasabah</label>
                    <input value="{{ $nasabah->telp_nasabah }}" type="text" name="telp_nasabah" id="telp_nasabah" class="form-control" required>
                    <small id="error-telp_nasabah" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Nama Kerabat</label>
                    <input value="{{ $nasabah->nama_kerabat_nasabah }}" type="text" name="nama_kerabat_nasabah" id="nama_kerabat_nasabah" class="form-control" required>
                    <small id="error-nama_kerabat_nasabah" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Telepon Kerabat</label>
                    <input value="{{ $nasabah->telp_kerabat_nasabah }}" type="text" name="telp_kerabat_nasabah" id="telp_kerabat_nasabah" class="form-control" required>
                    <small id="error-telp_kerabat_nasabah" class="error-text form-text text-danger"></small>
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