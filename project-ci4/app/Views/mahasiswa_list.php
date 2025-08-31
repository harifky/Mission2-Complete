<!DOCTYPE html>
<html>

<head>
    <title>Data Mahasiswa</title>
    <style>
        table {
            border-collapse: collapse;
            width: 70%;
            margin: 20px auto;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2 style="text-align:center;">Daftar Mahasiswa (Dari Database)</h2>
    <p style="text-align:center;">
        <a href="/mahasiswa/create">Tambah Mahasiswa</a>
    </p>
    <form action="/mahasiswa/search" method="get" style="text-align:center; margin-bottom:20px;">
        <input type="text" name="keyword" value="<?= $keyword ?? '' ?>" placeholder="Cari NIM / Nama / Jurusan">
        <button type="submit">Cari</button>
        <a href="/mahasiswa/list">Reset</a>
    </form>
    <table>
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($mahasiswa as $mhs): ?>
            <tr>
                <td><?= $mhs['nim']; ?></td>
                <td><?= $mhs['nama']; ?></td>
                <td><?= $mhs['jurusan']; ?></td>
                <td>
                    <a href="/mahasiswa/detail/<?= $mhs['nim']; ?>">Detail</a> |
                    <a href="/mahasiswa/edit/<?= $mhs['nim']; ?>">Edit</a> |
                    <a href="/mahasiswa/delete/<?= $mhs['nim']; ?>"
                        onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>