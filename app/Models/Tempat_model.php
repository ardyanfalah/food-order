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
            $query = $this->db->query(
                "SELECT *
                FROM `tbl_tempat`
                WHERE tbl_tempat.id_tmpt = $id
                "
            );
            return $query->getResultArray();
        }  
    }
 
    public function getCountEmpty()
    {
        $query = $this->db->query(
            "SELECT *
            FROM `tbl_tempat`
            WHERE tbl_tempat.status_tmpt = 'Empty'
            "
        );
        return $query->getResult();
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

    public function updateStatusTempat($status, $id){

        return $this->db->table('tbl_Tempat')
                    ->set('status_tmpt',$status)
                    ->where('id_tmpt', $id)
                    ->update();
    }
    
}