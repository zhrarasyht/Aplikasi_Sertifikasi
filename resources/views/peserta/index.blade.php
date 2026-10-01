
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peserta Sertifikasi</title>

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
            margin: 25px;
            padding: 20px;
            background: white;
            border-radius: 8px;
        }

        input {
            padding: 9px;
            margin: 4px;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
        }

        .tombol {
            display: inline-block;
            padding: 9px 12px;
            margin: 3px;
            border: none;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            font-size: 13px;
            cursor: pointer;
        }

        .tombol:hover {
            opacity: 0.85;
        }

        .tambah, .dashboard { background: #2563eb; }
        .cari { background: #0891b2; }
        .reset { background: #64748b; }
        .detail { background: #0891b2; }
        .edit { background: #f59e0b; }
        .hapus { background: #dc2626; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #cbd5e1;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #dbeafe;
        }

        .pesan {
            color: green;
        }
    </style>
</head>
<body>

    <header>
        <h1>Aplikasi Pengelolaan Data Peserta Sertifikasi</h1>
        <p>Halaman Pengelolaan Data Peserta</p>
    </header>

    <main>
        <h2>Daftar Peserta</h2>

        @if (session('success'))
            <p class="pesan">{{ session('success') }}</p>
        @endif

        <a href="{{ route('peserta.create') }}"
           class="tombol tambah">Tambah Peserta</a>

        <form action="{{ route('peserta.index') }}" method="GET">
            <input type="text" name="search"
                placeholder="Cari nama atau NISN"
                value="{{ $search ?? '' }}">

            <button type="submit" class="tombol cari">Search</button>

            <a href="{{ route('peserta.index') }}"
               class="tombol reset">Reset</a>
        </form>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Peserta</th>
                    <th>NISN</th>
                    <th>Nomor Telepon</th>
                    <th>Jenis Kelamin</th>
                    <th>Skema Sertifikasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($pesertas as $peserta)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $peserta->nama_peserta }}</td>
                        <td>{{ $peserta->nisn }}</td>
                        <td>{{ $peserta->no_telepon ?? '-' }}</td>
                        <td>{{ $peserta->jenis_kelamin }}</td>
                        <td>{{ $peserta->skemaSertifikasi->nama_skema ?? '-' }}</td>
                        <td>
                            <a href="{{ route('peserta.show', $peserta->id) }}"
                               class="tombol detail">Detail</a>

                            <a href="{{ route('peserta.edit', $peserta->id) }}"
                               class="tombol edit">Edit</a>

                            <form action="{{ route('peserta.destroy', $peserta->id) }}"
                                method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Yakin ingin menghapus peserta ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="tombol hapus">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">Belum ada data peserta.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <br>

        <a href="{{ route('dashboard') }}"
           class="tombol dashboard">Kembali ke Dashboard</a>
    </main>

</body>
</html>
