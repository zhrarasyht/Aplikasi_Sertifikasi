
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            margin: 0;
            color: #1e293b;
        }

        header {
            background: #2563eb;
            color: white;
            padding: 30px 50px;
        }

        header h1 {
            margin: 0 0 12px;
            font-size: 28px;
        }

        header p {
            margin: 0;
            font-size: 15px;
        }

        main {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 25px;
        }

        .sambutan {
            margin-bottom: 35px;
        }

        .sambutan h2 {
            margin: 0 0 12px;
            font-size: 24px;
        }

        .sambutan p {
            color: #64748b;
            margin: 0;
            line-height: 1.7;
        }

        .judul {
            font-size: 20px;
            margin: 0 0 20px;
        }

        .statistik, .menu {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 25px;
        }

        .statistik {
            margin-bottom: 35px;
        }

        .jumlah {
            background: white;
            padding: 25px 30px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            border-left: 5px solid #2563eb;
            box-shadow: 0 4px 12px #00000008;
        }

        .jumlah p {
            color: #64748b;
            margin: 0 0 15px;
            font-size: 15px;
        }

        .jumlah h2 {
            color: #2563eb;
            font-size: 32px;
            margin: 0;
        }

        .kartu {
            background: white;
            padding: 30px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 12px #00000008;
        }

        .kartu h3 {
            margin: 0 0 15px;
            font-size: 20px;
        }

        .kartu p {
            color: #64748b;
            line-height: 1.8;
            margin: 0 0 25px;
        }

        .tombol {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 12px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
        }

        .tombol:hover {
            background: #1d4ed8;
        }

        .bagian-logout {
            margin-top: 35px;
            padding-top: 25px;
            border-top: 1px solid #e2e8f0;
        }

        .logout {
            background: #dc2626;
            color: white;
            padding: 11px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout:hover {
            background: #b91c1c;
        }

        @media (max-width: 650px) {
            header {
                padding: 25px;
            }

            main {
                margin: 30px auto;
                padding: 0 18px;
            }

            .statistik, .menu {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .kartu, .jumlah {
                padding: 25px;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>Dashboard</h1>
        <p>Aplikasi Pengelolaan Data Peserta Sertifikasi</p>
    </header>

    <main>
        <section class="sambutan">
            <h2>Selamat Datang, Admin!</h2>
            <p>
                Selamat datang di halaman dashboard.
            </p>
        </section>

        <h3 class="judul">Ringkasan Data</h3>

        <section class="statistik">
            <div class="jumlah">
                <p>Total Peserta</p>
                <h2>{{ $jumlahPeserta }}</h2>
            </div>

            <div class="jumlah">
                <p>Total Skema</p>
                <h2>{{ $jumlahSkema }}</h2>
            </div>
        </section>

        <h3 class="judul">Menu</h3>

        <section class="menu">
            <div class="kartu">
                <h3>Data Peserta</h3>
                <p>
                    Kelola data peserta sertifikasi, mulai dari
                    menambahkan, melihat, mengubah, hingga menghapus data.
                </p>
                <a href="{{ route('peserta.index') }}" class="tombol">
                    Kelola Data Peserta
                </a>
            </div>

            <div class="kartu">
                <h3>Skema Sertifikasi</h3>
                <p>
                    Kelola informasi skema sertifikasi,
                    termasuk kode, nama, dan deskripsi skema.
                </p>
                <a href="{{ route('skema-sertifikasi.index') }}" class="tombol">
                    Kelola Skema Sertifikasi
                </a>
            </div>
        </section>

        <div class="bagian-logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout">Logout</button>
            </form>
        </div>
    </main>
</body>
</html>
