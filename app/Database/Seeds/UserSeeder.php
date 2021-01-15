<?php namespace App\Database\Seeds;

class UserSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            'Nama'  => 'user',
            'Alamat'      => '-',
            'email'     => 'user@example.com',
            'password'  => 'user',
            'status'    => 'Active',
            'level'     => 'User'
        ];
        $this->db->table('tbl_user')->insert($data);
    }
} 