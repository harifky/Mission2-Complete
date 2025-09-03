<?php

ob_start();
?>
<h2>Detail Mahasiswa</h2>
<p><b>NIM:</b> <?= $mhs->nim ?></p>
<p><b>Nama:</b> <?= $mhs->nama ?></p>
<p><b>Jurusan:</b> <?= $mhs->jurusan ?></p>
<a href="<?= base_url('mahasiswa') ?>">Kembali</a>
<?php
$content = ob_get_clean();
echo view('layout', ['title' => 'Detail Mahasiswa', 'content' => $content]);
