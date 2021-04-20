<?php namespace App\Models;
use CodeIgniter\Model;
 
class PemesananDetail_model extends Model
{
    protected $table = 'tbl_detail_pemesanan';
    protected $primaryKey = 'id_detail_pemesanan';

    public function getDetailPemesanan($id = false)
    {

        if($id === false){
            // return $query->getResultArray();
            return $this->table('tbl_detail_pemesanan')
                        ->select('tbl_detail_pemesanan.*, tbl_menu.nama_menu, tbl_menu.harga_menu')
                        ->join('tbl_menu', 'tbl_menu.id_menu = tbl_detail_pemesanan.id_menu','INNER')
                        ->get()
                        ->getResultArray();
        } else {
            return $this->table('tbl_detail_pemesanan')
                        ->select('tbl_detail_pemesanan.*, tbl_menu.nama_menu, tbl_menu.harga_menu')
                        ->join('tbl_menu', 'tbl_menu.id_menu = tbl_detail_pemesanan.id_menu','INNER')
                        ->where('tbl_detail_pemesanan.id_detail_pemesanan', $id)
                        ->get()
                        ->getRowArray();
        }  

    }

    public function getDetailByPemesanan($idPemesanan = false){
        $query = $this->db->query("SELECT tbl_detail_pemesanan.*, tbl_menu.nama_menu, tbl_menu.harga_menu, tbl_menu.gambar_menu, tbl_detail_pemesanan.jumlah_pesan * tbl_menu.harga_menu as jumlah_harga_pesan
        FROM tbl_detail_pemesanan
        INNER JOIN tbl_menu on tbl_menu.id_menu = tbl_detail_pemesanan.id_menu
        WHERE tbl_detail_pemesanan.id_pmsn = '$idPemesanan'
        ;");
        return $query->getResultArray();
        // return $this->table('tbl_detail_pemesanan')
        //             ->select('tbl_detail_pemesanan.*, tbl_menu.nama_menu, tbl_menu.harga_menu, tbl_detail_pemesanan.jumlah_pesan * tbl_menu.harga_menu jumlah_harga_pesan')
        //             ->join('tbl_menu', 'tbl_menu.id_menu = tbl_detail_pemesanan.id_menu','INNER')
        //             ->where('tbl_detail_pemesanan.id_pmsn', $idPemesanan)
        //             ->get()
        //             ->getRowArray();
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