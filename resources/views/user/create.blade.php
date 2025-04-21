<form action="{{ url('/user/store') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><spanaria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama User</label>
                    <input value="" type="text" name="nama_user" id="nama_user" class="form-control"required>
                    <small id="error-nama_user" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Username User</label>
                    <input value="" type="text" name="username_user" id="username_user" class="form-control"required>
                    <small id="error-username_user" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input value="" type="password" name="password_user" id="password_user" class="form-control" required>
                    <small id="error-password" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                    </select>
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
                nama_user: {
                    required: true,
                    minlength: 2,
                    maxlength: 100
                },
                username_user: {
                    required: true,
                    minlength: 3,
                    maxlength: 10
                },
                password_user: {
                    required: true,
                    minlength: 6,
                },
                role: {
                    required: true,
                }
            },
            messages: {
                nama_user: {
                    required : "Nama user wajib diisi",
                    minlength: "Nama user minimal 2 karakter",
                    maxlength: "Nama user maksimal 10 karakter"
                },
                username_user: {
                    required : "Username user wajib diisi",
                    minlength: "Username user minimal 3 karakter",
                    maxlength: "Username user maksimal 50 karakter"
                },
                password_user: {
                    required: "Password wajib diisi",
                    minlength: "Password terlalu pendek",
                },
                role: {
                    required : "Role wajib diisi"
                }
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
                            dataUser.ajax.reload();
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