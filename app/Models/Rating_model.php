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

    public function getHighestRating(){
        $query = $this->db->query(
            "SELECT tbl_menu.*, AVG(tbl_rating.nilai) as rating 
            from tbl_rating, tbl_menu 
            where tbl_rating.id_menu = tbl_menu.id_menu 
            group by tbl_rating.id_menu order by rating DESC limit 5"
        );
        return $query->getResultArray();
    }
 
    public function insertRating($data)
    {
        return $this->db->table($this->table)->insertBatch($data);
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