<?php

namespace App\Controllers;

use App\Models\ModelDashboard;

class Dashboard extends BaseController
{
    protected $ModelDashboard;

    public function __construct()
    {
        helper('form');
        helper('text');
        $this->ModelDashboard = new ModelDashboard();
    }

    public function index()
    {
        $keywords = $this->request->getVar('search');
        $results = [];

        if ($keywords) {
            $results = $this->ModelDashboard->searchArsip($keywords);
        }

        $data = [
            'title'   => 'E-Doktrin',
            'sub'     => 'Beranda',
            'content' => 'v_dashboard',
            'results' => $results,
            'search'  => $keywords
        ];

        return view('layout/v_wrapper', $data);
    }
}
