<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPengguna extends Model
{
    protected $table = "tb_pengguna";
    protected $primaryKey = "id_pengguna";
    protected $returnType = "object";
    protected $allowedFields = ['id_pengguna', 'nrp', 'nama', 'username', 'password', 'created_by', 'edited_by', 'role', 'is_default_password'];

    public function allData()
    {
        return $this->db->table('tb_pengguna')
            ->join('tb_pengguna as creator', 'creator.id_pengguna = tb_pengguna.created_by', 'left')
            ->join('tb_pengguna as editor', 'editor.id_pengguna = tb_pengguna.edited_by', 'left')
            ->select('tb_pengguna.*, creator.nama as created_by_name, editor.nama as edited_by_name')
            ->orderBy('nama')
            ->get()->getResultArray();
    }

    public function getPenggunaById($id_pengguna)
    {
        return $this->where('id_pengguna', $id_pengguna)->get()->getRowArray();
    }

    public function detailData($id_pengguna)
    {
        return $this->db->table('tb_pengguna')
            ->where('id_pengguna', $id_pengguna)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_pengguna')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_pengguna')
            ->where('id_pengguna', $data['id_pengguna'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_pengguna')
            ->where('id_pengguna', $data['id_pengguna'])
            ->delete($data);
    }
}
