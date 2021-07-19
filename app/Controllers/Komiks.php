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
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan file gambar',
                    'mime_in'  => 'Yang anda pilih bukan file gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/komiks/create')->withInput()->with('validation', $validation);
            return redirect()->to('/komiks/create')->withInput();
        }

        // dd($this->request->getVar());

        // ambil gambar dulu
        $fileSampul = $this->request->getFile('sampul');

        // cek apakah user tidak upload gambar
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.png';
        } else {
            // pindahin file ke public/img/
            $fileSampul->move('img');
            // ambil nama file
            $namaSampul = $fileSampul->getName();
        }

        $slug = url_title($this->request->getVar('judul'), '-', TRUE);
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');

        return redirect()->to('/komiks');
    }

    public function delete($id)
    {
        // cari gambari by ID
        $komik = $this->komikModel->find($id);

        // cek apakah gambar default
        if ($komik['sampul'] != 'default.png') {
            // hapus gambar
            unlink('img/' . $komik['sampul']);
        }


        $this->komikModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/komiks');
    }

    public function edit($slug)
    {
        // session();
        $data = [
            'title' => 'Edit Data Komik | WPU',
            'validation' => \Config\Services::validation(),
            'komik' => $this->komikModel->getKomik($slug)
        ];

        return view('komik/edit', $data);
    }

    public function update($id)
    {
        // cek judul
        $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
        if ($komikLama['judul'] == $this->request->getVar('judul')) {
            $rules = 'required';
        } else {
            $rules = 'required|is_unique[komik.judul]';
        }


        // Validasi 
        if (!$this->validate([
            'judul' => [
                'rules' => $rules,
                'errors' => [
                    'required' => '{field} Komik harus diisi.',
                    'is_unique' => '{field} Komik sudah terdaftar.',
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan file gambar',
                    'mime_in'  => 'Yang anda pilih bukan file gambar'
                ]
            ]
        ])) {
            return redirect()->to('/komiks/edit/' . $this->request->getVar('slug'))->withInput();
        }

        // ambil file sampul
        $fileSampul = $this->request->getFile('sampul');

        // cek gambar apakah berubah atau tidak
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            // pindahin file ke public/img/
            $fileSampul->move('img');
            // ambil nama file
            $namaSampul = $fileSampul->getName();
            // hapus file lama
            // cek apakah gambar default
            if ($this->request->getVar('sampulLama') != 'default.png') {
                // hapus gambar
                unlink('img/' . $this->request->getVar('sampulLama'));
            }
        }

        $slug = url_title($this->request->getVar('judul'), '-', TRUE);
        $this->komikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul,
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Diubah');

        return redirect()->to('/komiks');
    }
}
