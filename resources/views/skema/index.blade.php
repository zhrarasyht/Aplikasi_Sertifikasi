
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Skema Sertifikasi</title>

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

        .tombol {
            display: inline-block;
            padding: 9px 13px;
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

        .tambah { background: #2563eb; }
        .detail { background: #0891b2; }
        .edit { background: #f59e0b; }
        .hapus { background: #dc2626; }
        .kembali { background: #64748b; }

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

        .pesan { color: green; }
        .error { color: red; }
    </style>
</head>
<body>

    <header>
        <h1>Aplikasi Pengelolaan Data Peserta Sertifikasi</h1>
        <p>Halaman Pengelolaan Skema Sertifikasi</p>
    </header>

    <main>
        <h2>Data Skema Sertifikasi</h2>

        @if (session('success'))
            <p class="pesan">{{ session('success') }}</p>
        @endif

        @if (session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif

        <a href="{{ route('skema-sertifikasi.create') }}"
           class="tombol tambah">Tambah Skema</a>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Skema</th>
                    <th>Nama Skema</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($skemas as $skema)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $skema->kode_skema }}</td>
                        <td>{{ $skema->nama_skema }}</td>
                        <td>{{ $skema->deskripsi }}</td>
                        <td>
                            <a href="{{ route('skema-sertifikasi.show', $skema->id) }}"
                               class="tombol detail">Detail</a>

                            <a href="{{ route('skema-sertifikasi.edit', $skema->id) }}"
                               class="tombol edit">Edit</a>

                            <form action="{{ route('skema-sertifikasi.destroy', $skema->id) }}"
                                  method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('Yakin ingin menghapus skema ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="tombol hapus">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Belum ada data skema sertifikasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <br>

        <a href="{{ route('peserta.index') }}"
           class="tombol kembali">Kembali ke Data Peserta</a>

        <a href="{{ route('dashboard') }}"
           class="tombol tambah">Dashboard</a>
    </main>

</body>
</html>
