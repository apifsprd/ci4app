<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komiks extends BaseController
{
    protected $komikModel;

    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }

    public function index()
    {
        // $komik = $this->komikModel->findAll();
        // dd($komik);

        $data = [
            'title' => 'Daftar Komik | WPU',
            'komik' => $this->komikModel->getKomik()
        ];

        return view('komik/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Daftar Komik | WPU',
            'komik' => $this->komikModel->getKomik($slug)
        ];

        // if komik tidak ada ditabel
        if (empty($data['komik'])) {
            throw new \Codeigniter\Exceptions\PageNotFoundException('Judul Komik' . $slug . ' tidak di temukan');
        }

        return view('komik/detail', $data);
    }

    public function create()
    {
        // session();
        $data = [
            'title' => 'Tambah Data  Komik | WPU',
            'validation' => \Config\Services::validation()
        ];

        return view('komik/create', $data);
    }

    public function save()
    {
        // Validasi 
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => '{field} Komik harus diisi.',
                    'is_unique' => '{field} Komik sudah terdaftar.',
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/komiks/create')->withInput()->with('validation', $validation);
        }


        // dd($this->request->getVar());
        $slug = url_title($this->request->getVar('judul'), '-', TRUE);

        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul'),
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');

        return redirect()->to('/komiks');
    }
}
