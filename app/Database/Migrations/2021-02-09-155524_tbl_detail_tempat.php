<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblDetailTempat extends Migration
{
	public function up()
	{
		//$this->db->enableForeignKeyChecks();
		$this->forge->addField([
			'id_detail_tempat'				=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'auto_increment' 	=> TRUE
			],
			'id_tmpt'				=> [
				'type'           	=> 'INT',
				'constraint'     	=> 5,
				'unsigned'       	=> TRUE
			],
			'id_pmsn'				=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE
			],
		]);

		$this->forge->addKey('id_detail_tempat', TRUE);
		$this->forge->addForeignKey('id_pmsn','tbl_Pemesanan','id_pmsn','CASCADE','CASCADE');
		$this->forge->addForeignKey('id_tmpt','tbl_Tempat','id_tmpt','CASCADE','CASCADE');
		$this->forge->createTable('tbl_detail_tempat');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tbl_detail_tempat');
	}
}
