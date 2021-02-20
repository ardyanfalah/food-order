<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblKategori extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_ktgr '			=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'auto_increment' 	=> TRUE
			],
			'nama_ktgr'       		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '100',
			],
		]);
		$this->forge->addKey('id_ktgr', TRUE);
		$this->forge->createTable('tbl_ktgr');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tbl_kategori');
	}
}
