<?php

namespace App\Controllers;
use App\Models\ComicsModel;

class Comics extends BaseController
{
    protected $comicsModel;
    public function __construct()
    {
        $this->comicsModel = new ComicsModel();
    }

    // method index
    public function index()
    {
        $data = [
            'title' => 'Komik',
            'komik' => $this->comicsModel->getComics()
        ];

        return view('comics/index', $data);
    }

    // method detail
    public function detail ($slug)
    {
        $data = [
            'title' => 'Detail Komik',
            'komik' => $this->comicsModel->getComics($slug)
        ];

        // jika komik tidak ada ditabel
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Komik' . $slug . 'tidak ditemukan');
        }

        return view('comics/detail', $data);
    }

    // method create
    public function create ()
    {
        $data = [
            'title' => 'Tambah Komik Baru',
            // mengambil validasi dari save method
            'validation' => \Config\Services::validation()
        ];
        return view('comics/create', $data);
    }

    // method save
    public function save()
    {
        // validasi input
        if(!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' =>[
                    'required' => '{field} komik harus diisi.',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
                ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png,]',
            'error' => [
                'max_size' => 'Ukuran file terlalu besar',
                'is_image' => 'Yang anda pilih bukan gambar',
                'mime_in' => 'Yang anda pilih bukan gambar',
            ]

            ]
        ])){
            // $validation = \Config\Services::validation();
            // mengirim validasi ke method create
            return redirect()->to(base_url().'/Comics/create')->withInput();
        }

        // ambil gambar
        $fileSampul = $this->request->getFile('sampul');
        // apakah tidak ada gambar yang diupload
        if ($fileSampul->getError()==4) {
            $namaSampul ='gambarawal.jpg';
        } else {
            // ambil nama file sampul random
            $namaSampul = $fileSampul->getRandomName();
            // pindahkan file ke folder app/public/png (move langsung mengirim ke folder public)
            $fileSampul->move('img', $namaSampul);
        }
        
        // proses penginputan
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->comicsModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/comics');
    }
    // delete method
    public function delete($id)
    {
        // cari gambar berdasarkan id
        $komik = $this->comicsModel->find($id);

        // cek jika file gambarnya default
        if($komik['sampul'] != 'gambarawal.jpg'){
            // hapus gambar
            unlink('img/' . $komik['sampul']);
        }

        $this->comicsModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/comics');
    }
    // 
    public function edit($slug)
    {
        $data = [
            'title' => 'Ubah Data Komik',
            // mengambil validasi dari save method
            'validation' => \Config\Services::validation(),
            'komik' => $this->comicsModel->getComics($slug)
        ];
        return view('comics/edit', $data);
    }
    public function update($id)
    {
            // CEK JUDUL
            $oldComics = $this->comicsModel->getComics($this->request->getVar('slug'));
            if ($oldComics ['judul'] == $this->request->getVar('judul')) {
                $rule_judul = 'required';
            } else {
                $rule_judul = 'required|is_unique[komik.judul]';
            }

            // validasi update
        if(!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' =>[
                    'required' => '{field} komik harus diisi.',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
                ],
                'sampul' => [
                    'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png,]',
                'error' => [
                    'max_size' => 'Ukuran file terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar',
                ]
    
                ]
            ])){
                // $validation = \Config\S ervices::validation();
                // mengirim validasi ke method create
                return redirect()->to(base_url().'/Comics/edit/' . $this->request->getVar('slug'))->withInput();
            }
            
            $fileSampul = $this->request->getFile('sampul');

            // cek gambar, apakah tetap gambar lama
            $komik = $this->comicsModel->find($id);
            if ($fileSampul->getError() == 4) {
                $namaSampul = $this->request->getVar('sampulLama');
            } else {
                $namaSampul = $fileSampul->getRandomName();
                $fileSampul->move('img', $namaSampul);
                if ($komik['sampul'] != 'gambarawal.jpg') {
                    unlink('img/' . $this->request->getVar('sampulLama'));
                }
            }

            // proses penginputan
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->comicsModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/comics');
    }
}