<?php namespace App\Models;
use CodeIgniter\Model;
 
class Pemesanan_model extends Model
{
    protected $table = 'tbl_pemesanan';
    protected $primaryKey = 'id_pmsn';
    protected $tableDetail = 'tbl_detail_pemesanan';
    protected $primaryKeyDetail = 'id_detail_pemesanan';

    public function getPemesanan($id = false)
    {
        // $query = $this->db->query(
        //     "SELECT tbl_pemesanan.*, tbl_pelanggan.nama_plgn,tbl_admin.nama_admin
        //     FROM `tbl_pemesanan` 
        //     INNER JOIN tbl_admin on tbl_admin.id_admin = tbl_pemesanan.id_admin
        //     INNER JOIN tbl_pelanggan on tbl_pelanggan.id_plgn = tbl_pemesanan.id_plgn"
        // );
        // return $query->getResultArray();

        // if($id === false){
            // return $query->getResultArray();
            // return $this->table('tbl_Pemesanan')
            //             ->select('tbl_Admin.nama_admin, tbl_Admin.no_hp ,tbl_Pelanggan.nama_plgn, tbl_Pelanggan.no_hp, tbl_Menu.nama_menu, tbl_Menu.harga_menu, tbl_Pemesanan.*')
            //             ->join('tbl_Admin', 'tbl_Admin.id_admin = tbl_Pemesanan.id_admin','INNER')
            //             ->join('tbl_Pelanggan', 'tbl_Pelanggan.id_plgn = tbl_Pelanggan.id_plgn','INNER')
            //             ->join('tbl_Menu', 'tbl_Menu.id_menu = tbl_Pemesanan.id_menu','INNER')
            //             ->get()
            //             ->getResultArray();
        // } else {
            // return $this->table('tbl_Pemesanan')
            //             ->select('tbl_Admin.nama_admin, tbl_Admin.no_hp ,tbl_Pelanggan.nama_plgn, tbl_Pelanggan.no_hp, tbl_Menu.nama_menu, tbl_Menu.harga_menu, tbl_Pemesanan.*')
            //             ->join('tbl_Admin', 'tbl_Admin.id_admin = tbl_Pemesanan.id_admin','INNER')
            //             ->join('tbl_Pelanggan', 'tbl_Pelanggan.id_plgn = tbl_Pelanggan.id_plgn','INNER')
            //             ->join('tbl_Menu', 'tbl_Menu.id_menu = tbl_Pemesanan.id_menu','INNER')
            //             ->where('tbl_Pemesanan.id_pmsn', $id)
            //             ->get()
            //             ->getRowArray();
        // }  

        if($id === false){
            // return $this->findAll();
            $query = $this->db->query(
                "SELECT tbl_pemesanan.*, tbl_pelanggan.nama_plgn,tbl_admin.nama_admin
                FROM `tbl_pemesanan` 
                INNER JOIN tbl_admin on tbl_admin.id_admin = tbl_pemesanan.id_admin
                INNER JOIN tbl_pelanggan on tbl_pelanggan.id_plgn = tbl_pemesanan.id_plgn"
            );
            return $query->getResultArray();
            // return $this->table('tbl_pemesanan')
            //             ->select('tbl_Pemesanan.*, tbl_Pelanggan.nama_plgn,tbl_Admin.nama_admin')
            //             ->join('tbl_Admin', 'tbl_Admin.id_admin = tbl_Pemesanan.id_admin','INNER')
            //             ->join('tbl_Pelanggan', 'tbl_Pelanggan.id_plgn = tbl_Pelanggan.id_plgn','INNER')
            //             ->get()
            //             ->getResultArray();
        } else {
            // return $this->getWhere(['id_pmsn' => $id]);
            // return $this->table('tbl_Pemesanan')
            //             ->select('tbl_Pemesanan.*, tbl_Pelanggan.nama_plgn,tbl_Admin.nama_admin')
            //             ->join('tbl_Admin', 'tbl_Admin.id_admin = tbl_Pemesanan.id_admin','INNER')
            //             ->join('tbl_Pelanggan', 'tbl_Pelanggan.id_plgn = tbl_Pelanggan.id_plgn','INNER')
            //             ->where('tbl_Pemesanan.id_pmsn', $id)
            //             ->get()
            //             ->getResultArray();
            $query = $this->db->query(
                "SELECT tbl_pemesanan.*, tbl_pelanggan.nama_plgn,tbl_admin.nama_admin
                FROM `tbl_pemesanan`
                INNER JOIN tbl_admin on tbl_admin.id_admin = tbl_pemesanan.id_admin
                INNER JOIN tbl_pelanggan on tbl_pelanggan.id_plgn = tbl_pemesanan.id_plgn
                WHERE tbl_pemesanan.id_pmsn = $id
                "
                
            );
            return $query->getResultArray();
        }  
    }

    public function updateStatusPemesanan($id,$data){
        return $this->db->table('tbl_Pemesanan')
                    ->set('status_pemesanan', $data)
                    ->where('id_pmsn', $id)
                    ->update();
    }
   
    public function insertPemesanan($data)
    {
        $this->db->table($this->table)->insert($data);
        return $this->db->insertID();
    }

    public function insertBatchPemesanan($data){
        return $this->db->table($this->table)->insertBatch($data); 
    }
    public function insertBatchDetailPemesanan($data){
        return $this->db->table($this->tableDetail)->insertBatch($data); 
    }
    public function getNextId(){
        $query = $this->db->query(
            "SELECT AUTO_INCREMENT
            FROM information_schema.TABLES
            WHERE TABLE_NAME = 'tbl_Pemesanan'"
        );
        return $query->getRowArray();
    }

    public function getLastId(){
        return $this->db->insertID();
    }

}