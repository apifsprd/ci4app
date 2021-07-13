<?php

namespace App\Models;

use CodeIgniter\Model;

class KomikModel extends Model
{
    protected $table = 'komik';
    protected $primaryKey = 'id';
    protected $useTimestamps = 'True';
    protected $allowedFields = [
        'judul',
        'slug',
        'penulis',
        'penerbit',
        'sampul'
    ];

    public function getKomik($slug = FALSE)
    {
        if ($slug == FALSE) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}
