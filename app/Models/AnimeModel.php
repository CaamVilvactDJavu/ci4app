<?php

namespace App\Models;

use CodeIgniter\Model;

class AnimeModel extends Model
{
    protected $table = 'anime';
    protected $useTimestamps = true;
    protected $allowedFields = ['judul', 'slug', 'penulis', 'penerbit', 'genre', 'keterangan', 'sampul'];

    public function getAnime($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['slug' => $slug])->first();
    }
    public function search($keyword)
    {
        //    $builder = $this->table('anime');
        //    $builder->like('judul', $keyword);
        //    return $builder;
        return $this->table('anime')->like('judul', $keyword)->orLike('genre', $keyword);
    }
}
