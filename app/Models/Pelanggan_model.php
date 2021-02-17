<?php namespace App\Models;
use CodeIgniter\Model;
 
class Pelanggan_model extends Model
{
    protected $table = 'tbl_Pelanggan';
     
    public function getPelanggan($id = false)
    {
        if($id === false){
            return $this->findAll();
        } else {
            return $this->getWhere(['id_plgn' => $id]);
        }  
    }
 
    public function insertPelanggan($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updatePelanggan($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id_plgn' => $id]);
    }

    public function deletePelanggan($id)
    {
        return $this->db->table($this->table)->delete(['id_plgn' => $id]);
    } 
}