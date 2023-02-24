<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table = 'karyawan';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'alamat'];

    public function search($keyword) {
    //     $builder = $this->table('karyawan')
    //     $builder->like('nama', '$keyword');
    //     return $builder;

        return $this->table('karyawan')->like('nama', $keyword)->orLike('alamat', $keyword);
    }
}