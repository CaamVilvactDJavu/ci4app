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
            'title' => 'List Anime',
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
                'rules' => 'max_size[sampul,20000]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Cover size too large',
                    'is_image' => 'You choose not the cover',
                    'mime_in' => 'You choose not the cover'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/anime/create')->withInput()->with('validation', $validation);
            return redirect()->to('/anime/create')->withInput();
        }

        // Ambil gambar
        $fileSampul = $this->request->getFile('sampul');
        // Apakah tidak ada gambar yang diupload
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'default.jpg';
        } else {
            // Generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            // Pindahkan file ke folder img
            $fileSampul->move('img', $namaSampul);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->animeModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'lisensi' => $this->request->getVar('lisensi'),
            'keterangan' => $this->request->getVar('keterangan'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data successfully added.');

        return redirect()->to('/anime');
    }
    public function delete($id)
    {
        // Cari gambar berdasarkan id
        $anime = $this->animeModel->find($id);

        // Cek jika file gambarnya default.jpg
        if ($anime['sampul'] != 'default.jpg') {
            // Hapus gambar
            unlink('img/' . $anime['sampul']);
        }

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
                'rules' => 'max_size[sampul,20000]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Cover size too large',
                    'is_image' => 'You choose not the cover',
                    'mime_in' => 'You choose not the cover'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to('/anime/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $fileSampul = $this->request->getFile('sampul');
        // Cek gambar, apakah tetap gambar lama
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            // Generate nama file random
            $namaSampul = $fileSampul->getRandomName();
            // Pindahkan gambar
            $fileSampul->move('img', $namaSampul);
            // Hapus file yang lama
            unlink('img/' . $this->request->getVar('sampulLama'));
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->animeModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'lisensi' => $this->request->getVar('lisensi'),
            'keterangan' => $this->request->getVar('keterangan'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data successfully added.');

        return redirect()->to('/anime');
    }
}
