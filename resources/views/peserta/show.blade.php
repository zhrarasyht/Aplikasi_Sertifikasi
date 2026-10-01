
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peserta</title>

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

        .informasi {
            padding: 12px 0;
            margin: 0;
            border-bottom: 1px solid #e2e8f0;
            line-height: 1.5;
        }

        .tombol {
            display: inline-block;
            padding: 10px 16px;
            margin-top: 20px;
            border-radius: 5px;
            background: #64748b;
            color: white;
            text-decoration: none;
        }

        .tombol:hover {
            opacity: 0.85;
        }

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
        <h2>Detail Peserta Sertifikasi</h2>

        <p class="informasi"><strong>Nama Peserta:</strong><br>
            {{ $peserta->nama_peserta }}</p>

        <p class="informasi"><strong>NISN:</strong><br>
            {{ $peserta->nisn }}</p>

        <p class="informasi"><strong>Jenis Kelamin:</strong><br>
            {{ $peserta->jenis_kelamin }}</p>

        <p class="informasi"><strong>Email:</strong><br>
            {{ $peserta->email ?? '-' }}</p>

        <p class="informasi"><strong>Nomor Telepon:</strong><br>
            {{ $peserta->no_telepon ?? '-' }}</p>

        <p class="informasi"><strong>Alamat:</strong><br>
            {{ $peserta->alamat ?? '-' }}</p>

        <p class="informasi"><strong>Skema Sertifikasi:</strong><br>
            {{ $peserta->skemaSertifikasi->nama_skema ?? '-' }}</p>

        <a href="{{ route('peserta.index') }}" class="tombol">
            Kembali ke Daftar Peserta
        </a>
    </main>

</body>
</html>
