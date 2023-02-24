<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class KaryawanSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        for($i = 0; $i<200; $i++){
        $data = [
            'nama'      => $faker->name,
            'alamat'    => $faker->address,
            'create_at' => Time::createFromTimestamp($faker->unixTime()),
            'update_at' => Time::now()
        ];

        $this->db->table('karyawan')->insert($data);
    }



        // $data = [
        //     'nama' => 'M. Syakirin',
        //     'alamat'    => 'Vice City',
        // ];

        // // Simple Queries
        // $this->db->query('INSERT INTO Karyawan (nama, alamat) VALUES(:nama:, :alamat:)', $data);

        // Using Query Builder
    }
}