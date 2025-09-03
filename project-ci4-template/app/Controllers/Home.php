<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // cek apakah sudah login
        if (! session()->get('username')) {
            return redirect()->to('/login');
        }

        $data = [
            'title'   => 'Halaman Home',
            'content' => '<h3>Selamat datang, ' . session()->get('username') . '!</h3>'
        ];

        return view('layout', $data);
    }
}
