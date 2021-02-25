<?php namespace App\Models;
use CodeIgniter\Model;
 
class PemesananDetail_model extends Model
{
    protected $table = 'tbl_detail_pemesanan';
    protected $primaryKey = 'id_detail_pemesanan';

    public function getDetailPemesanan($id = false)
    {
        // $query = $this->db->query(
        //     "SELECT trans.*, user1.Nama as nama_admin, user2.Nama as nama_pelanggan, tbl_menu.Nama_Menu 
        //     FROM tbl_transaksi trans 
        //     inner join tbl_user user1 on trans.Id_Admin = user1.Id 
        //     inner join tbl_user user2 on trans.Id_Pelanggan = user2.Id 
        //     INNER join tbl_menu on tbl_menu.Id_Menu = trans.Id_Menu"
        // );

        if($id === false){
            // return $query->getResultArray();
            return $this->table('tbl_detail_pemesanan')
                        ->select('tbl_detail_pemesanan.*, tbl_Menu.nama_menu, tbl_Menu.harga_menu')
                        ->join('tbl_Menu', 'tbl_Menu.id_menu = tbl_detail_pemesanan.id_menu','INNER')
                        ->get()
                        ->getResultArray();
        } else {
            return $this->table('tbl_detail_pemesanan')
                        ->select('tbl_detail_pemesanan.*, tbl_Menu.nama_menu, tbl_Menu.harga_menu')
                        ->join('tbl_Menu', 'tbl_Menu.id_menu = tbl_detail_pemesanan.id_menu','INNER')
                        ->where('tbl_detail_pemesanan.id_detail_pemesanan', $id)
                        ->get()
                        ->getRowArray();
        }  

        // if($id === false){
        //     return $this->findAll();
        // } else {
        //     return $this->getWhere(['id_detail_pmsn' => $id]);
        // }  
    }

    public function insertDetailPemesanan($data)
    {
        $this->db->table($this->table)->insert($data);
        return $this->db->insertID();
    }

    public function insertBatchDetailPemesanan($data){
        return $this->db->table($this->table)->insertBatch($data); 
    }

}