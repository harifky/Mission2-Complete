<?php ob_start(); ?>
<h2>Tambah Mahasiswa</h2>

<?php if (session()->getFlashdata('error')): ?>
    <p style="color:red;"><?= session()->getFlashdata('error') ?></p>
<?php endif; ?>

<form method="post" action="<?= base_url('mahasiswa/store') ?>">
    <label>NIM</label><br>
    <input type="text" name="nim"><br><br>

    <label>Nama</label><br>
    <input type="text" name="nama"><br><br>

    <label>Jurusan</label><br>
    <input type="text" name="jurusan"><br><br>

    <button type="submit">Simpan</button>
</form>
<a href="<?= base_url('mahasiswa') ?>">Kembali</a>
<?php
$content = ob_get_clean();
echo view('layout', ['title' => 'Tambah Mahasiswa', 'content' => $content]);