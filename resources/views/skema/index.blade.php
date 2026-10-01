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
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #2563eb;
            color: white;
            padding: 30px 50px;
            gap: 20px;
        }

        .header-text h1 {
            font-size: 28px;
            margin: 0 0 12px;
        }

        .header-text p {
            font-size: 15px;
            margin: 0;
        }

        .admin {
            display: flex;
            align-items: center;
            gap: 15px;
            white-space: nowrap;
        }

        .admin form {
            margin: 0;
        }

        main {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 25px;
        }

        .konten {
            background: white;
            padding: 25px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            box-shadow: 0 4px 12px #00000008;
        }

        .konten h2 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 22px;
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
            font-family: Arial, sans-serif;
        }

        .tombol:hover {
            opacity: 0.85;
        }

        .tambah, .dashboard {
            background: #2563eb;
        }

        .detail {
            background: #0891b2;
        }

        .edit {
            background: #f59e0b;
        }

        .hapus, .logout {
            background: #dc2626;
        }

        .kembali {
            background: #64748b;
        }

        .logout {
            padding: 11px 20px;
            border-radius: 6px;
        }

        .logout:hover {
            background: #b91c1c;
            opacity: 1;
        }

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

        .error {
            color: red;
        }

        @media (max-width: 650px) {
            header {
                padding: 25px 18px;
                align-items: flex-start;
                flex-direction: column;
            }

            .header-text h1 {
                font-size: 23px;
            }

            .header-text p {
                font-size: 13px;
            }

            .admin {
                align-self: flex-end;
            }

            main {
                margin: 30px auto;
                padding: 0 18px;
            }

            .konten {
                padding: 20px;
                overflow-x: auto;
            }

            table {
                min-width: 700px;
            }
        }
    </style>
</head>
<body>

    <header>
        <div class="header-text">
            <h1>Aplikasi Pengelolaan Data Peserta Sertifikasi</h1>
            <p>Halaman Pengelolaan Skema Sertifikasi</p>
        </div>

        <div class="admin">
            <span>Admin</span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="tombol logout">Logout</button>
            </form>
        </div>
    </header>

    <main>
        <div class="konten">
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

                                    <button type="submit" class="tombol hapus">
                                        Hapus
                                    </button>
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
               class="tombol dashboard">Dashboard</a>
        </div>
    </main>

</body>
</html>
