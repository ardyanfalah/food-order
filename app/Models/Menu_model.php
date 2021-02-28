<?php namespace App\Models;
use CodeIgniter\Model;
 
class Menu_model extends Model
{
    protected $table = 'tbl_Menu';
     
    public function getMenu($id = false)
    {
        if($id === false){
            $query = $this->db->query(
                "SELECT tbl_menu.*, IFNULL(AVG(tbl_rating.nilai), 0)  as rating 
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
 
    public function insertMenu($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateMenu($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id_menu' => $id]);
    }

    public function deleteMenu($id)
    {
        return $this->db->table($this->table)->delete(['id_menu' => $id]);
    } 
}