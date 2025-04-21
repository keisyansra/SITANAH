<form action="{{ url('/penjualan/store') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penjualan Tanah Makam</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><spanaria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kode Penjualan</label>
                    <input value="" type="text" name="kode_penjualan" id="kode_penjualan" class="form-control"required>
                    <small id="error-kode_penjualan" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Nama Nasabah</label>
                    <select name="id_nasabah" id="id_nasabah" class="form-control" required>
                        <option value="">- Pilih Nasabah -</option>
                        @foreach($nasabah as $n)
                        <option value="{{ $n->id_nasabah }}" data-telp="{{ $n->telp_nasabah }}">{{ $n->nama_nasabah }}</option>
                        @endforeach
                    </select>
                    <small id="error-id_lokasi" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Telp Nasabah</label>
                    <input type="text" id="telp_nasabah" class="form-control" readonly>
                    {{-- <small id="error-id_lokasi" class="error-text form-text text-danger"></small> --}}
                </div>
                <div class="form-group">
                    <label>No Kavling</label>
                    <select name="id_tanah" id="id_tanah" class="form-control" required>
                        <option value="">- Pilih Kavling -</option>
                        @foreach($tanah as $t)
                        <option value="{{ $t->id_tanah }}" data-harga="{{ $t->harga }}">{{ $t->no_kav_tanah }}</option>
                        @endforeach
                    </select>
                    <small id="error-id_lokasi" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" id="harga" class="form-control" readonly>
                    {{-- <small id="error-id_lokasi" class="error-text form-text text-danger"></small> --}}
                </div> 
                <div class="form-group">
                    <label>Pembayaran</label>
                    <select name="pembayaran" id="pembayaran" class="form-control" required>
                        <option value="" disabled selected>Pilih metode pembayaran</option>
                        <option value="CASH">CASH</option>
                        <option value="Debit">Debit</option>
                        <option value="Kredit">Kredit</option>
                    </select>
                    <small id="error-pembayaran" class="error-text form-text text-danger"></small>
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
        $('#id_nasabah').on('change', function(){
            var telp = $(this).find(':selected').data('telp');
            $('#telp_nasabah').val(telp || '');
        });
        $('#id_tanah').on('change', function(){
            var harga = $(this).find(':selected').data('harga');
            $('#harga').val(harga || '');
        });
        $("#form-tambah").validate({
            rules: {
                kode_penjualan: {
                    required: true,
                    minlength: 2,
                    maxlength: 100
                },
                id_nasabah: {
                    required: true,
                    number: true
                },
                id_tanah: {
                    required: true,
                    number: true
                },
                pembayaran: {
                    required: true,
                    maxlength: 100
                },
            },
            messages: {
                kode_penjualan: {
                    required : "Kode penjualan wajib diisi",
                    minlength: "Kode penjualan minimal 2 karakter",
                    maxlength: "Kode penjualan maksimal 10 karakter"
                },
                id_nasabah: {
                    required : "Kolom ini wajib diisi", 
                },
                id_tanah: { 
                    required : "Kolom ini wajib diisi", 
                },
                pembayaran: {
                    required : "Pembayaran wajib diisi",
                    minlength: "Pembayaran minimal 2 karakter",
                    maxlength: "Pembayaran maksimal 10 karakter"
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
                            dataPenjualan.ajax.reload();
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