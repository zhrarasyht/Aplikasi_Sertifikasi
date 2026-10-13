<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Aplikasi Sertifikasi</title>

    <style>
        /* Mengatur ukuran elemen agar padding dan border masuk dalam ukuran elemen */
        * {
            box-sizing: border-box;
        }

        /* Mengatur tampilan dasar halaman register */
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

        /* Mengatur kotak utama form register */
        .register-box {
            background: white;
            width: 100%;
            max-width: 850px;
            padding: 35px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Mengatur judul halaman register */
        h2 {
            text-align: center;
            color: #1e293b;
            margin: 0 0 10px;
            font-size: 28px;
        }

        /* Mengatur teks penjelasan di bawah judul */
        .subtitle {
            text-align: center;
            color: #64748b;
            margin: 0 0 28px;
            line-height: 1.5;
        }

        /* Mengatur judul bagian informasi akun dan data peserta */
        .section-title {
            font-size: 16px;
            color: #334155;
            margin: 10px 0 18px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
        }

        /* Menyusun input menjadi dua kolom */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            column-gap: 24px;
            row-gap: 0;
        }

        /* Mencegah isi kolom melebihi lebar yang tersedia */
        .form-group {
            min-width: 0;
        }

        /* Membuat elemen memenuhi dua kolom */
        .full-width {
            grid-column: 1 / -1;
        }

        /* Mengatur tampilan label setiap input */
        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            color: #334155;
            font-size: 14px;
        }

        /* Mengatur tampilan input, pilihan, dan textarea */
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

        /* Mengizinkan tinggi kolom alamat diubah */
        textarea {
            resize: vertical;
        }

        /* Memberikan penanda biru saat input dipilih */
        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #6094e8;
            box-shadow: 0 0 0 2px rgba(96, 148, 232, 0.15);
        }

        /* Mengatur tampilan tombol register */
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

        /* Mengubah warna tombol saat diarahkan kursor */
        button:hover {
            background: #4178d0;
        }

        /* Mengatur tampilan pesan kesalahan validasi */
        .error {
            color: #dc2626;
            font-size: 14px;
            margin-bottom: 18px;
            padding: 10px 14px;
            background: #fef2f2;
            border-radius: 5px;
        }

        /* Mengatur jarak antar pesan kesalahan */
        .error p {
            margin: 5px 0;
        }

        /* Mengatur posisi tautan untuk menuju halaman login */
        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #64748b;
        }

        /* Mengatur warna dan tampilan tautan login */
        .login-link a {
            color: #4178d0;
            text-decoration: none;
            font-weight: bold;
        }

        /* Memberikan garis bawah saat tautan login diarahkan kursor */
        .login-link a:hover {
            text-decoration: underline;
        }

        /* Mengatur tampilan form pada layar HP */
        @media (max-width: 600px) {
            body {
                align-items: flex-start;
                padding: 20px 12px;
            }

            .register-box {
                padding: 25px 20px;
            }

            /* Mengubah form menjadi satu kolom pada layar kecil */
            .form-grid {
                grid-template-columns: 1fr;
                column-gap: 0;
            }

            /* Mengembalikan elemen agar mengikuti satu kolom */
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

    <!-- Kotak utama halaman register -->
    <div class="register-box">

        <!-- Menampilkan judul halaman -->
        <h2>Register</h2>

        <!-- Menampilkan nama aplikasi -->
        <p class="subtitle">
            Aplikasi Pengelolaan Data Peserta Sertifikasi
        </p>

        <!-- Menampilkan pesan kesalahan jika validasi gagal -->
        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Form untuk mengirim data pendaftaran ke controller -->
        <form action="{{ route('register.process') }}" method="POST">

            <!-- Melindungi form dari serangan CSRF -->
            @csrf

            <!-- Bagian informasi akun pengguna -->
            <h3 class="section-title">Informasi Akun</h3>

            <div class="form-grid">

                <!-- Input nama lengkap pengguna -->
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

                <!-- Input email pengguna -->
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

                <!-- Input password dengan lebar penuh -->
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

            <!-- Bagian informasi data peserta -->
            <h3 class="section-title">Data Peserta</h3>

            <div class="form-grid">

                <!-- Input NISN peserta -->
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

                <!-- Pilihan jenis kelamin peserta -->
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

                <!-- Input nomor telepon peserta -->
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

                <!-- Pilihan skema sertifikasi dari database -->
                <div class="form-group">
                    <label for="skema_sertifikasi_id">Skema Sertifikasi</label>
                    <select
                        id="skema_sertifikasi_id"
                        name="skema_sertifikasi_id"
                        required
                    >
                        <option value="">-- Pilih Skema Sertifikasi --</option>

                        <!-- Menampilkan seluruh skema yang tersedia -->
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

                <!-- Input alamat peserta dengan lebar penuh -->
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

            <!-- Tombol untuk mengirim formulir pendaftaran -->
            <button type="submit">Register</button>
        </form>

        <!-- Tautan bagi pengguna yang sudah memiliki akun -->
        <div class="login-link">
            Sudah punya akun?
            <a href="{{ route('login') }}">Login</a>
        </div>
    </div>

</body>

</html>