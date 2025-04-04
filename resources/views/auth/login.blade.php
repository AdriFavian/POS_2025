@extends('layouts.auth')

@section('content')
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ url('/') }}" class="h1">POS System</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in</p>
                <form action="{{ url('login') }}" method="POST" id="form-login">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <small id="error-username" class="error-text text-danger"></small>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <a href="#" class="toggle-password" data-target="#password">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                        <small id="error-password" class="error-text text-danger"></small>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">Ingat saya</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                    </div>
                </form>
                <p class="mb-0 mt-3">
                    Belum punya akun?<a href="{{ url('register') }}" class="text-center"> Buat akun sekarang</a>
                </p>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            $(document).ready(function () {
                $('.toggle-password').on('click', function (e) {
                    e.preventDefault();
                    var targetInput = $($(this).data('target'));
                    var icon = $(this).find('i');
                    if (targetInput.attr('type') === 'password') {
                        targetInput.attr('type', 'text');
                        icon.removeClass('fa-eye').addClass('fa-eye-slash');
                    } else {
                        targetInput.attr('type', 'password');
                        icon.removeClass('fa-eye-slash').addClass('fa-eye');
                    }
                });

                $("#form-login").validate({
                    rules: {
                        username: {
                            required: true,
                            minlength: 4,
                            maxlength: 20
                        },
                        password: {
                            required: true,
                            minlength: 6,
                            maxlength: 20
                        }
                    },
                    submitHandler: function (form) {
                        $.ajax({
                            url: form.action,
                            type: form.method,
                            data: $(form).serialize(),
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Login berhasil! Anda akan segera diarahkan...',
                                        text: response.message,
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then(function () {
                                        window.location = response.redirect;
                                    });
                                } else {
                                    $('.error-text').text('');
                                    if (response.msgField) {
                                        $.each(response.msgField, function (prefix, val) {
                                            $('#error-' + prefix).text(val[0]);
                                        });
                                    }
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops! Ada yang salah.',
                                        text: response.message
                                    });
                                }
                            },
                            error: function (xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops! Ada yang salah.',
                                    text: 'Tidak dapat terhubung ke server. Silakan coba beberapa saat lagi.'
                                });
                            }
                        });
                        return false;
                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.input-group').append(error);
                    },
                    highlight: function (element) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element) {
                        $(element).removeClass('is-invalid');
                    }
                });
            });
        </script>
    @endpush
@endsection