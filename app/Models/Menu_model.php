<?php namespace App\Models;
use CodeIgniter\Model;
 
class Menu_model extends Model
{
    protected $table = 'tbl_Menu';
     
    public function getMenu($id = false)
    {
        if($id === false){
            return $this->findAll();
        } else {
            return $this->getWhere(['id_menu' => $id]);
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