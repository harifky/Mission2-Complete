<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mahasiswa</title>
    <style>
        form { width: 40%; margin: 20px auto; }
        label { display: block; margin: 10px 0 5px; }
        input, select { width: 100%; padding: 8px; }
        button { margin-top: 15px; padding: 10px; width: 100%; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Tambah Data Mahasiswa</h2>
    <form action="/mahasiswa/store" method="post">
        <label for="nim">NIM</label>
        <input type="text" name="nim" required>

        <label for="nama">Nama</label>
        <input type="text" name="nama" required>

        <label for="jurusan">Jurusan</label>
        <input type="text" name="jurusan" required>

        <button type="submit">Simpan</button>
    </form>
    <p style="text-align:center;">
        <a href="/mahasiswa/list">⬅ Kembali ke Daftar</a>
    </p>
</body>
</html>