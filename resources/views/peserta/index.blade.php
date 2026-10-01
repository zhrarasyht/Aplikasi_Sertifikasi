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
            margin: 0 0 25px;
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
            box-sizing: border-box;
        }

        .tombol:hover {
            opacity: 0.85;
        }

        .tambah,
        .dashboard {
            background: #2563eb;
        }

        .cari,
        .detail {
            background: #0891b2;
        }

        .reset,
        .kembali {
            background: #64748b;
        }

        .edit {
            background: #f59e0b;
        }

        .hapus,
        .logout {
            background: #dc2626;
        }

        .logout {
            padding: 11px 20px;
            border-radius: 6px;
        }

        .logout:hover {
            background: #b91c1c;
            opacity: 1;
        }

        /* Jarak tombol tambah dan pencarian */
        .tambah {
            margin: 0 3px 8px;
        }

        .form-pencarian {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin: 20px 0 25px;
        }

        .form-pencarian input {
            box-sizing: border-box;
            width: 260px;
            max-width: 100%;
            padding: 10px;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            font-family: Arial, sans-serif;
        }

        .form-pencarian input:focus {
            outline: 1px solid #2563eb;
            border-color: #2563eb;
        }

        .form-pencarian .tombol {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #cbd5e1;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #dbeafe;
        }

        .pesan {
            color: green;
            margin-bottom: 15px;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }

        .navigasi {
            margin-top: 25px;
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

            .form-pencarian input {
                width: 100%;
            }

            table {
                min-width: 850px;
            }
        }
    </style>
</head>

<body>

    <header>
        <div class="header-text">
            <h1>Aplikasi Pengelolaan Data Peserta Sertifikasi</h1>
            <p>Halaman Pengelolaan Data Peserta</p>
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
            <h2>Daftar Peserta</h2>

            @if (session('success'))
                <p class="pesan">{{ session('success') }}</p>
            @endif

            @if (session('error'))
                <p class="error">{{ session('error') }}</p>
            @endif

            <a href="{{ route('peserta.create') }}" class="tombol tambah">
                Tambah Peserta
            </a>

            <form action="{{ route('peserta.index') }}" method="GET" class="form-pencarian">

                <input type="text" name="search" placeholder="Cari nama atau NISN" value="{{ $search ?? '' }}">

                <button type="submit" class="tombol cari">
                    Search
                </button>

                <a href="{{ route('peserta.index') }}" class="tombol reset">
                    Reset
                </a>
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
                                <a href="{{ route('peserta.show', $peserta->id) }}" class="tombol detail">Detail</a>

                                <a href="{{ route('peserta.edit', $peserta->id) }}" class="tombol edit">Edit</a>

                                <form action="{{ route('peserta.destroy', $peserta->id) }}" method="POST"
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
                            <td colspan="7">
                                Belum ada data peserta.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="navigasi">
                <a href="{{ route('skema-sertifikasi.index') }}" class="tombol kembali">
                    Data Skema Sertifikasi
                </a>

                <a href="{{ route('dashboard') }}" class="tombol dashboard">
                    Dashboard
                </a>
            </div>
        </div>
    </main>

</body>

</html>
