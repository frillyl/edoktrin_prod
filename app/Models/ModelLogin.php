<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLogin extends Model
{

    protected $table = "tb_pengguna";
    protected $primaryKey = "id_pengguna";
    protected $returnType = "object";
    protected $allowedFields = ['id_pengguna', 'nrp', 'nama', 'username', 'password', 'created_by', 'edited_by', 'role', 'is_default_password'];

    public function login($username)
    {
        return $this->db->table('tb_pengguna')->where('username', $username)
            ->get()
            ->getRowArray();
    }

    public function edit($data)
    {
        $this->db->table('tb_pengguna')
            ->where('id_pengguna', $data['id_pengguna'])
            ->update($data);
    }
}
