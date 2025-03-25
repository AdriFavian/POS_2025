<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 Forbidden - {{ config('app.name', 'Aplikasi Anda') }}</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Share+Tech+Mono|Montserrat:700" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- AdminLTE style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
            box-sizing: border-box;
            color: inherit;
        }

        body {
            background-image: linear-gradient(120deg, #4f0088 0%, #000000 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        h1 {
            font-size: 20vw;
            color: rgba(255, 255, 255, 0.2);
            text-shadow: 0 0 50px rgba(0, 0, 0, 0.07);
            font-family: "Montserrat", monospace;
        }

        .error-container {
            background: rgba(0, 0, 0, 0.6);
            padding: 30px;
            border-radius: 10px;
            max-width: 80%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            z-index: 3;
        }

        .error-container p {
            font-family: "Share Tech Mono", monospace;
            color: #f5f5f5;
            margin-bottom: 10px;
            font-size: 16px;
            line-height: 1.4;
        }

        span {
            color: #f0c674;
        }

        i {
            color: #8abeb7;
        }

        b {
            color: #81a2be;
        }

        .btn-dashboard {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #e5e5ff;
            background-color: #300686;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s ease-in-out;
        }

        .btn-dashboard:hover {
            background-color: #1a0e34;
        }

        .avatar {
            position: fixed;
            bottom: 15px;
            right: -100px;
            animation: slide 0.5s 4.5s forwards;
            z-index: 4;
        }

        .avatar img {
            border-radius: 50%;
            width: 44px;
            border: 2px solid white;
        }

        @keyframes slide {
            from {
                right: -100px;
                transform: rotate(360deg);
                opacity: 0;
            }
            to {
                right: 15px;
                transform: rotate(0deg);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <h1>403</h1>
    <div class="error-container">
        <p>> <span>ERROR CODE</span>: "<i>HTTP 403 Forbidden</i>"</p>
        <p>> <span>ERROR DESCRIPTION</span>: "<i>Access Denied. Anda tidak diizinkan untuk mengakses halaman ini.</i>"</p>
        <p>> <span>POSSIBLE CAUSES</span>: [<b>kepo bgt 🤔</b>]</p>
    </div>
    <a href="{{ url('/') }}" class="btn-dashboard">Kembali ke Dashboard</a>

    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

    <script>
        var text = document.querySelector('.error-container').innerHTML;
        var i = 0;
        document.querySelector('.error-container').innerHTML = "";

        setTimeout(function() {
            var typingEffect = setInterval(function() {
                i++;
                document.querySelector('.error-container').innerHTML = text.slice(0, i) + "|";
                if (i === text.length) {
                    clearInterval(typingEffect);
                    document.querySelector('.error-container').innerHTML = text;
                }
            }, 10);
        }, 500);
    </script>
</body>
</html>
