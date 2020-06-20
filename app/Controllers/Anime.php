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
        return view('anime/detail', $data);
    }
}
