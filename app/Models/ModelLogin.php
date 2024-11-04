<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLogin extends Model
{
    public function login($username)
    {
        return $this->db->table('tb_pengguna')->where('username', $username)
            ->get()
            ->getRowArray();
    }
}
