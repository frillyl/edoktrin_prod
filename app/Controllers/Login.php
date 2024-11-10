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
                    session()->set([
                        'id_pengguna' => $check['id_pengguna'],
                        'nrp' => $check['nrp'],
                        'nama' => $check['nama'],
                        'email' => $check['email'],
                        'no_hp' => $check['no_hp'],
                        'username' => $check['username'],
                        'role' => $check['role'],
                        'photo' => $check['photo'],
                        'isLoggedIn' => true
                    ]);

                    if ($rememberMe) {
                        helper('cookie');
                        set_cookie('username', $username, 3600 * 24 * 30);
                        set_cookie('password', password_hash($password, PASSWORD_BCRYPT), 3600 * 24 * 30);
                    }

                    // Jika password adalah default, redirect ke halaman ganti password
                    if ($check['is_default_password']) {
                        return redirect()->to(base_url('login/change_password'));
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


    public function change_password()
    {
        $data = [
            'title' => 'E-Doktrin',
            'sub'   => 'Perbarui Kata Sandi'
        ];
        return view('v_change_password', $data);
    }

    public function update_password()
    {
        $id_pengguna = session()->get('id_pengguna');
        if ($this->validate([
            'new_password' => [
                'label' => 'Password Baru',
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'min_length' => '{field} minimal terdiri dari 8 karakter!'
                ]
            ],
            'confirm_password' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'matches[new_password]',
                'errors' => [
                    'matches' => '{field} tidak sesuai dengan Password Baru!'
                ]
            ]
        ])) {
            $new_password = $this->request->getPost('new_password');
            $data = [
                'password' => password_hash($new_password, PASSWORD_BCRYPT),
                'is_default_password' => FALSE
            ];
            $this->ModelLogin->update($id_pengguna, $data);
            session()->setFlashdata('success', 'Password berhasil diubah.');
            return redirect()->to(base_url('dashboard'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('login/change_password'));
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
