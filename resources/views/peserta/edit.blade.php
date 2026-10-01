
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Peserta</title>

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
            padding: 15px 20px;
        }

        main {
            max-width: 600px;
            margin: 30px auto;
            padding: 25px;
            background: white;
            border-radius: 8px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            font-size: 14px;
        }

        main form p {
            margin-bottom: 22px;
        }

        textarea {
            min-height: 80px;
            resize: vertical;
        }

        .tombol {
            display: inline-block;
            padding: 10px 16px;
            margin: 8px 5px 0 0;
            border: none;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .simpan { background: #2563eb; }
        .kembali { background: #64748b; }
        .error { color: #dc2626; }

        @media (max-width: 650px) {
            main { margin: 15px; }
        }
    </style>
</head>
<body>

    <header>
        <h2>Aplikasi Pengelolaan Data Peserta Sertifikasi</h2>
    </header>

    <main>
        <h2>Edit Data Peserta</h2>

        @if ($errors->any())
            <ul class="error">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('peserta.update', $peserta->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <p>
                <label>Nama Peserta</label>
                <input type="text" name="nama_peserta"
                    value="{{ old('nama_peserta', $peserta->nama_peserta) }}" required>
            </p>

            <p>
                <label>NISN</label>
                <input type="text" name="nisn" maxlength="10" inputmode="numeric"
                    value="{{ old('nisn', $peserta->nisn) }}" required>
            </p>

            <p>
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" required>
                    <option value="Laki-laki"
                        {{ old('jenis_kelamin', $peserta->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                        Laki-laki
                    </option>
                    <option value="Perempuan"
                        {{ old('jenis_kelamin', $peserta->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                        Perempuan
                    </option>
                </select>
            </p>

            <p>
                <label>Email</label>
                <input type="email" name="email"
                    value="{{ old('email', $peserta->email) }}">
            </p>

            <p>
                <label>Nomor Telepon</label>
                <input type="text" name="no_telepon"
                    value="{{ old('no_telepon', $peserta->no_telepon) }}">
            </p>

            <p>
                <label>Alamat</label>
                <textarea name="alamat">{{ old('alamat', $peserta->alamat) }}</textarea>
            </p>

            <p>
                <label>Skema Sertifikasi</label>
                <select name="skema_sertifikasi_id" required>
                    @foreach ($skemas as $skema)
                        <option value="{{ $skema->id }}"
                            {{ old('skema_sertifikasi_id', $peserta->skema_sertifikasi_id) == $skema->id ? 'selected' : '' }}>
                            {{ $skema->kode_skema }} - {{ $skema->nama_skema }}
                        </option>
                    @endforeach
                </select>
            </p>

            <button type="submit" class="tombol simpan">Simpan Perubahan</button>
            <a href="{{ route('peserta.index') }}" class="tombol kembali">Kembali</a>
        </form>
    </main>

</body>
</html>
