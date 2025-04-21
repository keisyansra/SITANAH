@empty($user)
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
            <a href="{{ url('/user') }}" class="btn btn-warning">Kembali</a>
        </div>
    </div>
</div>
@else
<form action="{{ url('/user/' . $user->id_user . '/update') }}" method="POST" id="form-edit-user">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama User</label>
                    <input value="{{ $user->nama_user}}" type="text" name="nama_user" id="nama_user" class="form-control"required>
                    <small id="error-nama_user" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Username User</label>
                    <input value="{{ $user->username_user}}" type="text" name="username_user" id="username_user" class="form-control"required>
                    <small id="error-username_user" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input value="{{$user->password_user}}" type="password" name="password_user" id="password_user" class="form-control" required>
                    <small id="error-password" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">  
                    <label>Role</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="" disabled selected>{{$user->role}}</option>
                            <option value="admin" {{ $user->role == 'Admin' ? 'selected' : ''}}>Admin</option>
                            <option value="kasir" {{ $user->role == 'Kasir' ? 'selected' : '' }}>Kasir</option>
                        </select>
                    <small id="error-role" class="error-text form-text text-danger"></small>
                </div>
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
        $("#form-edit-user").validate({
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
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataUser.reload();
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