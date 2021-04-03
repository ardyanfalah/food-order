<?php namespace App\Models;
use CodeIgniter\Model;
 
class Menu_model extends Model
{
    protected $table = 'tbl_Menu';
     
    public function getMenu($id = false)
    {
        if($id === false){
            $query = $this->db->query(
                "SELECT tbl_menu.*, IFNULL( ROUND(AVG(tbl_rating.nilai),1) , 0)  as rating 
                from tbl_menu
                LEFT JOIN tbl_rating ON tbl_rating.id_menu = tbl_menu.id_menu
                group by tbl_menu.id_menu order by rating DESC"
            );
            return $query->getResultArray();
            // return $this->findAll();
            // return $this->table('tbl_Menu')
            //             ->select('tbl_Menu.*, tbl_Kategori.nama_ktgr')
            //             ->join('tbl_Kategori', 'tbl_Kategori.id_ktgr = tbl_Menu.id_ktgr','INNER')
            //             ->get()
            //             ->getRowArray();
        } else {
            // $query = $this->db->query(
            //     "SELECT *
            //     FROM tbl_Menu
            //     WHERE tbl_Menu.id_menu = $id"
            // );
            // return $query->getRowArray();
            return $this->table('tbl_Menu')
                        ->select('tbl_Menu.*, tbl_Kategori.nama_ktgr')
                        ->join('tbl_Kategori', 'tbl_Kategori.id_ktgr = tbl_Menu.id_ktgr','INNER')
                        ->where('tbl_Menu.id_menu', $id)
                        ->get()
                        ->getRowArray();
            // return $this->getWhere(['id_menu' => $id]);
        }  
    }

    public function getMenuWithRatingById($id = null)
    {
        $query=$this->db->query("SELECT tbl_menu.*,AVG(tbl_rating.nilai) as rating
        FROM `tbl_menu` 
        INNER JOIN tbl_rating on tbl_menu.id_menu = tbl_rating.id_menu 
        WHERE tbl_menu.id_menu = '$id'
        GROUP by tbl_menu.id_menu");
        return $query->getResultArray();
    }
 
    public function insertMenu($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateMenu($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id_menu' => $id]);
    }

    public function updateStatusMenu($id)
    {
        $query = $this->db->query(
            "UPDATE `tbl_menu` SET `status_Menu` = 'Inactive' WHERE `tbl_menu`.`id_menu` = $id;
            "
        );
        return $query->getResult();
        
    } 
}