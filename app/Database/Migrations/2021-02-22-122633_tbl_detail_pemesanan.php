<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblDetailPemesanan extends Migration
{
	public function up()
	{
		//id_detail_pemesanan	id_pmsn	id_menu	jumlah_pesan
		$this->db->enableForeignKeyChecks();
		$this->forge->addField([
			'id_detail_pemesanan'				=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'auto_increment' 	=> TRUE
			],
			'id_pmsn'				=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
			],
			'id_menu'				=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'null'				=> TRUE
			],
			'jumlah_pesan' 			=> [
				'type'           	=> 'INT',
				'constraint'     	=> '5',
			],
			'rating_status' 		=> [
				'type'           	=> 'ENUM',
				'constraint' 		=> "'DONE','UNDONE'",
				'default' 			=> 'UNDONE'
			],
		]);
		$this->forge->addKey('id_detail_pemesanan', TRUE);
		$this->forge->addForeignKey('id_pmsn','tbl_Pemesanan','id_pmsn','CASCADE','CASCADE');
		$this->forge->addForeignKey('id_menu','tbl_Menu','id_menu','CASCADE','CASCADE');
		$this->forge->createTable('tbl_detail_pemesanan');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tbl_detail_pemesanan');
	}
}
