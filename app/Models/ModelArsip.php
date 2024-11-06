<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelArsip extends Model
{
    protected $table = "tb_arsip";
    protected $primaryKey = "id_arsip";
    protected $returnType = "object";
    protected $allowedFields = ['no_arsip', 'tgl_doktrin', 'id_pencipta', 'id_klasifikasi', 'perihal', 'tgl_masuk', 'id_unit', 'nama_file', 'tipe_file', 'path_file', 'isi_file', 'created_by', 'edited_by'];

    public function allData()
    {
        return $this->db->table('tb_arsip')
            ->distinct()
            ->join('tb_pengguna as creator', 'creator.id_pengguna = tb_arsip.created_by', 'left')
            ->join('tb_pengguna as editor', 'editor.id_pengguna = tb_arsip.edited_by', 'left')
            ->join('tb_pencipta', 'tb_pencipta.id_pencipta = tb_arsip.id_pencipta', 'left')
            ->join('tb_unit', 'tb_unit.id_unit = tb_arsip.id_unit', 'left')
            ->join('tb_klasifikasi', 'tb_klasifikasi.id_klasifikasi = tb_arsip.id_klasifikasi', 'left')
            ->select('tb_arsip.*, creator.nama as created_by_name, editor.nama as edited_by_name')
            ->select('tb_pencipta.pencipta')
            ->select('tb_unit.unit')
            ->select('tb_klasifikasi.kode, klasifikasi, retensi, kategori')
            ->orderBy('tb_arsip.no_arsip')
            ->get()->getResultArray();
    }

    public function detailData($id_arsip)
    {
        return $this->db->table('tb_arsip')
            ->where('id_arsip', $id_arsip)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tb_arsip')->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tb_arsip')
            ->where('id_arsip', $data['id_arsip'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tb_arsip')
            ->where('id_arsip', $data['id_arsip'])
            ->delete();
    }

    public function searchArsip($keywords)
    {
        return $this->like('no_arsip', $keywords)
            ->orLike('perihal', $keywords)
            ->orLike('nama_file', $keywords)
            ->orLike('isi_file', $keywords)
            ->asArray()
            ->findAll();
    }
}
