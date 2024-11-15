<?php

namespace App\Controllers;

use App\Models\ModelDashboard;
use App\Models\ModelNotifikasi;

class Dashboard extends BaseController
{
    protected $ModelDashboard;
    protected $ModelNotifikasi;

    public function __construct()
    {
        helper('form');
        helper('text');
        $this->ModelDashboard = new ModelDashboard();
        $this->ModelNotifikasi = new ModelNotifikasi();
    }

    public function index()
    {
        $unreadNotifications = $this->ModelNotifikasi->getUnreadNotifications(session()->get('id_pengguna'));
        $unreadCount = count($unreadNotifications);

        $data = [
            'title'   => 'E-Doktrin',
            'sub'     => 'Beranda',
            'content' => 'v_dashboard',
            'unreadNotifications' => $unreadNotifications,
            'unreadCount' => $unreadCount
        ];

        return view('layout/v_wrapper', $data);
    }

    public function search()
    {
        $keywords = $this->request->getPost('keywords');
        $results = $this->ModelDashboard->searchArsip($keywords);

        return $this->response->setJSON($results);
    }

    public function preview($fileName)
    {
        $filePath = WRITEPATH . 'uploads/' . $fileName;
        if (file_exists($filePath)) {
            header('Content-Type: application/pdf');
            readfile($filePath);
            exit;
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function download($fileName)
    {
        $filePath = WRITEPATH . 'uploads/' . $fileName;
        if (file_exists($filePath)) {
            $mime = mime_content_type($filePath);
            return $this->response->setHeader('Content-Type', $mime)
                ->setHeader('Content-Disposition', 'attachment; filename="' . basename($filePath) . '"')
                ->setHeader('Content-Length', filesize($filePath))
                ->download($filePath, null);
        } else {
            return redirect()->to(base_url())->with('error', 'File tidak ditemukan');
        }
    }
}
