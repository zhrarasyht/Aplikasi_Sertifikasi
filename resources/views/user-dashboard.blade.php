<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f1f5f9;
            color: #1e293b;
            min-height: 100vh;
        }

        /* Navbar Dashboard */
        .navbar {
            background: #2563eb;
            color: white;
            padding: 25px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            box-shadow: 0 3px 10px #00000012;
        }

        .navbar h2 {
            color: white;
            font-size: 24px;
        }

        /* Tombol Logout */
        .btn-logout {
            background: #dc2626;
            color: white;
            border: none;
            padding: 11px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            white-space: nowrap;
            transition: background 0.2s;
        }

        .btn-logout:hover {
            background: #b91c1c;
        }

        /* Kontainer Utama */
        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 25px;
        }

        /* Bagian Sambutan */
        .welcome {
            background: white;
            padding: 30px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 12px #00000008;
            margin-bottom: 25px;
        }

        .welcome h1 {
            color: #1e293b;
            margin-bottom: 15px;
            font-size: 24px;
        }

        .welcome p {
            color: #64748b;
            line-height: 1.8;
            font-size: 15px;
            margin-bottom: 8px;
        }

        .welcome p:last-child {
            margin-bottom: 0;
        }

        /* Kartu Informasi */
        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 12px #00000008;
            margin-bottom: 25px;
        }

        .card h3 {
            color: #1e293b;
            font-size: 20px;
            margin-bottom: 18px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e2e8f0;
        }

        .card p {
            color: #64748b;
            line-height: 1.8;
            margin-bottom: 10px;
            font-size: 14px;
            overflow-wrap: anywhere;
        }

        .card p:last-child {
            margin-bottom: 0;
        }

        .card p strong {
            color: #334155;
        }

        /* Pesan Data Belum Terhubung */
        .pesan {
            background: #eff6ff;
            padding: 15px;
            border-radius: 6px;
            line-height: 1.8;
            color: #1e40af;
            border: 1px solid #bfdbfe;
            font-size: 14px;
        }

        /* Tampilan Tablet dan HP */
        @media (max-width: 650px) {
            .navbar {
                padding: 22px 18px;
                gap: 12px;
            }

            .navbar h2 {
                font-size: 19px;
                line-height: 1.5;
            }

            .btn-logout {
                padding: 10px 12px;
                font-size: 12px;
            }

            .container {
                margin: 30px auto;
                padding: 0 18px;
            }

            .welcome {
                padding: 23px;
            }

            .welcome h1 {
                font-size: 21px;
            }

            .welcome p {
                font-size: 14px;
            }

            .card {
                padding: 23px;
            }

            .card h3 {
                font-size: 18px;
            }
        }

        /* Tampilan HP Kecil */
        @media (max-width: 380px) {
            .navbar {
                padding: 18px 12px;
            }

            .navbar h2 {
                font-size: 17px;
            }

            .btn-logout {
                padding: 9px 10px;
                font-size: 11px;
            }

            .container {
                padding: 0 12px;
            }

            .welcome,
            .card {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h2>Data Peserta Sertifikasi</h2>

        {{-- Form untuk logout dari akun --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>

    <div class="container">

        {{-- Sambutan untuk User --}}
        <div class="welcome">
            <h1>Dashboard User</h1>

            <p>
                Selamat datang, <strong>{{ auth()->user()->name }}</strong>!
            </p>

            <p>
                Selamat datang di aplikasi pengelolaan data peserta sertifikasi.
                Melalui halaman ini, kamu dapat melihat informasi akun dan data
                sertifikasi yang terhubung dengan akunmu.
            </p>
        </div>

        {{-- Informasi akun yang sedang login --}}
        <div class="card">
            <h3>Informasi Akun</h3>

            <p>
                <strong>Nama:</strong>
                {{ auth()->user()->name }}
            </p>

            <p>
                <strong>Email:</strong>
                {{ auth()->user()->email }}
            </p>

            <p>
                <strong>Role:</strong>
                User
            </p>
        </div>

        {{-- Data peserta yang terhubung dengan akun User --}}
        <div class="card">
            <h3>Data Sertifikasi Saya</h3>

            @if ($peserta)
                <p>
                    <strong>Nama Peserta:</strong>
                    {{ $peserta->nama_peserta }}
                </p>

                <p>
                    <strong>NISN:</strong>
                    {{ $peserta->nisn }}
                </p>

                <p>
                    <strong>Jenis Kelamin:</strong>
                    {{ $peserta->jenis_kelamin }}
                </p>

                <p>
                    <strong>Email Peserta:</strong>
                    {{ $peserta->email ?? '-' }}
                </p>

                <p>
                    <strong>Nomor Telepon:</strong>
                    {{ $peserta->no_telepon ?? '-' }}
                </p>

                <p>
                    <strong>Skema Sertifikasi:</strong>
                    {{ $peserta->skemaSertifikasi->nama_skema ?? '-' }}
                </p>

                <p>
                    <strong>Alamat:</strong>
                    {{ $peserta->alamat ?? '-' }}
                </p>
            @else
                <div class="pesan">
                    Data peserta belum terhubung dengan akun ini.
                    Silakan hubungi Admin agar akunmu dihubungkan dengan
                    data peserta yang sesuai.
                </div>
            @endif
        </div>

    </div>

</body>
</html>