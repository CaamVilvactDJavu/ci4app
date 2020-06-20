<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => "Home | Ca'am Vilvact D'Javu",
            'tes' => ['satu', 'dua', 'tiga']
        ];
        return view('pages/home', $data);
    }
    public function about()
    {
        $data = [
            'title' => "About Me"
        ];

        return view('pages/about', $data);
    }
    public function contact()
    {
        $data = [
            'title' => 'Contact Us',
            'alamat' => [
                [
                    'tipe' => 'Rumah',
                    'alamat' => 'Jl. SOEKARNO HATTA No. 123',
                    'kota' => 'Bukittinggi'
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'Jl. HAMKA No.193',
                    'kota' => 'Bukittinggi'
                ]
            ]
        ];

        return view('pages/contact', $data);
    }
    //------------------------------------------------------------------------------------------
}
