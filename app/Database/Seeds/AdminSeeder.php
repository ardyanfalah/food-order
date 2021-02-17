<?php namespace App\Database\Seeds;

class AdminSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        // $data = [
        //     'Nama'  => 'admin',
        //     'Alamat'      => '-',
        //     'email'     => 'admin@example.com',
        //     'password'  => 'admin',
        //     'status'    => 'Active',
        //     'level'     => 'Admin'
        // ];
        // $this->db->table('tbl_user')->insert($data);


        $data = [
            'nama_admin'         => 'admin',
            'email'              => 'admin@example.com',
            'no_hp'              => '085215156789',
            'password'           => 'admin',
            'status_admin'       => 'Active',
        ];
        $this->db->table('tbl_Admin')->insert($data);

    }
} 