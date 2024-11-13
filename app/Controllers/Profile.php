<?php

namespace App\Controllers;

use App\Models\ModelProfile;
use App\Models\ModelNotifikasi;

class Profile extends BaseController
{
    protected $ModelProfile;
    protected $ModelNotifikasi;

    public function __construct()
    {
        helper('form');
        $this->ModelProfile = new ModelProfile();
        $this->ModelNotifikasi = new ModelNotifikasi();
    }

    public function index()
    {
        $id_pengguna = session()->get('id_pengguna');
        $pengguna = $this->ModelProfile->find($id_pengguna);

        $namaLengkap = $pengguna->nama;
        $namaArray = explode(' ', $namaLengkap, 2);
        $nama_depan = $namaArray[0];
        $nama_belakang = isset($namaArray[1]) ? $namaArray[1] : '';

        $unreadNotifications = $this->ModelNotifikasi->getUnreadNotifications(session()->get('id_pengguna'));
        $unreadCount = count($unreadNotifications);

        $data = [
            'title' => 'E-Doktrin',
            'sub' => 'Profil Saya',
            'content' => 'profile/v_index',
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'pengguna' => $pengguna,
            'unreadNotifications' => $unreadNotifications,
            'unreadCount' => $unreadCount
        ];
        return view('layout/v_wrapper', $data);
    }

    public function edit()
    {
        $session = session();
        $id_pengguna = $session->get('id_pengguna');
        $penggunaLama = $this->ModelProfile->find($id_pengguna);

        if ($this->validate([
            'nrp' => [
                'label' => 'NRP',
                'rules' => 'required|is_unique[tb_pengguna.nrp,id_pengguna,' . $id_pengguna . ']|min_length[5]|max_length[15]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} sudah terdaftar!',
                    'min_length' => '{field} minimal terdiri dari 5 karakter!',
                    'max_length' => '{field} maksimal terdiri dari 15 karakter!'
                ]
            ],
            'nama_depan' => [
                'label' => 'Nama Depan',
                'rules' => 'required|max_length[75]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'max_length' => '{field} maksimal terdiri dari 75 karakter!'
                ]
            ],
            'nama_belakang' => [
                'label' => 'Nama Belakang',
                'rules' => 'permit_empty|max_length[75]',
                'errors' => [
                    'permit_empty' => '{field} boleh kosong!',
                    'max_length' => '{field} maksimal terdiri dari 75 karakter!'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|is_unique[tb_pengguna.email,id_pengguna,' . $id_pengguna . ']|max_length[100]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} sudah terdaftar!',
                    'max_length' => '{field} maksimal terdiri dari 50 karakter!'
                ]
            ],
            'no_hp' => [
                'label' => 'Nomor HP',
                'rules' => 'permit_empty|is_unique[tb_pengguna.no_hp,id_pengguna,' . $id_pengguna . ']|max_length[15]',
                'errors' => [
                    'permit_empty' => '{field} boleh kosong!',
                    'is_unique' => '{field} sudah terdaftar!',
                    'max_length' => '{field} maksimal terdiri dari 50 karakter!'
                ]
            ],
            'username' => [
                'label' => 'Username',
                'rules' => 'required|is_unique[tb_pengguna.username,id_pengguna,' . $id_pengguna . ']|max_length[50]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} sudah terdaftar!',
                    'max_length' => '{field} maksimal terdiri dari 50 karakter!'
                ]
            ],
            'photo' => [
                'label' => 'Ganti Foto',
                'rules' => 'permit_empty|mime_in[photo,image/jpg,image/jpeg,image/png]|max_size[foto,2048]',
                'errors' => [
                    'permit_empty' => '{field} boleh kosong!',
                    'mime_in' => 'Format file {field} harus berupa gambar JPG, JPEG, atau PNG!',
                    'max_size' => 'Ukuran file {field} maksimal 2MB!'
                ]
            ],
            'edited_by' => [
                'label' => 'Diubah Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ]
        ])) {
            $nama = $this->request->getPost('nama_depan') . ' ' . $this->request->getPost('nama_belakang');
            $fileFoto = $this->request->getFile('photo');

            if ($fileFoto && $fileFoto->isValid() && !$fileFoto->hasMoved()) {
                $namaFoto = $fileFoto->getRandomName();
                $fileFoto->move('public/assets/images/profile_pict', $namaFoto);

                // Cek jika foto pengguna lama bukan default.png sebelum dihapus
                if ($penggunaLama['photo'] && $penggunaLama['photo'] !== 'default.png' && file_exists('public/assets/images/profile_pict/' . $penggunaLama['photo'])) {
                    unlink('public/assets/images/profile_pict/' . $penggunaLama['photo']);
                }
            } else {
                $namaFoto = $penggunaLama->photo; // Gunakan foto lama jika tidak ada yang di-upload
            }

            $data = [
                'id_pengguna' => $id_pengguna,
                'nrp' => $this->request->getPost('nrp'),
                'nama' => $nama,
                'email' => $this->request->getPost('email'),
                'no_hp' => $this->request->getPost('no_hp'),
                'username' => $this->request->getPost('username'),
                'photo' => $namaFoto,
                'edited_by' => $this->request->getPost('edited_by')
            ];

            $this->ModelProfile->edit($data);

            $updatedSession = $this->ModelProfile->find($id_pengguna);
            session()->set([
                'nrp' => $updatedSession->nrp,
                'email' => $updatedSession->email,
                'no_hp' => $updatedSession->no_hp,
                'username' => $updatedSession->username,
                'photo' => $updatedSession->photo,
            ]);

            session()->setFlashdata('success', 'Data pengguna berhasil diubah.');
            return redirect()->to(base_url('profile'))->withInput();
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('profile'))->withInput();
        }
    }
}
