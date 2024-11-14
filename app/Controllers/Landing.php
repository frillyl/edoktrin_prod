<?php

namespace App\Controllers;

use App\Models\ModelLanding;

class Landing extends BaseController
{
    protected $ModelLanding;

    public function __construct()
    {
        helper('form');
        helper('text');
        $this->ModelLanding = new ModelLanding();
    }

    public function index()
    {
        $keywords = $this->request->getVar('search');
        $results = [];

        if ($keywords) {
            $results = $this->ModelLanding->searchArsip($keywords);
        }

        $data = [
            'title'   => 'E-Doktrin',
            'results' => $results,
            'search'  => $keywords
        ];

        return view('v_landing', $data);
    }

    public function download($fileName)
    {
        // Tentukan path lengkap berkas
        $filePath = WRITEPATH . 'uploads/' . $fileName; // WRITEPATH otomatis mengarah ke direktori 'writable'

        // Cek apakah berkas ada
        if (file_exists($filePath)) {
            // Dapatkan tipe MIME file
            $mime = mime_content_type($filePath);

            // Mengatur header untuk memastikan ekstensi file sesuai
            return $this->response->setHeader('Content-Type', $mime)
                ->setHeader('Content-Disposition', 'attachment; filename="' . basename($filePath) . '"')
                ->setHeader('Content-Length', filesize($filePath))
                ->download($filePath, null);
        } else {
            // Jika berkas tidak ditemukan, tampilkan pesan atau arahkan ke halaman lain
            return redirect()->to(base_url())->with('error', 'Berkas tidak ditemukan');
        }
    }
}
