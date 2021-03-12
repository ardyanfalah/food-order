<?php namespace App\Models;
use CodeIgniter\Model;
 
class TempatDetail_model extends Model
{
    protected $table = 'tbl_detail_tempat';
     
    public function getDetailPemesananTempat($id = false)
    {
        if($id === false){
            return $this->findAll();
        } else {
            return $this->getWhere(['id_detail_tempat' => $id]);
        }  
    }

    public function getTempatByPemesanan($id)
    {
        $query = $this->db->query("SELECT GROUP_CONCAT(tbl_tempat.no_tmpt) as no_tempat
                                    from tbl_detail_tempat
                                    INNER JOIN tbl_tempat on tbl_detail_tempat.id_tmpt = tbl_tempat.id_tmpt
                                    where tbl_detail_tempat.id_pmsn = '$id';");
        return $query->getResult();
    }
 
    public function insertDetailPemesananTempat($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function insertBatchDetailPemesananTempat($data){
        return $this->db->table($this->table)->insertBatch($data); 
    }

    public function updateDetailPemesananTempat($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id_detail_tempat' => $id]);
    }

    public function deleteDetailPemesananTempat($id)
    {
        return $this->db->table($this->table)->delete(['id_detail_tempat' => $id]);
    } 
}