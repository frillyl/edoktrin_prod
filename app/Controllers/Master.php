<?php

namespace App\Controllers;

use App\Models\ModelPengguna;

class Master extends BaseController
{
    protected $ModelPengguna;

    public function __construct()
    {
        helper('form');
        $this->ModelPengguna = new ModelPengguna();
    }

    // MASTER PENGGUNA
    // Index Pengguna
    public function index_pengguna()
    {
        $data = [
            'title' => 'E-Doktrin',
            'sub'   => 'Master Pengguna',
            'content' => 'master/pengguna/v_index',
            'pengguna' => $this->ModelPengguna->allData()
        ];
        return view('layout/v_wrapper', $data);
    }

    // Tambah Pengguna
    public function add_pengguna()
    {
        if ($this->validate([
            'nrp' => [
                'label' => 'NRP',
                'rules' => 'required|is_unique[tb_pengguna.nrp]|min_length[5]|max_length[15]',
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
            'username' => [
                'label' => 'Username',
                'rules' => 'required|is_unique[tb_pengguna.username]|max_length[50]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} sudah terdaftar!',
                    'max_length' => '{field} maksimal terdiri dari 50 karakter!'
                ]
            ],
            'role' => [
                'label' => 'Role',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ],
            'created_by' => [
                'label' => 'Ditambahkan Oleh',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
                ]
            ]
        ])) {
            $nama = $this->request->getPost('nama_depan') . ' ' . $this->request->getPost('nama_belakang');
            $data = array(
                'nrp' => $this->request->getPost('nrp'),
                'nama' => $nama,
                'username' => $this->request->getPost('username'),
                'role' => $this->request->getPost('role'),
                'created_by' => $this->request->getPost('created_by')
            );
            $this->ModelPengguna->add($data);
            session()->setFlashdata('success', 'Data pengguna berhasil ditambahkan.');
            return redirect()->to(base_url('master/pengguna'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('master/pengguna'))->withInput();
        }
    }

    // Ubah Pengguna
    public function edit_pengguna($id_pengguna)
    {
        $penggunaLama = $this->ModelPengguna->find($id_pengguna);
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
            'username' => [
                'label' => 'Username',
                'rules' => 'required|is_unique[tb_pengguna.username,id_pengguna,' . $id_pengguna . ']|max_length[50]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} sudah terdaftar!',
                    'max_length' => '{field} maksimal terdiri dari 50 karakter!'
                ]
            ],
            'role' => [
                'label' => 'Role',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi!'
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
            $data = array(
                'nrp' => $this->request->getPost('nrp'),
                'nama' => $nama,
                'username' => $this->request->getPost('username'),
                'role' => $this->request->getPost('role'),
                'edited_by' => $this->request->getPost('edited_by')
            );
            $this->ModelPengguna->update($id_pengguna, $data);
            session()->setFlashdata('success', 'Data pengguna berhasil diubah.');
            return redirect()->to(base_url('master/pengguna'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('master/pengguna'));
        }
    }

    // Hapus Pengguna
    public function delete_pengguna($id_pengguna)
    {
        if ($id_pengguna == session('id_pengguna')) {
            session()->setFlashdata('pesan', 'Anda tidak dapat menghapus data pengguna Anda sendiri.');
            return redirect()->to(base_url('master/pengguna'));
        }

        $data = [
            'id_pengguna' => $id_pengguna
        ];
        $this->ModelPengguna->delete_data($data);
        session()->setFlashdata('success', 'Data pengguna berhasil dihapus!');
        return redirect()->to(base_url('master/pengguna'));
    }
}
