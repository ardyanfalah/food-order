<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblUser extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'Id'			=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'auto_increment' 	=> TRUE
			],
			'Nama'       		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '100',
			],
			'Alamat'       			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '100',
			],
			'Email'       			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '100',
			],
			'Password'       		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '255',
			],
			'Status' 				=> [
				'type'           	=> 'ENUM',
				'constraint' 		=> "'Active','Inactive'",
				'default' 			=> 'Active'
			],
			'Level' 				=> [
				'type'           	=> 'ENUM',
				'constraint' 		=> "'Admin','User'",
				'default' 			=> 'Admin'
			],
		]);
		$this->forge->addKey('Id', TRUE);
		$this->forge->createTable('tbl_user');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tbl_user');
	}
}
