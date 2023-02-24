<?php

namespace App\Controllers;

use CodeIgniter\Debug\Toolbar\Collectors\Views;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Beranda'
        ];
        echo view('pages/home', $data);
    }
    public function about(){
        $data = [
            'title' => 'Tentang'
        ];
        echo view('pages/about', $data);
    }
    public function contact(){
        $data = [
            'title' => 'Kontak',
            'alamat' => [
                [
                    'tipe' => 'Rumah',
                    'alamat' => 'Inazuma',
                    'kota' => 'Khanreyah'
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'Mondstat',
                    'kota' => 'Celestia'
                ]
            ]
        ];
        return view('pages/contact', $data);
    }
}