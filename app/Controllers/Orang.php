<?php

namespace App\Controllers;

use App\Models\OrangModel;

class Orang extends BaseController
{
    protected $orangModel;
    public function __construct()
    {
        $this->orangModel = new OrangModel();
    }
    public function index()
    {
        $pager = \Config\Services::pager();
        $model = new \App\Models\OrangModel();
        $data = [
            'title' => 'List Orang',
            'orang' => $this->orangModel->getOrang(),
            'orang' => $model->paginate(8, 'bootstrap'),
            'pager' => $model->pager
        ];
        return view('orang/index', $data);
    }
}
