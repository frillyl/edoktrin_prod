<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPencipta extends Model
{
    protected $table = "tb_pencipta";
    protected $primaryKey = "id_pencipta";
    protected $returnType = "object";
    protected $allowedFields = ['pencipta', 'created_by', 'edited_by'];

    public function allData()
    {
        return $this->db->table('tb_pencipta')
            ->join('tb_pengguna as creator', 'creator.id_pengguna = tb_pencipta.created_by', 'left')
            ->join('tb_pengguna as editor', 'editor.id_pengguna = tb_pencipta.edited_by', 'left')
            ->select('tb_pencipta.*, creator.nama as created_by_name, editor.nama as edited_by_name')
            ->orderBy('tb_pencipta.pencipta')
            ->get()->getResultArray();
    }

    public function detailData($id_pencipta)
    {
        return $this->db->table('tb_pencipta')
            ->where('id_pencipta', $id_pencipta)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_pencipta')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_pencipta')
            ->where('id_pencipta', $data['id_pencipta'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_pencipta')
            ->where('id_pencipta', $data['id_pencipta'])
            ->delete();
    }
}
