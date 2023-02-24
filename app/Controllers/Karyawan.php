<?php

namespace App\Controllers;
use App\Models\KaryawanModel;

class Karyawan extends BaseController
{
    protected $karyawanModel;
    public function __construct()
    {
        $this->karyawanModel = new KaryawanModel();
    }

    // method index
    public function index()
    {
        $currentPage = $this->request->getVar('page_karyawan') ? $this->request->getVar('page_karyawan') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
           $karyawan = $this->karyawanModel->search($keyword);
        } else {
            $karyawan = $this->karyawanModel;
        }
        $data = [
            'title' => 'Karyawan',
            'karyawan' => $karyawan->paginate(10,'karyawan'),
            'pager' => $this->karyawanModel->pager,
            'currentPage' => $currentPage
        ];

        return view('karyawan/index', $data);
    }

}