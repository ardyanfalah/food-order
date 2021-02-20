<?php namespace App\Models;
use CodeIgniter\Model;
 
class Rating_model extends Model
{
    protected $table = 'tbl_Rating';
    
    public function getRating($id = false)
    {
        if($id === false){
            return $this->table('tbl_Rating')
                        ->orderBy('nilai','ASC')
                        ->get()
                        ->getResultArray();
        } else {
            return $this->getWhere(['id_rating' => $id]);
        }  
    }

    public function getRatingLimit( $limit = 5)
    {
        return $this->table('tbl_Rating')
                    ->orderBy('nilai','ASC')
                    ->get($limit)
                    ->getResultArray();
        
    }
 
    public function insertRating($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateRating($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id_rating' => $id]);
    }

    public function deleteRating($id)
    {
        return $this->db->table($this->table)->delete(['id_rating' => $id]);
    } 
}