<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLanding extends Model
{
    protected $table = "tb_arsip";
    protected $primaryKey = "id_arsip";
    protected $returnType = "object";
    protected $allowedFields = ['no_arsip', 'tgl_doktrin', 'id_pencipta', 'id_klasifikasi', 'perihal', 'tgl_masuk', 'id_unit', 'nama_file', 'tipe_file', 'path_file', 'isi_file', 'created_by', 'edited_by'];

    public function searchArsip($keywords)
    {
        return $this->select('tb_arsip.*')
            ->join('tb_klasifikasi', 'tb_arsip.id_klasifikasi = tb_klasifikasi.id_klasifikasi')
            ->where('tb_klasifikasi.kategori', '3')
            ->groupStart() // Untuk mulai grouping kondisi pencarian
            ->like('tb_arsip.no_arsip', $keywords)
            ->orLike('tb_arsip.perihal', $keywords)
            ->orLike('tb_arsip.nama_file', $keywords)
            ->orLike('tb_arsip.isi_file', $keywords)
            ->groupEnd() // Menutup grouping
            ->asArray()
            ->findAll();
    }
}
