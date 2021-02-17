<?php namespace App\Models;
use CodeIgniter\Model;
 
class PemesananModel extends Model
{
    protected $table = 'tbl_menu';
    protected $primaryKey = 'Id_Menu';
    protected $allowedFields = ['Nama_Menu','Harga_Menu','Status_Menu','Image_Menu','Deskripsi_Menu'];

    public function getProduct($id = false)
    {
        
        if($id === false){
            return $this->table('tbl_menu')
                        ->get()
                        ->getResultArray();
        } else {
            return $this->table('tbl_menu')
                        ->where('tbl_menu.Id_Menu', $id)
                        ->get()
                        ->getRowArray();
        }   
    }
 
    public function insertProduct($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateProduct($data, $id)
    {
        // return $this->db->table($this->table)->update($data, ['product_id' => $id]);
        return $this->db->table($this->table)->update($data, ['Id_Menu' => $id]);

    }

    public function deleteProduct($id)
    {
        return $this->db->table($this->table)->delete(['Id_Menu' => $id]);
    } 

}