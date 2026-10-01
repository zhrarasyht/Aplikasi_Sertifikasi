
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Skema Sertifikasi</title>

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
            margin: 0 0 30px;
        }

        .informasi {
            padding: 15px 0;
            margin: 0;
            border-bottom: 1px solid #e2e8f0;
            line-height: 1.8;
        }

        .tombol {
            display: inline-block;
            padding: 12px 20px;
            margin: 25px 10px 0 0;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .kembali {
            background: #64748b;
        }

        .edit {
            background: #f59e0b;
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
        <h2>Detail Skema Sertifikasi</h2>

        <p class="informasi">
            <strong>Kode Skema:</strong><br>
            {{ $skema->kode_skema }}
        </p>

        <p class="informasi">
            <strong>Nama Skema:</strong><br>
            {{ $skema->nama_skema }}
        </p>

        <p class="informasi">
            <strong>Deskripsi:</strong><br>
            {{ $skema->deskripsi ?? '-' }}
        </p>

        <a href="{{ route('skema-sertifikasi.index') }}"
            class="tombol kembali">Kembali ke Daftar Skema</a>

        <a href="{{ route('skema-sertifikasi.edit', $skema->id) }}"
            class="tombol edit">Edit Skema</a>
    </main>

</body>
</html>
