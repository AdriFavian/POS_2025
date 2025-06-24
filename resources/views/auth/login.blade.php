

@extends('layouts.auth')

@section('content')
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <div class="login-logo mb-4">
                    <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="Logo" class="brand-image"
                        style="opacity: .8; width: 80px;">
                    <h4 class="mt-3">POS System</h4>
                </div>

                <form action="{{ url('login') }}" method="POST" id="form-login">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" id="username" name="username" class="form-control custom-input"
                                placeholder="Username">
                            <div class="input-group-append">
                                <div class="input-group-text custom-input-icon">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <small id="error-username" class="error-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control custom-input"
                                placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text custom-input-icon">
                                    <a href="#" class="toggle-password" data-target="#password">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <small id="error-password" class="error-text text-danger"></small>
                    </div>

                    <div class="row mb-3">
                        <div class="col-7">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="remember">
                                <label class="custom-control-label" for="remember">Ingat saya</label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block custom-button">
                        Masuk
                    </button>
                </form>

                <p class="mt-3 text-center">
                    Belum punya akun? <a href="{{ url('register') }}" class="custom-link">Daftar</a>
                </p>
            </div>
        </div>
    </div>
    @endsection
    @push('css')
        <style>
            .login-box {
                width: 360px;
            }

            .card {
                border: none;
                border-radius: 15px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            }

            .login-card-body {
                padding: 30px;
                border-radius: 15px;
            }

            .login-logo {
                text-align: center;
            }

            .login-logo h4 {
                color: #333;
                font-weight: 600;
            }

            .custom-input {
                border-radius: 8px 0 0 8px;
                border: 1px solid #ddd;
                padding: 12px;
                transition: all 0.3s;
            }

            .custom-input:focus {
                border-color: #007bff;
                box-shadow: none;
            }

            .custom-input-icon {
                border-radius: 0 8px 8px 0;
                border: 1px solid #ddd;
                border-left: none;
                background-color: #fff;
            }

            .custom-button {
                padding: 12px;
                border-radius: 8px;
                font-weight: 600;
                background: linear-gradient(45deg, #007bff, #0056b3);
                border: none;
                transition: all 0.3s;
            }

            .custom-button:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
            }

            .custom-link {
                color: #007bff;
                font-weight: 600;
                transition: all 0.3s;
            }

            .custom-link:hover {
                color: #0056b3;
                text-decoration: none;
            }

            .toggle-password {
                color: #6c757d;
            }

            .toggle-password:hover {
                color: #007bff;
            }

            .custom-control-input:checked~.custom-control-label::before {
                background-color: #007bff;
                border-color: #007bff;
            }
        </style>
    @endpush

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


    {{-- @extends('layouts.auth')

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
</div> --}}