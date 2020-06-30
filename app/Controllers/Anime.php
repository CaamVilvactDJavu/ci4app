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
            'title' => 'Form added list of anime',
            'validation' => \Config\Services::validation()
        ];
        return view('anime/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[anime.judul]',
                'errors' => [
                    'required' => 'Anime title must be filled in.',
                    'is_unique' => 'Anime titles already registered.'
                ]
            ],
            'penulis' => [
                'rules' => 'required[anime.penulis]',
                'errors' => [
                    'required' => 'Anime writer must be filled in.'
                ]
            ],
            'lisensi' => [
                'rules' => 'required[anime.lisensi]',
                'errors' => [
                    'required' => 'Anime license must be filled.'
                ]
            ],
            'keterangan' => [
                'rules' => 'required[anime.keterangan]',
                'errors' => [
                    'required' => 'Anime description must be filled in.'
                ]
            ],
            'sampul' => [
                'rules' => 'required[anime.sampul]',
                'errors' => [
                    'required' => 'Anime covers must be filled in.'
                ]
            ],

        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/anime/create')->withInput()->with('validation', $validation);
        }

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
    public function delete($id)
    {
        $this->animeModel->delete($id);
        session()->setFlashdata('pesan', 'Data successfully deleted.');
        return redirect()->to('/anime');
    }
    public function edit($slug)
    {
        $data = [
            'title' => 'Form changes a list of anime',
            'validation' => \Config\Services::validation(),
            'anime' => $this->animeModel->getAnime($slug)
        ];
        return view('anime/edit', $data);
    }
    public function update($id)
    {
        // cek judul 
        $animeLama = $this->animeModel->getAnime($this->request->getVar('slug'));
        if ($animeLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[anime.judul]';
        }
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Anime title must be filled in.',
                    'is_unique' => 'Anime titles already registered.'
                ]
            ],
            'penulis' => [
                'rules' => 'required[anime.penulis]',
                'errors' => [
                    'required' => 'Anime writer must be filled in.'
                ]
            ],
            'lisensi' => [
                'rules' => 'required[anime.lisensi]',
                'errors' => [
                    'required' => 'Anime license must be filled.'
                ]
            ],
            'keterangan' => [
                'rules' => 'required[anime.keterangan]',
                'errors' => [
                    'required' => 'Anime description must be filled in.'
                ]
            ],
            'sampul' => [
                'rules' => 'required[anime.sampul]',
                'errors' => [
                    'required' => 'Anime covers must be filled in.'
                ]
            ],

        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/anime/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->animeModel->save([
            'id' => $id,
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
