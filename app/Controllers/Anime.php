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
        $anime = $this->animeModel->findAll();
        $data = [
            'title' => 'Daftar Anime',
            'anime' => $anime
        ];



        return view('anime/index', $data);
    }
}
