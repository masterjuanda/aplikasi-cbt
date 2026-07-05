<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Alamat Email</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background-color: #f3f4f6; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px; }
        .card { background-color: #ffffff; padding: 40px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); max-width: 500px; width: 100%; text-align: center; }
        h1 { color: #1f2937; margin-bottom: 20px; font-size: 24px; }
        p { color: #4b5563; margin-bottom: 25px; line-height: 1.6; }
        .pesan-sukses { background-color: #dcfce7; color: #166534; padding: 12px; border-radius: 4px; margin-bottom: 20px; }
        form { margin-bottom: 15px; }
        button { background-color: #2563eb; color: white; border: none; padding: 12px 24px; border-radius: 4px; font-size: 16px; cursor: pointer; transition: background-color 0.2s; }
        button:hover { background-color: #1d4ed8; }
        a { color: #2563eb; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Verifikasi Alamat Email Anda</h1>

        @if (session('pesan'))
            <div class="pesan-sukses">
                {{ session('pesan') }}
            </div>
        @endif

        <p>
            Terima kasih telah mendaftar! Sebelum melanjutkan, silakan periksa email Anda dan klik tautan verifikasi yang telah kami kirimkan.
            Jika Anda belum menerima email tersebut, silakan tekan tombol di bawah ini untuk mengirim ulang.
        </p>

        <form method="POST" action="{{ route('siswa.verification.send') }}">
            @csrf
            <button type="submit">Kirim Ulang Tautan Verifikasi</button>
        </form>

        <p>
            <a href="{{ route('siswa.logout') }}" onclick="event.preventDefault(); document.getElementById('keluar-form').submit();">
                Keluar dari akun
            </a>
        </p>

        <form id="keluar-form" method="POST" action="{{ route('siswa.logout') }}" style="display: none;">
            @csrf
        </form>
    </div>
</body>
</html>