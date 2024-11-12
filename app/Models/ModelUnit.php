<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUnit extends Model
{
    protected $table = "tb_unit";
    protected $primaryKey = "id_unit";
    protected $returnType = "object";
    protected $allowedFields = ['unit', 'created_by', 'edited_by'];

    public function allData()
    {
        return $this->db->table('tb_unit')
            ->join('tb_pengguna as creator', 'creator.id_pengguna = tb_unit.created_by', 'left')
            ->join('tb_pengguna as editor', 'editor.id_pengguna = tb_unit.edited_by', 'left')
            ->select('tb_unit.*, creator.nama as created_by_name, editor.nama as edited_by_name')
            ->orderBy('tb_unit.unit')
            ->get()->getResultArray();
    }

    public function getUnitById($id_unit)
    {
        return $this->where('id_unit', $id_unit)->get()->getRowArray();
    }

    public function detailData($id_unit)
    {
        return $this->db->table('tb_unit')
            ->where('id_unit', $id_unit)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_unit')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_unit')
            ->where('id_unit', $data['id_unit'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_unit')
            ->where('id_unit', $data['id_unit'])
            ->delete($data);
    }
}
