<?php namespace App\Models;
use CodeIgniter\Model;
 
class Product_model extends Model
{
    protected $table = 'tbl_menu';
     
    public function getProduct($id = false)
    {
        // if($id === false){
        //     return $this->table('products')
        //                 ->join('categories', 'categories.category_id = products.category_id')
        //                 ->get()
        //                 ->getResultArray();
        // } else {
        //     return $this->table('products')
        //                 ->join('categories', 'categories.category_id = products.category_id')
        //                 ->where('products.product_id', $id)
        //                 ->get()
        //                 ->getRowArray();
        // }   
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

    public function getPrice($id)
    {
        return $this->db->table($this->table)->getWhere(['Id_Menu' => $id])->getRowArray();
    }
}