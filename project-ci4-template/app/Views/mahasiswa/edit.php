<?php ob_start(); ?>
<h2>Edit Mahasiswa</h2>

<?php if (session()->getFlashdata('error')): ?>
    <p style="color:red;"><?= session()->getFlashdata('error') ?></p>
<?php endif; ?>

<form method="post" action="<?= base_url('mahasiswa/update/'.$mhs->nim) ?>">
    <label>NIM</label><br>
    <input type="text" name="nim" value="<?= $mhs->nim ?>" readonly><br><br>

    <label>Nama</label><br>
    <input type="text" name="nama" value="<?= $mhs->nama ?>"><br><br>

    <label>Jurusan</label><br>
    <input type="text" name="jurusan" value="<?= $mhs->jurusan ?>"><br><br>

    <button type="submit">Update</button>
</form>
<a href="<?= base_url('mahasiswa') ?>">Kembali</a>
<?php
$content = ob_get_clean();
echo view('layout', ['title' => 'Edit Mahasiswa', 'content' => $content]);