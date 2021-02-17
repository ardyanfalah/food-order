<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblAdmin extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_admin'				=> [
				'type'           	=> 'INT',
				'constraint'     	=> 5,
				'unsigned'       	=> TRUE,
				'auto_increment' 	=> TRUE
			],
			'nama_admin'       		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '50',
			],			
			'email'       			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '50',
			],
			'no_hp'         		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '15',
			],
			'password' 				=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '20',
			],
			'status_admin' 			=> [
				'type'           	=> 'ENUM',
				'constraint' 		=> "'Active','NonActive'",
				'default' 			=> 'Active'
			],
		]);
		$this->forge->addKey('id_admin', TRUE);
		$this->forge->createTable('tbl_Admin');

	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tbl_Admin');
	}
}
