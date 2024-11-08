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
            'sub'     => 'Halaman Utama',
            'results' => $results,
            'search'  => $keywords
        ];

        return view('v_landing', $data);
    }
}
