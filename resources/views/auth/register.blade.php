{{-- @extends('layouts.auth')

@section('content')
<div class="register-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{ url('/') }}" class="h1">POS System</a>
        </div>
        <div class="card-body">
            <form action="{{ route('register.post') }}" method="POST" id="form-register">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username"
                        value="{{ old('username') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <span class="error-text text-danger" id="error-username"></span>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap"
                        value="{{ old('nama') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-id-card"></span>
                        </div>
                    </div>
                    <span class="error-text text-danger" id="error-nama"></span>
                </div>
                <div class="input-group mb-3">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                        required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <a href="#" class="toggle-password" data-target="#password">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    <span class="error-text text-danger" id="error-password"></span>
                </div>
                <div class="input-group mb-3">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                        placeholder="Konfirmasi Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <a href="#" class="toggle-password" data-target="#password_confirmation">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    <span class="error-text text-danger" id="error-password_confirmation"></span>
                </div>
                <button type="submit" class="btn btn-primary btn-block"
                    style="border-radius: 120px; margin-top: 10%; background-color: rgb(41, 184, 41); border-color: white;">Daftar</button>
            </form>
            <p class="mb-0 mt-3">
                Sudah punya akun?<a href="{{ url('login') }}" class="text-center"> Masuk di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.auth')

@section('content')
<div class="register-box">
    <div class="card">
        <div class="card-body register-card-body">
            <div class="register-logo mb-4">
                <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="Logo" class="brand-image"
                    style="opacity: .8; width: 80px;">
                <h4 class="mt-3">Daftar Akun Baru</h4>
            </div>

            <form action="{{ route('register.post') }}" method="POST" id="form-register">
                @csrf
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="username" class="form-control custom-input" placeholder="Username"
                            value="{{ old('username') }}">
                        <div class="input-group-append">
                            <div class="input-group-text custom-input-icon">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <small class="error-text text-danger" id="error-username"></small>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="nama" class="form-control custom-input" placeholder="Nama Lengkap"
                            value="{{ old('nama') }}">
                        <div class="input-group-append">
                            <div class="input-group-text custom-input-icon">
                                <span class="fas fa-id-card"></span>
                            </div>
                        </div>
                    </div>
                    <small class="error-text text-danger" id="error-nama"></small>
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
                    <small class="error-text text-danger" id="error-password"></small>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control custom-input" placeholder="Konfirmasi Password">
                        <div class="input-group-append">
                            <div class="input-group-text custom-input-icon">
                                <a href="#" class="toggle-password" data-target="#password_confirmation">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <small class="error-text text-danger" id="error-password_confirmation"></small>
                </div>

                <button type="submit" class="btn btn-primary btn-block custom-button">
                    Daftar Sekarang
                </button>
            </form>

            <p class="mt-3 text-center">
                Sudah punya akun? <a href="{{ url('login') }}" class="custom-link">Masuk</a>
            </p>
        </div>
    </div>
</div>
@endsection

@push('css')
    <style>
        .register-box {
            width: 400px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .register-card-body {
            padding: 30px;
            border-radius: 15px;
        }

        .register-logo {
            text-align: center;
        }

        .register-logo h4 {
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
            margin-top: 10px;
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

        .form-group {
            margin-bottom: 1.5rem;
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

            $("#form-register").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 4,
                        maxlength: 20
                    },
                    nama: {
                        required: true
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 20
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    username: {
                        required: "Username wajib diisi",
                        minlength: "Username minimal 4 karakter",
                        maxlength: "Username maksimal 20 karakter"
                    },
                    nama: "Nama lengkap wajib diisi",
                    password: {
                        required: "Password wajib diisi",
                        minlength: "Password minimal 6 karakter",
                        maxlength: "Password maksimal 20 karakter"
                    },
                    password_confirmation: {
                        required: "Konfirmasi password wajib diisi",
                        equalTo: "Konfirmasi password tidak cocok"
                    }
                },
                onkeyup: function (element) {
                    $(element).valid();
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
                },
                submitHandler: function (form) {
                    // Clear error messages
                    $('.error-text').text('');
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function (response) {
                            if (response.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Registrasi Berhasil',
                                    text: response.message,
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(function () {
                                    window.location = response.redirect;
                                });
                            } else {
                                if (response.msgField) {
                                    $.each(response.msgField, function (prefix, val) {
                                        $('#error-' + prefix).text(val[0]);
                                    });
                                }
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal Registrasi',
                                    text: response.message
                                });
                            }
                        },
                        error: function (xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan pada server'
                            });
                        }
                    });
                    return false;
                }
            });
        });
    </script>
@endpush