<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <style>
        table { border-collapse: collapse; width: 60%; margin: 20px auto; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Daftar Mahasiswa</h2>
    <table>
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Jurusan</th>
        </tr>
        <?php foreach ($mahasiswa as $mhs): ?>
            <tr>
                <td><?= $mhs['nim']; ?></td>
                <td><?= $mhs['nama']; ?></td>
                <td><?= $mhs['jurusan']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
