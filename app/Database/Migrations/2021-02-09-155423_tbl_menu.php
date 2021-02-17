<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblMenu extends Migration
{
	public function up()
	{

		$this->db->enableForeignKeyChecks();

		$this->forge->addField([
			'id_menu'			=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'auto_increment' 	=> TRUE
			],
			'nama_menu'       		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '50',
			],
			'harga_menu'       		=> [
				'type'           	=> 'INT',
				'constraint'     	=> 15,
			],
			'id_ktgr'				=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'null'				=> TRUE,
			],
			'gambar_menu'       	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '100',
				'null'           	=> TRUE,
			],
			'deskripsi_menu' 		=> [
				'type'           	=> 'TEXT',
				'null'           	=> TRUE,
			],
		]);
		$this->forge->addKey('id_menu', TRUE);
		$this->forge->addForeignKey('id_ktgr','tbl_Kategori','id_ktgr','CASCADE','CASCADE');
		$this->forge->createTable('tbl_Menu');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tbl_Menu');
	}
}
