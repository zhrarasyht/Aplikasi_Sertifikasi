
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peserta</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            margin: 0;
            color: #1e293b;
        }

        header {
            background: #2563eb;
            color: white;
            padding: 20px;
        }

        main {
            max-width: 650px;
            margin: 25px auto;
            padding: 25px;
            background: white;
            border-radius: 8px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }

        textarea {
            height: 85px;
            resize: vertical;
        }

        .tombol {
            display: inline-block;
            padding: 10px 16px;
            margin: 5px 3px 0 0;
            border: none;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }

        .simpan { background: #2563eb; }
        .kembali { background: #64748b; }

        .tombol:hover {
            opacity: 0.85;
        }

        .error {
            color: #dc2626;
            background: #fee2e2;
            padding: 12px 30px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <header>
        <h1>Aplikasi Pengelolaan Data Peserta Sertifikasi</h1>
        <p>Formulir Tambah Peserta</p>
    </header>

    <main>
        <h2>Tambah Peserta Sertifikasi</h2>

        @if ($errors->any())
            <ul class="error">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('peserta.store') }}" method="POST">
            @csrf

            <p>
                <label>Nama Peserta</label>
                <input type="text" name="nama_peserta"
                    value="{{ old('nama_peserta') }}" required>
            </p>

            <p>
                <label>NISN</label>
                <input type="text" name="nisn"
                    value="{{ old('nisn') }}" maxlength="10"
                    inputmode="numeric" required>
            </p>

            <p>
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </p>

            <p>
                <label>Email</label>
                <input type="email" name="email"
                    value="{{ old('email') }}">
            </p>

            <p>
                <label>Nomor Telepon</label>
                <input type="text" name="no_telepon"
                    value="{{ old('no_telepon') }}">
            </p>

            <p>
                <label>Alamat</label>
                <textarea name="alamat">{{ old('alamat') }}</textarea>
            </p>

            <p>
                <label>Skema Sertifikasi</label>
                <select name="skema_sertifikasi_id" required>
                    <option value="">-- Pilih Skema Sertifikasi --</option>
                    @foreach ($skemas as $skema)
                        <option value="{{ $skema->id }}"
                            {{ old('skema_sertifikasi_id') == $skema->id ? 'selected' : '' }}>
                            {{ $skema->kode_skema }} - {{ $skema->nama_skema }}
                        </option>
                    @endforeach
                </select>
            </p>

            <button type="submit" class="tombol simpan">Simpan Peserta</button>

            <a href="{{ route('peserta.index') }}"
                class="tombol kembali">Kembali</a>
        </form>
    </main>

</body>
</html>
