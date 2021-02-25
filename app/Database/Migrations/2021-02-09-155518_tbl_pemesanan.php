<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblPemesanan extends Migration
{
	public function up()
	{

		//id_pmsn	id_admin	id_plgn	id_tmpt	waktu_pmsn	waktu_dtg	waktu_byr	status_pemesanan	total_harga

		$this->db->enableForeignKeyChecks();
		$this->forge->addField([
			'id_pmsn'				=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'auto_increment' 	=> TRUE
			],
			'id_admin'				=> [
				'type'           	=> 'INT',
				'constraint'     	=> 5,
				'unsigned'       	=> TRUE,
				'null'				=> TRUE
			],
			'id_plgn'				=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'null'				=> TRUE
			],
			'id_tmpt'				=> [
				'type'           	=> 'INT',
				'constraint'     	=> 5,
				'unsigned'       	=> TRUE,
				'null'				=> TRUE
			],
			'waktu_pmsn' 			=> [
				'type'           	=> 'DATETIME',
			],
			'waktu_dtg' 			=> [
				'type'           	=> 'DATETIME',
				'null'				=> TRUE
			],
			'waktu_byr' 			=> [
				'type'           	=> 'DATETIME',
				'null'				=> TRUE
			],
			'status_pemesanan' 		=> [
				'type'           	=> 'ENUM',
				'constraint' 		=> "'Menunggu_Verifikasi','Proses_Pembuatan','Selesai'",
				'default' 			=> 'Menunggu_Verifikasi'
			],
			'total_harga' 			=> [
				'type'           	=> 'INT',
				'constraint'     	=> '11',
			],
		]);
		$this->forge->addKey('id_pmsn', TRUE);
		$this->forge->addForeignKey('id_admin','tbl_Admin','id_admin','CASCADE','CASCADE');
		$this->forge->addForeignKey('id_plgn','tbl_Pelanggan','id_plgn','CASCADE','CASCADE');
		$this->forge->addForeignKey('id_tmpt','tbl_Tempat','id_tmpt','CASCADE','CASCADE');
		$this->forge->createTable('tbl_Pemesanan');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tbl_Pemesanan');
	}
}
