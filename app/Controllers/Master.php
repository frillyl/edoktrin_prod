<?php

namespace App\Controllers;

use App\Models\ModelPengguna;
use App\Models\ModelPencipta;
use App\Models\ModelUnit;
use App\Models\ModelKlasifikasi;
use App\Models\ModelNotifikasi;

class Master extends BaseController
{
    protected $ModelPengguna;
    protected $ModelPencipta;
    protected $ModelUnit;
    protected $ModelKlasifikasi;
    protected $ModelNotifikasi;

    public function __construct()
    {
        helper('form');
        $this->ModelPengguna = new ModelPengguna();
        $this->ModelPencipta = new ModelPencipta();
        $this->ModelUnit = new ModelUnit();
        $this->ModelKlasifikasi = new ModelKlasifikasi();
        $this->ModelNotifikasi = new ModelNotifikasi();
    }

    // MASTER PENGGUNA
    // Index Pengguna
    public function index_pengguna()
    {
        $unreadNotifications = $this->ModelNotifikasi->getUnreadNotifications(session()->get('id_pengguna'));
        $unreadCount = count($unreadNotifications);
        $data = [
            'title' => 'E-Doktrin',
            'sub'   => 'Master Pengguna',
            'content' => 'master/pengguna/v_index',
            'pengguna' => $this->ModelPengguna->allData(),
            'unreadNotifications' => $unreadNotifications,
            'unreadCount' => $unreadCount
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
            $pesan = "Pengguna baru dengan nama {$nama} telah ditambahkan";
            $this->ModelNotifikasi->addNotification($data['created_by'], 'pengguna', 'add', $pesan);
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
            $pesan = "Data pengguna dengan nama {$nama} telah diubah";
            $this->ModelNotifikasi->addNotification($data['edited_by'], 'pengguna', 'edit', $pesan);
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

        $pengguna = $this->ModelPengguna->getPenggunaById($id_pengguna);
        $nama = $pengguna['nama'] ?? 'Pengguna';

        $data = [
            'id_pengguna' => $id_pengguna
        ];
        $this->ModelPengguna->delete_data($data);
        $pesan = "Pengguna dengan nama {$nama} telah dihapus";
        $this->ModelNotifikasi->addNotification(session('id_pengguna'), 'pengguna', 'delete', $pesan);
        session()->setFlashdata('success', 'Data pengguna berhasil dihapus!');
        return redirect()->to(base_url('master/pengguna'));
    }

    // Reset Password Pengguna
    public function reset_password($id_pengguna)
    {
        $passwordDefault = password_hash('defaultpassword', PASSWORD_BCRYPT);

        $pengguna = $this->ModelPengguna->getPenggunaById($id_pengguna);
        $nama = $pengguna['nama'] ?? 'Pengguna';

        $data = [
            'id_pengguna' => $id_pengguna,
            'password' => $passwordDefault,
            'is_default_password' => TRUE
        ];
        $this->ModelPengguna->edit($data);
        $pesan = "Password pengguna dengan nama {$nama} telah direset.";
        $this->ModelNotifikasi->addNotification(session('id_pengguna'), 'pengguna', 'reset', $pesan);
        session()->setFlashdata('success', 'Password pengguna berhasil direset');
        return redirect()->to(base_url('master/pengguna'));
    }

    // MASTER PENCIPTA
    // Index Asal Doktrin
    public function index_pencipta()
    {
        $unreadNotifications = $this->ModelNotifikasi->getUnreadNotifications(session()->get('id_pengguna'));
        $unreadCount = count($unreadNotifications);
        $data = [
            'title' => 'E-Doktrin',
            'sub'   => 'Master Asal Doktrin',
            'content' => 'master/pencipta/v_index',
            'pencipta' => $this->ModelPencipta->allData(),
            'unreadNotifications' => $unreadNotifications,
            'unreadCount' => $unreadCount
        ];
        return view('layout/v_wrapper', $data);
    }

    // Tambah Asal Doktrin
    public function add_pencipta()
    {
        if ($this->validate([
            'pencipta' => [
                'label' => 'Asal Doktrin',
                'rules' => 'required|is_unique[tb_pencipta.pencipta]|max_length[100]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} sudah terdaftar!',
                    'max_length' => '{field} maksimal terdiri dari 100 karakter!'
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
            $data = array(
                'pencipta' => $this->request->getPost('pencipta'),
                'created_by' => $this->request->getPost('created_by')
            );
            $this->ModelPencipta->add($data);
            $pesan = "Asal doktrin baru dengan nama {$data['pencipta']} telah ditambahkan";
            $this->ModelNotifikasi->addNotification($data['created_by'], 'asal doktrin', 'add', $pesan);
            session()->setFlashdata('success', 'Data asal doktrin berhasil ditambahkan.');
            return redirect()->to(base_url('master/pencipta'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('master/pencipta'));
        }
    }

    // Ubah Asal Doktrin
    public function edit_pencipta($id_pencipta)
    {
        $dataLama = $this->ModelPencipta->find($id_pencipta);
        if ($this->validate([
            'pencipta' => [
                'label' => 'Asal Doktrin',
                'rules' => 'required|is_unique[tb_pencipta.pencipta,id_pencipta,' . $id_pencipta . ']|max_length[100]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} sudah terdaftar!',
                    'max_length' => '{field} maksimal terdiri dari 100 karakter!'
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
            $data = array(
                'pencipta' => $this->request->getPost('pencipta'),
                'edited_by' => $this->request->getPost('edited_by')
            );
            $this->ModelPencipta->update($id_pencipta, $data);
            $pesan = "Data asal doktrin dengan nama {$data['pencipta']} telah diubah";
            $this->ModelNotifikasi->addNotification($data['edited_by'], 'asal doktrin', 'edit', $pesan);
            session()->setFlashdata('success', 'Data asal doktrin berhasil diubah.');
            return redirect()->to(base_url('master/pencipta'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('master/pencipta'));
        }
    }

    // Hapus Asal Doktrin
    public function delete_pencipta($id_pencipta)
    {
        $pencipta = $this->ModelPencipta->getPenciptaById($id_pencipta);
        $pencipta = $pencipta['pencipta'] ?? 'Pencipta';
        $data = [
            'id_pencipta' => $id_pencipta
        ];
        $this->ModelPencipta->delete_data($data);
        $pesan = "Asal doktrin dengan nama {$pencipta} telah dihapus";
        $this->ModelNotifikasi->addNotification(session('id_pengguna'), 'asal doktrin', 'delete', $pesan);
        session()->setFlashdata('success', 'Data asal doktrin berhasil dihapus!');
        return redirect()->to(base_url('master/pencipta'));
    }

    // MASTER UNIT ORGANISASI
    // Index Unit Organisasi
    public function index_unit()
    {
        $unreadNotifications = $this->ModelNotifikasi->getUnreadNotifications(session()->get('id_pengguna'));
        $unreadCount = count($unreadNotifications);
        $data = [
            'title' => 'E-Doktrin',
            'sub'   => 'Master Unit Organisasi',
            'content' => 'master/unit/v_index',
            'unit' => $this->ModelUnit->allData(),
            'unreadNotifications' => $unreadNotifications,
            'unreadCount' => $unreadCount
        ];
        return view('layout/v_wrapper', $data);
    }

    // Tambah Unit Organisasi
    public function add_unit()
    {
        if ($this->validate([
            'unit' => [
                'label' => 'Unit Organisasi',
                'rules' => 'required|is_unique[tb_unit.unit]|max_length[100]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} sudah terdaftar!',
                    'max_length' => '{field} maksimal terdiri dari 100 karakter!'
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
            $data = array(
                'unit' => $this->request->getPost('unit'),
                'created_by' => $this->request->getPost('created_by')
            );
            $this->ModelUnit->add($data);
            session()->setFlashdata('success', 'Data unit organisasi berhasil ditambahkan.');
            return redirect()->to(base_url('master/unit'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('master/unit'));
        }
    }

    // Ubah Unit Organisasi
    public function edit_unit($id_unit)
    {
        $dataLama = $this->ModelUnit->find($id_unit);
        if ($this->validate([
            'unit' => [
                'label' => 'Unit Organisasi Arsip',
                'rules' => 'required|is_unique[tb_unit.unit,id_unit,' . $id_unit . ']|max_length[100]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} sudah terdaftar!',
                    'max_length' => '{field} maksimal terdiri dari 100 karakter!'
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
            $data = array(
                'unit' => $this->request->getPost('unit'),
                'edited_by' => $this->request->getPost('edited_by')
            );
            $this->ModelUnit->update($id_unit, $data);
            session()->setFlashdata('success', 'Data unit organisasi berhasil diubah.');
            return redirect()->to(base_url('master/unit'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('master/unit'));
        }
    }

    // Hapus Unit Organisasi
    public function delete_unit($id_unit)
    {
        $data = [
            'id_unit' => $id_unit
        ];
        $this->ModelUnit->delete_data($data);
        session()->setFlashdata('success', 'Data unit organisasi berhasil dihapus!');
        return redirect()->to(base_url('master/unit'));
    }

    // MASTER JENIS DOKTRIN
    public function index_klasifikasi()
    {
        $unreadNotifications = $this->ModelNotifikasi->getUnreadNotifications(session()->get('id_pengguna'));
        $unreadCount = count($unreadNotifications);
        $data = [
            'title' => 'E-Doktrin',
            'sub'   => 'Master Jenis Doktrin',
            'content' => 'master/klasifikasi/v_index',
            'klasifikasi' => $this->ModelKlasifikasi->allData(),
            'unreadNotifications' => $unreadNotifications,
            'unreadCount' => $unreadCount
        ];
        return view('layout/v_wrapper', $data);
    }

    // Tambah Jenis Doktrin
    public function add_klasifikasi()
    {
        if ($this->validate([
            'kode' => [
                'label' => 'Kode Doktrin',
                'rules' => 'permit_empty|is_unique[tb_klasifikasi.kode]|max_length[15]',
                'errors' => [
                    'permit_empty' => '{field} boleh kosong!',
                    'is_unique' => '{field} sudah terdaftar!',
                    'max_length' => '{field} maksimal terdiri dari 15 karakter!'
                ]
            ],
            'klasifikasi' => [
                'label' => 'Jenis Doktrin',
                'rules' => 'required|is_unique[tb_klasifikasi.klasifikasi]|max_length[100]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} sudah terdaftar!',
                    'max_length' => '{field} maksimal terdiri dari 100 karakter!'
                ]
            ],
            'retensi' => [
                'label' => 'Retensi',
                'rules' => 'permit_empty',
                'errors' => [
                    'permit_empty' => '{field} boleh kosong!'
                ]
            ],
            'kategori' => [
                'label' => 'Kategori',
                'rules' => 'permit_empty',
                'errors' => [
                    'permit_empty' => '{field} boleh kosong!'
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
            $data = array(
                'kode' => $this->request->getPost('kode'),
                'klasifikasi' => $this->request->getPost('klasifikasi'),
                'retensi' => $this->request->getPost('retensi'),
                'kategori' => $this->request->getPost('kategori'),
                'created_by' => $this->request->getPost('created_by')
            );
            $this->ModelKlasifikasi->add($data);
            session()->setFlashdata('success', 'Data jenis doktrin berhasil ditambahkan.');
            return redirect()->to(base_url('master/klasifikasi'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('master/klasifikasi'));
        }
    }

    // Ubah Jenis Doktrin
    public function edit_klasifikasi($id_klasifikasi)
    {
        $dataLama = $this->ModelKlasifikasi->find($id_klasifikasi);
        if ($this->validate([
            'kode' => [
                'label' => 'Kode Doktrin',
                'rules' => 'permit_empty|is_unique[tb_klasifikasi.kode,id_klasifikasi,' . $id_klasifikasi . ']|max_length[15]',
                'errors' => [
                    'permit_empty' => '{field} boleh kosong!',
                    'is_unique' => '{field} sudah terdaftar!',
                    'max_length' => '{field} maksimal terdiri dari 15 karakter!'
                ]
            ],
            'klasifikasi' => [
                'label' => 'Jenis Doktrin',
                'rules' => 'required|is_unique[tb_klasifikasi.klasifikasi,id_klasifikasi,' . $id_klasifikasi . ']|max_length[100]',
                'errors' => [
                    'required' => '{field} wajib diisi!',
                    'is_unique' => '{field} sudah terdaftar!',
                    'max_length' => '{field} maksimal terdiri dari 100 karakter!'
                ]
            ],
            'retensi' => [
                'label' => 'Retensi',
                'rules' => 'permit_empty',
                'errors' => [
                    'permit_empty' => '{field} boleh kosong!'
                ]
            ],
            'kategori' => [
                'label' => 'Kategori',
                'rules' => 'permit_empty',
                'errors' => [
                    'permit_empty' => '{field} boleh kosong!'
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
            $data = array(
                'kode' => $this->request->getPost('kode'),
                'klasifikasi' => $this->request->getPost('klasifikasi'),
                'retensi' => $this->request->getPost('retensi'),
                'kategori' => $this->request->getPost('kategori'),
                'edited_by' => $this->request->getPost('edited_by')
            );
            $this->ModelKlasifikasi->update($id_klasifikasi, $data);
            session()->setFlashdata('success', 'Data jenis doktrin berhasil diubah.');
            return redirect()->to(base_url('master/klasifikasi'));
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('master/klasifikasi'));
        }
    }

    // Hapus Jenis Doktrin
    public function delete_klasifikasi($id_klasifikasi)
    {
        $data = [
            'id_klasifikasi' => $id_klasifikasi
        ];
        $this->ModelKlasifikasi->delete_data($data);
        session()->setFlashdata('success', 'Data jenis doktrin berhasil dihapus!');
        return redirect()->to(base_url('master/klasifikasi'));
    }
}
