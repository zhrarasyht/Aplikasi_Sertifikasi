
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Skema Sertifikasi</title>

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
            padding: 20px 25px;
        }

        header h2 {
            margin: 0;
        }

        main {
            max-width: 600px;
            margin: 40px auto;
            padding: 35px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px #00000010;
        }

        main h2 {
            margin: 0 0 35px;
        }

        .form-group {
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 12px;
            font-weight: bold;
        }

        input, textarea {
            display: block;
            width: 100%;
            padding: 12px;
            box-sizing: border-box;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            font-size: 15px;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .error {
            color: #dc2626;
            margin-bottom: 25px;
            line-height: 1.8;
        }

        .tombol {
            display: inline-block;
            padding: 12px 20px;
            margin: 5px 10px 0 0;
            border: none;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .simpan {
            background: #2563eb;
        }

        .kembali {
            background: #64748b;
        }

        .tombol:hover {
            opacity: 0.85;
        }

        @media (max-width: 700px) {
            main {
                margin: 20px 15px;
                padding: 25px;
            }
        }
    </style>
</head>
<body>

    <header>
        <h2>Aplikasi Pengelolaan Data Peserta Sertifikasi</h2>
    </header>

    <main>
        <h2>Tambah Skema Sertifikasi</h2>

        @if ($errors->any())
            <ul class="error">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('skema-sertifikasi.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="kode_skema">Kode Skema</label>
                <input type="text" id="kode_skema" name="kode_skema"
                    value="{{ old('kode_skema') }}" required>
            </div>

            <div class="form-group">
                <label for="nama_skema">Nama Skema</label>
                <input type="text" id="nama_skema" name="nama_skema"
                    value="{{ old('nama_skema') }}" required>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>
            </div>

            <button type="submit" class="tombol simpan">Simpan Skema</button>
            <a href="{{ route('skema-sertifikasi.index') }}"
                class="tombol kembali">Kembali</a>
        </form>
    </main>

</body>
</html>
