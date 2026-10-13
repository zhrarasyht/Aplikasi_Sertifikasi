```html
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Aplikasi Sertifikasi</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 20px;
        }

        .register-box {
            background: white;
            width: 100%;
            max-width: 850px;
            padding: 35px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #1e293b;
            margin: 0 0 10px;
            font-size: 28px;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            margin: 0 0 28px;
            line-height: 1.5;
        }

        .section-title {
            font-size: 16px;
            color: #334155;
            margin: 10px 0 18px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            column-gap: 24px;
            row-gap: 0;
        }

        .form-group {
            min-width: 0;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            color: #334155;
            font-size: 14px;
        }

        input,
        select,
        textarea {
            display: block;
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            background: white;
        }

        textarea {
            resize: vertical;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #6094e8;
            box-shadow: 0 0 0 2px rgba(96, 148, 232, 0.15);
        }

        button {
            width: 100%;
            padding: 13px;
            background: #6094e8;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
            font-weight: bold;
            transition: background 0.2s;
        }

        button:hover {
            background: #4178d0;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
            margin-bottom: 18px;
            padding: 10px 14px;
            background: #fef2f2;
            border-radius: 5px;
        }

        .error p {
            margin: 5px 0;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #64748b;
        }

        .login-link a {
            color: #4178d0;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            body {
                align-items: flex-start;
                padding: 20px 12px;
            }

            .register-box {
                padding: 25px 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                column-gap: 0;
            }

            .full-width {
                grid-column: auto;
            }

            h2 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

    <div class="register-box">
        <h2>Register</h2>

        <p class="subtitle">
            Aplikasi Pengelolaan Data Peserta Sertifikasi
        </p>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register.process') }}" method="POST">
            @csrf

            <h3 class="section-title">Informasi Akun</h3>

            <div class="form-grid">
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap"
                        maxlength="255"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email"
                        required
                    >
                </div>

                <div class="form-group full-width">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Minimal 8 karakter"
                        minlength="8"
                        required
                    >
                </div>
            </div>

            <h3 class="section-title">Data Peserta</h3>

            <div class="form-grid">
                <div class="form-group">
                    <label for="nisn">NISN</label>
                    <input
                        type="text"
                        id="nisn"
                        name="nisn"
                        value="{{ old('nisn') }}"
                        placeholder="Masukkan 10 digit NISN"
                        inputmode="numeric"
                        pattern="[0-9]{10}"
                        maxlength="10"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki"
                            {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                            Laki-laki
                        </option>
                        <option value="Perempuan"
                            {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="no_telepon">Nomor Telepon</label>
                    <input
                        type="tel"
                        id="no_telepon"
                        name="no_telepon"
                        value="{{ old('no_telepon') }}"
                        placeholder="Masukkan nomor telepon"
                        inputmode="numeric"
                        pattern="[0-9]{1,13}"
                        maxlength="13"
                    >
                </div>

                <div class="form-group">
                    <label for="skema_sertifikasi_id">Skema Sertifikasi</label>
                    <select
                        id="skema_sertifikasi_id"
                        name="skema_sertifikasi_id"
                        required
                    >
                        <option value="">-- Pilih Skema Sertifikasi --</option>

                        @foreach ($skemas as $skema)
                            <option
                                value="{{ $skema->id }}"
                                {{ old('skema_sertifikasi_id') == $skema->id ? 'selected' : '' }}
                            >
                                {{ $skema->nama_skema }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group full-width">
                    <label for="alamat">Alamat</label>
                    <textarea
                        id="alamat"
                        name="alamat"
                        rows="3"
                        placeholder="Masukkan alamat"
                    >{{ old('alamat') }}</textarea>
                </div>
            </div>

            <button type="submit">Register</button>
        </form>

        <div class="login-link">
            Sudah punya akun?
            <a href="{{ route('login') }}">Login</a>
        </div>
    </div>

</body>

</html>