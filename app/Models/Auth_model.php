<?php namespace App\Models;
use CodeIgniter\Model;

class Auth_model extends Model
{
    protected $table = "tbl_user";

    public function cek_login($email)
    {
        $query = $this->table('tbl_user')
                ->where('Email', $email)
                ->countAll();

        if($query >  0){
            $hasil = $this->table('tbl_user')
                    ->where('Email', $email)
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