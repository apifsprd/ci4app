<?php

namespace App\Controllers;

use App\Models\KomikModel;

class komiks extends BaseController
{
    protected $komikModel;

    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }

    public function index()
    {
        $komik = $this->komikModel->findAll();
        // dd($komik);

        $data = [
            'title' => 'Daftar Komik | WPU',
            'komik' => $komik
        ];

        return view('komik/index', $data);
    }
}
