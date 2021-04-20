<?php namespace App\Database\Seeds;

class UserSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        // $data = [
        //     'Nama'  => 'user',
        //     'Alamat'      => '-',
        //     'email'     => 'user@example.com',
        //     'password'  => 'user',
        //     'status'    => 'Active',
        //     'level'     => 'User'
        // ];
        // $this->db->table('tbl_user')->insert($data);


        $data = [
            'nama_plgn'      => 'Jhon',
            'alamat'         => 'Bandung Selatan',
            'email'          => 'jhon@example.com',
            'no_hp'          => '085216167890',
            'password'       => '12345',
        ];
        $this->db->table('tbl_pelanggan')->insert($data);
    }
} 