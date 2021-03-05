<?php namespace App\Models;
use CodeIgniter\Model;
 
class Laporan_model extends Model
{
    function get_all_transaksi(){
        $query=$this->db->query("SELECT * FROM tbl_pemesanan order by id_pmsn ASC");
        return $query;
      } // tutup function
}