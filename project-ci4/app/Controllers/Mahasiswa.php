<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
{
    public function list()
    {
        $model = new MahasiswaModel();
        $data['mahasiswa'] = $model->findAll();

        return view('mahasiswa_list', $data);
    }

    public function detail($nim)
    {
        $model = new MahasiswaModel();
        $data['mhs'] = $model->find($nim);

        if (!$data['mhs']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Mahasiswa dengan NIM $nim tidak ditemukan");
        }

        return view('mahasiswa_detail', $data);
    }

    public function create()
    {
        return view('mahasiswa_create');
    }

    public function store()
    {
        $model = new MahasiswaModel();

        $model->insert([
            'nim'     => $this->request->getPost('nim'),
            'nama'    => $this->request->getPost('nama'),
            'jurusan' => $this->request->getPost('jurusan'),
        ]);

        return redirect()->to('/mahasiswa/list');
    }

    public function edit($nim)
    {
        $model = new MahasiswaModel();
        $data['mhs'] = $model->find($nim);

        if (!$data['mhs']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Mahasiswa dengan NIM $nim tidak ditemukan");
        }

        return view('mahasiswa_edit', $data);
    }

    public function update($nim)
    {
        $model = new MahasiswaModel();

        $model->update($nim, [
            'nama'    => $this->request->getPost('nama'),
            'jurusan' => $this->request->getPost('jurusan'),
        ]);

        return redirect()->to('/mahasiswa/list');
    }

    public function delete($nim)
    {
        $model = new MahasiswaModel();
        $model->delete($nim);

        return redirect()->to('/mahasiswa/list');
    }

    public function search()
    {
        $keyword = $this->request->getGet('keyword');

        $model = new MahasiswaModel();

        if ($keyword) {
            $data['mahasiswa'] = $model->like('nama', $keyword)
                ->orLike('nim', $keyword)
                ->orLike('jurusan', $keyword)
                ->findAll();
        } else {
            $data['mahasiswa'] = $model->findAll();
        }

        $data['keyword'] = $keyword;

        return view('mahasiswa_list', $data);
    }
}
