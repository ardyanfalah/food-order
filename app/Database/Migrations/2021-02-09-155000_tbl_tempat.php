<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblTempat extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_tmpt'				=> [
				'type'           	=> 'INT',
				'constraint'     	=> 5,
				'unsigned'       	=> TRUE,
				'auto_increment' 	=> TRUE
			],
			'no_tmpt'       		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '5',
			],			
			'deskripsi'       		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '200',
			],
			'status_tmpt'         	=> [
				'type'           	=> 'ENUM',
				'constraint' 		=> "'Empty','Reserved'",
				'default' 			=> 'Empty'
			],
		]);
		$this->forge->addKey('id_tmpt', TRUE);
		$this->forge->createTable('tbl_Tempat');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tbl_Tempat');
	}
}
