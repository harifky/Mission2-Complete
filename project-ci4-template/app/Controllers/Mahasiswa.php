<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Mahasiswa extends BaseController
{
    // Tampilkan semua mahasiswa
    public function index()
    {
        $db = db_connect();
        $query = $db->query("SELECT * FROM mahasiswa");
        $data['mahasiswa'] = $query->getResult();

        return view('mahasiswa/index', $data);
    }

    // Tampilkan detail mahasiswa berdasarkan NIM
    public function detail($nim)
    {
        $db = db_connect();
        $query = $db->query("SELECT * FROM mahasiswa WHERE nim = '$nim'");
        $data['mhs'] = $query->getRow();

        return view('mahasiswa/detail', $data);
    }

    // Form tambah mahasiswa
    public function create()
    {
        return view('mahasiswa/create');
    }

    // Proses simpan mahasiswa
    public function store()
    {
        $db = db_connect();
        $nim     = $this->request->getPost('nim');
        $nama    = $this->request->getPost('nama');
        $jurusan = $this->request->getPost('jurusan');

        // Validasi sederhana
        if (empty($nim) || empty($nama) || empty($jurusan)) {
            return redirect()->to('/mahasiswa/create')->with('error', 'Semua field harus diisi!');
        }

        // Simpan ke database
        $db->query("INSERT INTO mahasiswa (nim, nama, jurusan) VALUES ('$nim', '$nama', '$jurusan')");

        return redirect()->to('/mahasiswa')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    // Form edit mahasiswa
    public function edit($nim)
    {
        $db = db_connect();
        $query = $db->query("SELECT * FROM mahasiswa WHERE nim='$nim'");
        $data['mhs'] = $query->getRow();

        return view('mahasiswa/edit', $data);
    }

    // Proses update mahasiswa
    public function update($nim)
    {
        $db = db_connect();
        $nama    = $this->request->getPost('nama');
        $jurusan = $this->request->getPost('jurusan');

        if (empty($nama) || empty($jurusan)) {
            return redirect()->to("/mahasiswa/edit/$nim")->with('error', 'Semua field harus diisi!');
        }

        $db->query("UPDATE mahasiswa SET nama='$nama', jurusan='$jurusan' WHERE nim='$nim'");
        return redirect()->to('/mahasiswa')->with('success', 'Mahasiswa berhasil diperbarui');
    }

    // Hapus mahasiswa
    public function delete($nim)
    {
        $db = db_connect();
        $db->query("DELETE FROM mahasiswa WHERE nim='$nim'");
        return redirect()->to('/mahasiswa')->with('success', 'Mahasiswa berhasil dihapus');
    }
}
