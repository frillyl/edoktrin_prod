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
        $keywords = $this->request->getVar('search');
        $results = [];

        if ($keywords) {
            $results = $this->ModelDashboard->searchArsip($keywords);
        }

        $unreadNotifications = $this->ModelNotifikasi->getUnreadNotifications(session()->get('id_pengguna'));
        $unreadCount = count($unreadNotifications);

        $data = [
            'title'   => 'E-Doktrin',
            'sub'     => 'Beranda',
            'content' => 'v_dashboard',
            'results' => $results,
            'search'  => $keywords,
            'unreadNotifications' => $unreadNotifications,
            'unreadCount' => $unreadCount
        ];

        return view('layout/v_wrapper', $data);
    }
}
