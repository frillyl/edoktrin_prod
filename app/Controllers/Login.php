<?php

namespace App\Controllers;

use App\Models\ModelLogin;

class Login extends BaseController
{
    protected $ModelLogin;

    public function __construct()
    {
        helper('form');
        $this->ModelLogin = new ModelLogin();
    }

    public function index()
    {
        $data = [
            'title' => 'E-Doktrin',
            'sub'   => 'Masuk'
        ];
        return view('v_login', $data);
    }

    public function auth()
    {
        if ($this->validate([
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi!'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi!'
                ]
            ]
        ])) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $rememberMe = $this->request->getPost('remember');
            $check = $this->ModelLogin->login($username);
            if ($check != '') {
                if (password_verify($password, $check['password'])) {
                    session()->set('id_pengguna', $check['id_pengguna']);
                    session()->set('nrp', $check['nrp']);
                    session()->set('nama', $check['nama']);
                    session()->set('email', $check['email']);
                    session()->set('no_hp', $check['no_hp']);
                    session()->set('username', $check['username']);
                    session()->set('role', $check['role']);
                    session()->set('photo', $check['photo']);
                    session()->set('isLoggedIn', true);

                    if ($rememberMe) {
                        helper('cookie');
                        set_cookie('username', $username, 3600 * 24 * 30);
                        set_cookie('password', password_hash($password, PASSWORD_BCRYPT), 3600 * 24 * 30);
                    }

                    return redirect()->to(base_url('dashboard'));
                } else {
                    session()->setFlashdata('pesan', 'Login gagal. Username atau Password yang Anda masukkan salah.');
                    return redirect()->to(base_url('/'))->withInput();
                }
            } else {
                session()->setFlashdata('pesan', 'Login gagal. Akun Anda tidak ditemukan.');
                return redirect()->to(base_url('/'))->withInput();
            }
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('/'))->withInput();
        }
    }

    public function logout()
    {
        session()->remove('log');
        session()->remove('id_pengguna');
        session()->remove('nrp');
        session()->remove('nama');
        session()->remove('role');
        session()->remove('isLoggedIn');

        return redirect()->to(base_url('/'));
    }
}
