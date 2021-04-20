<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblPemesanan extends Migration
{
	public function up()
	{
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
			'gambar_bukti_pembayaran'	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '100',
				'null'           	=> TRUE,
			],
			'total_harga' 			=> [
				'type'           	=> 'INT',
				'constraint'     	=> '11',
			],
			'is_takeout' 			=> [
				'type'           	=> 'ENUM',
				'constraint' 		=> "'True','False'",
				'default' 			=> 'False'
			]
		]);
		$this->forge->addKey('id_pmsn', TRUE);
		$this->forge->addForeignKey('id_admin','tbl_Admin','id_admin','CASCADE','CASCADE');
		$this->forge->addForeignKey('id_plgn','tbl_pelanggan','id_plgn','CASCADE','CASCADE');
		$this->forge->createTable('tbl_Pemesanan');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tbl_Pemesanan');
	}
}
