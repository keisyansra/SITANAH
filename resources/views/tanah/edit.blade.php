@if(empty($tanah))
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
<form action="{{ url('/tanah/' . $tanah->id_tanah . '/update') }}" method="POST" id="form-edit-tanah">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Tanah Makam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kode Tanah</label>
                    <input value="{{ $tanah->kode_tanah }}" type="text" name="kode_tanah" id="kode_tanah" class="form-control" required>
                    <small id="error-kode_tanah" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Alamat Tanah</label>
                    <select name="id_lokasi" id="id_lokasi" class="form-control" required>
                        <option value="">- Pilih Alamat -</option>
                        @foreach($lokasi as $l)
                        <option value="{{ $l->id_lokasi }}" data-kota="{{ $l->kota_kab_lokasi }}" 
                            {{ $tanah->id_lokasi == $l->id_lokasi ? 'selected' : ''}}>{{ $l->alamat_lokasi }}</option>
                        @endforeach
                    </select>
                    <small id="error-id_lokasi" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Kota / Kab</label>
                    <input type="text" id="kota_kab_lokasi" class="form-control" readonly>
                    {{-- <small id="error-id_lokasi" class="error-text form-text text-danger"></small> --}}
                </div>
                <div class="form-group">
                    <label>No Kavling</label>
                    <input value="{{ $tanah->no_kav_tanah }}" type="number" name="no_kav_tanah" id="no_kav_tanah" class="form-control" required>
                    <small id="error-no_kav_tanah" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Panjang Tanah</label>
                    <input value="{{ $tanah->panjang_tanah }}" type="text" name="panjang_tanah" id="panjang_tanah" class="form-control" required>
                    <small id="error-panjang_tanah" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Lebar Tanah</label>
                    <input value="{{ $tanah->lebar_tanah }}" type="text" name="lebar_tanah" id="lebar_tanah" class="form-control" required>
                    <small id="error-lebar_tanah" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input value="{{ $tanah->harga }}" type="text" name="harga" id="harga" class="form-control" required>
                    <small id="error-harga" class="error-text form-text text-danger"></small>
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
        $('#id_lokasi').on('change', function() {
            var kota = $(this).find(":selected").data('kota');
            $('#kota_kab_lokasi').val(kota || '');
        });
        $('#id_lokasi').trigger('change');
        $("#form-edit-tanah").validate({
            rules: {
                kode_tanah: {
                    required: true,
                    minlength: 2,
                    maxlength: 100
                },
                id_lokasi: {
                    required: true,
                    number: true
                },
                no_kav_tanah: {
                    required: true,
                    maxlength: 100
                },
                panjang_tanah: {
                    required: true,
                    minlength: 2,
                    maxlength: 100
                },
                lebar_tanah: {
                    required: true,
                    minlength: 2,
                    maxlength: 100
                },
                harga: {
                    required: true,
                    minlength: 2,
                    maxlength: 100
                },
            },
            messages: {
                kode_tanah: {
                    required : "Kode tanah wajib diisi",
                    minlength: "Kode tanah minimal 2 karakter",
                    maxlength: "Kode tanah maksimal 10 karakter"
                },
                id_lokasi: {
                    required : "Kolom ini wajib diisi", 
                },
                no_kav_tanah: {
                    required : "No kavling wajib diisi",
                    minlength: "No kavling minimal 2 karakter",
                    maxlength: "No kavling maksimal 10 karakter"
                },
                panjang_tanah: {
                    required : "Panjang tanah wajib diisi",
                    minlength: "No kavling minimal 2 karakter",
                    maxlength: "Panjang tanah maksimal 10 karakter"
                },
                lebar_tanah: {
                    required : "Lebar tanah wajib diisi",
                    minlength: "No kavling minimal 2 karakter",
                    maxlength: "Lebar tanah maksimal 10 karakter"
                },
                harga: {
                    required : "Harga wajib diisi",
                    minlength: "No kavling minimal 2 karakter",
                    number   : "Masukkan angka dengan benar"
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
                            dataTanah.ajax.reload();
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