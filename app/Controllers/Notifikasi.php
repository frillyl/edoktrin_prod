<?php

namespace App\Controllers;

use App\Models\ModelNotifikasi;

class Notifikasi extends BaseController
{
    public function markAllRead()
    {
        $model = new ModelNotifikasi();
        $model->markAllRead();

        return $this->response->setJSON(['status' => 'success', 'message' => 'All notifications marked as read.']);
    }

    public function markAsRead()
    {
        $data = $this->request->getJSON();
        $id_notifikasi = $data->id_notifikasi;

        $model = new ModelNotifikasi();
        $model->markAsRead($id_notifikasi);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Notification marked as read']);
    }
}
