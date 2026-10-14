<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Aplikasi Sertifikasi</title>

    <style>
        * * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 25px;
        }

        .login-box {
            background: white;
            width: 100%;
            max-width: 500px;
            padding: 45px;
            border-radius: 14px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        h2 {
            text-align: center;
            color: #1e293b;
            font-size: 28px;
            margin-top: 0;
            margin-bottom: 15px;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 32px;
        }

        label {
            display: block;
            margin-bottom: 9px;
            font-weight: bold;
            font-size: 15px;
            color: #334155;
        }

        input {
            width: 100%;
            padding: 14px;
            margin-bottom: 22px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            font-size: 16px;
        }

        input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
        }

        button {
            width: 100%;
            padding: 14px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 7px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }

        button:hover {
            background: #2563eb;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .success {
            color: #15803d;
            font-size: 14px;
            text-align: center;
            margin-top: 15px;
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            font-size: 15px;
            color: #64748b;
        }

        .register-link a {
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .login-box {
                padding: 28px 24px;
            }

            h2 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

    <div class="login-box">
        <h2>Login Aplikasi Sertifikasi</h2>

        <p class="subtitle">
            Aplikasi Pengelolaan Data Peserta Sertifikasi
        </p>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email"
                required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan password" required>

            <button type="submit">Login</button>
        </form>

        <div class="register-link">
            Belum punya akun?
            <a href="{{ route('register') }}">Register</a>
        </div>
    </div>

</body>

</html>
