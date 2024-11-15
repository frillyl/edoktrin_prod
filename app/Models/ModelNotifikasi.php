<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelNotifikasi extends Model
{
    protected $table = "tb_notifikasi";
    protected $primaryKey = "id_notifikasi";
    protected $returnType = "object";
    protected $allowedFields = ['id_pengguna', 'jenis_aksi', 'pesan', 'status', 'created_at', 'jenis_entitas'];

    public function addNotification($id_pengguna, $jenis_entitas, $jenis_aksi, $pesan)
    {
        $data = [
            'id_pengguna' => $id_pengguna,
            'jenis_entitas' => $jenis_entitas,
            'jenis_aksi' => $jenis_aksi,
            'pesan' => $pesan,
            'status' => 'unread'
        ];
        $this->db->table('tb_notifikasi')->insert($data);
    }

    public function getUnreadNotifications()
    {
        return $this->db->table('tb_notifikasi')
            ->join('tb_pengguna as creator', 'creator.id_pengguna = tb_notifikasi.id_pengguna', 'left')
            ->where('status', 'unread')
            ->select('tb_notifikasi.*, creator.nama as created_by_name')
            ->orderBy('tb_notifikasi.created_at', 'DESC')
            ->get()->getResultArray();
    }

    public function markAllRead()
    {
        $this->db->table('tb_notifikasi')
            ->where('status', 'unread')
            ->update(['status' => 'read']);
    }

    public function markAsRead($id_notifikasi)
    {
        if (!$id_notifikasi) {
            throw new \InvalidArgumentException('ID notifikasi tidak boleh null.');
        }

        return $this->update($id_notifikasi, ['status' => 'read']);
    }
}
