<?php

namespace App\Controllers;

use App\Models\AnimeModel;

class Anime extends BaseController
{
    protected $animeModel;
    public function __construct()
    {
        $this->animeModel = new AnimeModel();
    }
    public function index()
    {
        // $anime = $this->animeModel->findAll();
        $data = [
            'title' => 'Daftar Anime',
            'anime' => $this->animeModel->getAnime()
        ];
        return view('anime/index', $data);
    }

    public function detail($slug)
    {

        $data = [
            'title' => 'Detail Anime',
            'anime' => $this->animeModel->getAnime($slug)
        ];

        // jika anime tidak ada di tabel
        if (empty($data['anime'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Anime title ' . $slug . ' not found.');
        }
        return view('anime/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form added list of anime'
        ];
        return view('anime/create', $data);
    }

    public function save()
    {
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->animeModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'lisensi' => $this->request->getVar('lisensi'),
            'keterangan' => $this->request->getVar('keterangan'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'Data successfully added.');

        return redirect()->to('/anime');
    }
}
