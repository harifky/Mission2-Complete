<?php
ob_start(); // mulai "tampung"
?>
<h2>Daftar Mahasiswa</h2>

<a href="<?= base_url('mahasiswa/create') ?>">+ Tambah Mahasiswa</a><br><br>

<table border="1" cellpadding="5">
    <tr>
        <th>NIM</th>
        <th>Nama</th>
        <th>Jurusan</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($mahasiswa as $m): ?>
        <tr>
            <td><?= $m->nim ?></td>
            <td><?= $m->nama ?></td>
            <td><?= $m->jurusan ?></td>
            <td>
                <a href="<?= base_url('mahasiswa/detail/' . $m->nim) ?>">Detail</a> |
                <a href="<?= base_url('mahasiswa/edit/' . $m->nim) ?>">Edit</a> |
                <a href="<?= base_url('mahasiswa/delete/' . $m->nim) ?>" onclick="return confirm('Yakin hapus data?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php
$content = ob_get_clean(); // ambil hasil tampung
echo view('layout', ['title' => 'Daftar Mahasiswa', 'content' => $content]);
