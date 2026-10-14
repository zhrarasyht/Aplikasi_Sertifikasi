<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f1f5f9;
            color: #1e293b;
        }

        header {
            background-color: #2563eb;
            color: white;
            padding: 25px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        header h1 {
            font-size: 25px;
            margin-bottom: 6px;
        }

        header p {
            font-size: 14px;
            color: #dbeafe;
        }

        .tombol-logout {
            background-color: #dc2626;
            color: white;
            border: none;
            padding: 10px 17px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 14px;
        }

        .tombol-logout:hover {
            background-color: #b91c1c;
        }

        main {
            max-width: 1000px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .sambutan {
            background-color: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .sambutan h2 {
            font-size: 23px;
            margin-bottom: 10px;
        }

        .sambutan p {
            color: #64748b;
            line-height: 1.6;
        }

        .judul {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .status {
            display: inline-block;
            background-color: #dbeafe;
            color: #1d4ed8;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            margin-top: 12px;
        }

        .kartu {
            background-color: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
        }

        .kartu h3 {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .data {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .item-data {
            padding: 15px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }

        .item-data .label {
            display: block;
            color: #64748b;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .item-data .isi {
            font-size: 15px;
            font-weight: bold;
            overflow-wrap: anywhere;
        }

        .pesan {
            background-color: #eff6ff;
            color: #1d4ed8;
            padding: 15px;
            border-radius: 8px;
            line-height: 1.6;
        }

        .catatan {
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            margin-top: 18px;
        }

        footer {
            text-align: center;
            color: #64748b;
            font-size: 13px;
            padding: 20px;
        }

        @media (max-width: 600px) {
            header {
                padding: 20px;
                align-items: flex-start;
            }

            header h1 {
                font-size: 21px;
            }

            main {
                margin-top: 25px;
            }

            .data {
                grid-template-columns: 1fr;
            }

            .sambutan,
            .kartu {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <header>
        <div>
            <h1>Dashboard User</h1>
            <p>Portal Data Peserta Sertifikasi</p>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="tombol-logout">Logout</button>
        </form>
    </header>

    <main>

        <section class="sambutan">
            <h2>Halo, {{ auth()->user()->name }}!</h2>
            <p>
                Selamat datang di Dashboard.
                Kamu dapat melihat informasi data peserta sertifikasi
                yang terhubung dengan akunmu di halaman ini.
            </p>

            <span class="status">Akun User</span>
        </section>

        <h2 class="judul">Data Peserta Sertifikasi</h2>

        <section class="kartu">

            @if (isset($peserta) && $peserta)
                <h3>Informasi Data Saya</h3>

                <div class="data">
                    <div class="item-data">
                        <span class="label">Nama Peserta</span>
                        <div class="isi">{{ $peserta->nama_peserta }}</div>
                    </div>

                    <div class="item-data">
                        <span class="label">NISN</span>
                        <div class="isi">{{ $peserta->nisn }}</div>
                    </div>

                    <div class="item-data">
                        <span class="label">Jenis Kelamin</span>
                        <div class="isi">{{ $peserta->jenis_kelamin }}</div>
                    </div>

                    <div class="item-data">
                        <span class="label">Skema Sertifikasi</span>
                        <div class="isi">
                            {{ $peserta->skemaSertifikasi->nama_skema ?? '-' }}
                        </div>
                    </div>

                    <div class="item-data">
                        <span class="label">Email</span>
                        <div class="isi">{{ $peserta->email ?? '-' }}</div>
                    </div>

                    <div class="item-data">
                        <span class="label">Nomor Telepon</span>
                        <div class="isi">{{ $peserta->no_telepon ?? '-' }}</div>
                    </div>

                    <div class="item-data">
                        <span class="label">Alamat</span>
                        <div class="isi">{{ $peserta->alamat ?? '-' }}</div>
                    </div>

                </div>

                <p class="catatan">
                    Jika terdapat kesalahan pada data di atas,
                    silakan hubungi admin untuk melakukan pembaruan data.
                </p>
            @else
                <h3>Data Belum Tersedia</h3>

                <p class="pesan">
                    Data peserta belum tersedia untuk akunmu.
                    Silakan hubungi admin agar data peserta dapat
                    ditambahkan dan dihubungkan dengan akunmu.
                </p>
            @endif

        </section>

    </main>

    <footer>
        &copy; {{ date('Y') }} Aplikasi Pengelolaan Data Peserta Sertifikasi
    </footer>

</body>

</html>
