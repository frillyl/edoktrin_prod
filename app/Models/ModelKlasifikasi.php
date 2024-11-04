<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKlasifikasi extends Model
{
    protected $table = "tb_klasifikasi";
    protected $primaryKey = "id_klasifikasi";
    protected $returnType = "object";
    protected $allowedFields = ['kode', 'klasifikasi', 'retensi', 'kategori', 'created_by', 'edited_by'];

    public function allData()
    {
        return $this->db->table('tb_klasifikasi')
            ->join('tb_pengguna as creator', 'creator.id_pengguna = tb_klasifikasi.created_by', 'left')
            ->join('tb_pengguna as editor', 'editor.id_pengguna = tb_klasifikasi.edited_by', 'left')
            ->select('tb_klasifikasi.*, creator.nama as created_by_name, editor.nama as edited_by_name')
            ->orderBy('tb_klasifikasi.kode')
            ->get()->getResultArray();
    }


    public function detailData($id_klasifikasi)
    {
        return $this->db->table('tb_klasifikasi')
            ->where('id_klasifikasi', $id_klasifikasi)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_klasifikasi')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_klasifikasi')
            ->where('id_klasifikasi', $data['id_klasifikasi'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_klasifikasi')
            ->where('id_klasifikasi', $data['id_klasifikasi'])
            ->delete();
    }
}
