<?php namespace App\Models;
use CodeIgniter\Model;
 
class Tempat_model extends Model
{
    protected $table = 'tbl_Tempat';
     
    public function getTempat($id = false)
    {
        if($id === false){
            return $this->findAll();
        } else {
            return $this->getWhere(['id_tmpt' => $id]);
        }  
    }
 
    public function insertTempat($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateTempat($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id_tmpt' => $id]);
    }

    public function deleteTempat($id)
    {
        return $this->db->table($this->table)->delete(['id_tmpt' => $id]);
    } 
}