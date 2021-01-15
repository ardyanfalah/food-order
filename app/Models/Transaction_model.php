<?php namespace App\Models;
use CodeIgniter\Model;
 
class Transaction_model extends Model
{
    protected $table = 'tbl_transaksi';
    protected $primaryKey = 'Id_Trx';
     
    // public function getTransaction($id = false)
    // {
    //     if($id === false){
    //         return $this->table('transactions')
    //                     ->select('products.product_name, transactions.*')
    //                     ->join('products', 'products.product_id = transactions.product_id')
    //                     ->get()
    //                     ->getResultArray();
    //     } else {
    //         return $this->table('transactions')
    //                     ->select('products.product_name, transactions.*')
    //                     ->join('products', 'products.product_id = transactions.product_id')
    //                     ->where('transactions.product_id', $id)
    //                     ->get()
    //                     ->getRowArray();
    //     }  
    // }

    // public function insertTransaction($data)
    // {
    //     return $this->db->table($this->table)->insert($data);
    // }
    public function getTransaction($id = false)
    {
        if($id === false){
            return $this->table('tbl_transaksi')
                        ->select('tbl_menu.*, tbl_transaksi.*,tbl_user.Nama')
                        ->join('tbl_menu', 'tbl_menu.Id_Menu = tbl_transaksi.Id_Menu','INNER')
                        ->join('tbl_user', 'tbl_user.Id = tbl_transaksi.Id_Admin','INNER')
                        ->get()
                        ->getResultArray();
        } else {
            return $this->table('tbl_transaksi')
                        ->select('tbl_menu.*, tbl_transaksi.*,tbl_user.Nama')
                        ->join('tbl_menu', 'tbl_menu.Id_Menu = tbl_transaksi.Id_Menu','INNER')
                        ->join('tbl_user', 'tbl_user.Id = tbl_transaksi.Id_Admin','INNER')
                        ->where('tbl_transaksi.Id_Trx', $id)
                        ->get()
                        ->getRowArray();
        }  
    }

    public function insertTransaction($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
}