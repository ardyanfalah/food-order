<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblMenu extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'Id_Menu'			=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'auto_increment' 	=> TRUE
			],
			'Nama_Menu'       		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '100',
			],
			'Harga_Menu'       			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '100',
			],
			'Jenis_Menu'       			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '100',
			],
		]);
		$this->forge->addKey('Id_Menu', TRUE);
		$this->forge->createTable('tbl_menu');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
