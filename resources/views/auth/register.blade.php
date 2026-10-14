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
            padding: 30px 15px;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .register-box {
            background: white;
            width: 850px;
            max-width: 100%;
            padding: 30px 35px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #1e293b;
            margin: 0 0 10px;
            font-size: 27px;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            column-gap: 30px;
            align-items: start;
        }

        .form-section {
            min-width: 0;
        }

        .section-title {
            color: #2563eb;
            font-size: 16px;
            margin: 5px 0 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #dbeafe;
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
            padding: 11px;
            margin-bottom: 17px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            background: white;
            color: #334155;
        }

        textarea {
            resize: vertical;
            min-height: 85px;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.15);
        }

        .register-button {
            grid-column: 1 / -1;
            margin-top: 8px;
        }

        button {
            width: 100%;
            padding: 13px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            font-weight: bold;
            transition: background 0.2s;
        }

        button:hover {
            background: #2563eb;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
            margin-bottom: 15px;
            padding: 10px 14px;
            background: #fef2f2;
            border-radius: 6px;
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
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .register-box {
                padding: 25px 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .register-button {
                grid-column: auto;
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

            <div class="form-grid">

                <div class="form-section">
                    <h3 class="section-title">Data Akun</h3>

                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        placeholder="Masukkan email" required>

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Minimal 8 karakter"
                        minlength="8" required>
                </div>

                <div class="form-section">
                    <h3 class="section-title">Data Peserta</h3>

                    <label for="nisn">NISN</label>
                    <input type="text" id="nisn" name="nisn" value="{{ old('nisn') }}"
                        placeholder="Masukkan 10 digit NISN" inputmode="numeric" maxlength="10" pattern="[0-9]{10}"
                        required>

                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                            Laki-laki
                        </option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>
                    </select>

                    <label for="no_telepon">Nomor Telepon</label>
                    <input type="tel" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}"
                        placeholder="Masukkan nomor telepon" maxlength="13" pattern="[0-9]{1,13}" inputmode="numeric">

                    <label for="alamat">Alamat</label>
                    <textarea id="alamat" name="alamat" placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>

                    <label for="skema_sertifikasi_id">Skema Sertifikasi</label>
                    <select id="skema_sertifikasi_id" name="skema_sertifikasi_id" required>
                        <option value="">-- Pilih Skema Sertifikasi --</option>

                        @foreach ($skemas as $skema)
                            <option value="{{ $skema->id }}"
                                {{ old('skema_sertifikasi_id') == $skema->id ? 'selected' : '' }}>
                                {{ $skema->kode_skema }} - {{ $skema->nama_skema }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="register-button">
                    <button type="submit">Register</button>
                </div>

            </div>
        </form>

        <div class="login-link">
            Sudah punya akun?
            <a href="{{ route('login') }}">Login</a>
        </div>
    </div>

</body>

</html>
