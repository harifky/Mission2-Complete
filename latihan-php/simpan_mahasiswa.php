<?php
// 1) Buat koneksi
$conn = new mysqli('localhost', 'root', '', 'akademik_db');
if ($conn->connect_errno) {
    die('Koneksi gagal: ' . $conn->connect_error);
}

// 2) Ambil & validasi input (pastikan form method="post")
$nim  = $_POST['nim']  ?? '';
$nama = $_POST['nama'] ?? '';
$umur = $_POST['umur'] ?? '';

if ($nim === '' || $nama === '' || $umur === '' || !ctype_digit($umur)) {
    die("<p style='color:red;'>Input tidak valid</p><a href='form_input_mahasiswa.html'>Kembali</a>");
}

// 3) Simpan ke DB
$stmt = $conn->prepare("INSERT INTO mahasiswa (nim, nama, umur) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $nim, $nama, $umur);

if ($stmt->execute()) {
    echo "<p style='color:green;'>Data mahasiswa berhasil disimpan</p>";
    echo "<a href='form_input_mahasiswa.html'>Input lagi</a>";
} else {
    echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
    echo "<a href='form_input_mahasiswa.html'>Kembali</a>";
}

$stmt->close();
$conn->close();