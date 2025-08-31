<!DOCTYPE html>
<html>
<head>
    <title>Detail Mahasiswa</title>
    <style>
        table { border-collapse: collapse; width: 40%; margin: 20px auto; }
        td { border: 1px solid black; padding: 8px; }
        th { width: 30%; background: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Detail Mahasiswa</h2>
    <table>
        <tr>
            <th>NIM</th>
            <td><?= $mhs['nim']; ?></td>
        </tr>
        <tr>
            <th>Nama</th>
            <td><?= $mhs['nama']; ?></td>
        </tr>
        <tr>
            <th>Jurusan</th>
            <td><?= $mhs['jurusan']; ?></td>
        </tr>
    </table>
    <p style="text-align:center;"><a href="/mahasiswa/list">⬅ Kembali ke Daftar</a></p>
</body>
</html>