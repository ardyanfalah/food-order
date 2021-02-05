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
        $query = $this->db->query("SELECT trans.*, user1.Nama as nama_admin, user2.Nama as nama_pelanggan, tbl_menu.Nama_Menu FROM tbl_transaksi trans inner join tbl_user user1 on trans.Id_Admin = user1.Id inner join tbl_user user2 on trans.Id_Pelanggan = user2.Id INNER join tbl_menu on tbl_menu.Id_Menu = trans.Id_Menu");
        if($id === false){
            return $query->getResultArray();
            // return $this->table('tbl_transaksi')
            //             ->select('tbl_menu.*, tbl_transaksi.*,tbl_user.Nama')
            //             ->join('tbl_menu', 'tbl_menu.Id_Menu = tbl_transaksi.Id_Menu','INNER')
            //             ->join('tbl_user', 'tbl_user.Id = tbl_transaksi.Id_Admin','INNER')
            //             ->get()
            //             ->getResultArray();
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