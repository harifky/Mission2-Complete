<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    public function index()
    {
        return view('login/form', [
            'title' => 'Login',
            'content' => '' // placeholder, nanti diisi di view
        ]);
    }

    public function auth()
    {
        $db = db_connect();
        $username = $this->request->getPost('username');

        if (empty($username) || empty($this->request->getPost('password'))) {
            return redirect()->to('/login')->with('error', 'Semua field harus diisi!');
        }

        $password = md5($this->request->getPost('password'));

        $query = $db->query("SELECT * FROM admin WHERE username='$username' AND password='$password'");
        $admin = $query->getRow();

        if ($admin) {
            // Simpan session
            session()->set('username', $admin->username);
            return redirect()->to('/home');
        } else {
            return redirect()->to('/login')->with('error', 'Username atau Password salah!');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
