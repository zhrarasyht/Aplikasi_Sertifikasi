<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Aplikasi Sertifikasi</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: white;
            padding: 20px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .logo {
            font-size: 18px;
            font-weight: bold;
            color: #2563eb;
        }

        .nav a {
            text-decoration: none;
            margin-left: 10px;
            padding: 10px 18px;
            border-radius: 6px;
            font-size: 14px;
        }

        .login {
            color: #2563eb;
            border: 1px solid #2563eb;
        }

        .register {
            background: #2563eb;
            color: white;
        }

        .register:hover,
        .main-button:hover {
            background: #1d4ed8;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 60px 20px;
        }

        .welcome-content {
            max-width: 750px;
        }

        .icon {
            font-size: 60px;
            margin-bottom: 15px;
        }

        h1 {
            font-size: 36px;
            line-height: 1.4;
            margin: 10px 0 20px;
        }

        .highlight {
            color: #2563eb;
        }

        .description {
            color: #64748b;
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .main-button {
            display: inline-block;
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 7px;
            font-weight: bold;
        }

        footer {
            background: white;
            color: #64748b;
            text-align: center;
            padding: 18px;
            font-size: 13px;
        }

        @media (max-width: 600px) {
            header {
                padding: 18px 5%;
            }

            .logo {
                font-size: 14px;
            }

            .nav a {
                padding: 9px 10px;
                margin-left: 3px;
            }

            h1 {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>

    <header>
        <div class="logo">
            Sertifikasi Online
        </div>

        <div class="nav">
            <a href="{{ route('login') }}" class="login">
                Login
            </a>

            <a href="{{ route('register') }}" class="register">
                Register
            </a>
        </div>
    </header>

    <main>
        <div class="welcome-content">

            <h1>
                Selamat Datang di
                <span class="highlight">
                    Aplikasi Pengelolaan Data Peserta Sertifikasi
                </span>
            </h1>

            <p class="description">
                Aplikasi ini membantu pengelolaan data peserta dan skema
                sertifikasi secara lebih mudah, terstruktur, dan efisien.
                Silakan login jika sudah memiliki akun atau register
                untuk membuat akun baru.
            </p>
        </div>
    </main>

    <footer>
        &copy; {{ date('Y') }} Aplikasi Pengelolaan Data Peserta Sertifikasi
    </footer>

</body>

</html>
