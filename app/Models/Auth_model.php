<?php namespace App\Models;
use CodeIgniter\Model;

class Auth_model extends Model
{
    protected $table = "tbl_admin";

    public function cek_login($email)
    {
        $query = $this->table('tbl_admin')
                ->where('email', $email)
                ->countAll();

        if($query >  0){
            $hasil = $this->table('tbl_admin')
                    ->where('email', $email)
                    ->limit(1)
                    ->get()
                    ->getRowArray();
        } else {
            $hasil = array(); 
        }
       
        return $hasil;
        // return true;
    }

    public function register($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
}
?>