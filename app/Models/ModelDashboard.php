<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDashboard extends Model
{
    protected $table = "tb_arsip";
    protected $primaryKey = "id_arsip";
    protected $returnType = "object";
    protected $allowedFields = ['no_arsip', 'tgl_doktrin', 'id_pencipta', 'id_klasifikasi', 'perihal', 'tgl_masuk', 'id_unit', 'nama_file', 'tipe_file', 'path_file', 'isi_file', 'created_by', 'edited_by'];

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
