<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblPelanggan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_plgn'				=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'auto_increment' 	=> TRUE
			],
			'nama_plgn'       		=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '50',
			],
			'alamat'       			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '200',
			],
			'email'       			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '50',
			],
			'no_hp'       			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '15',
			],
			'password' 				=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> '20',
			],
			
		]);
		$this->forge->addKey('id_plgn', TRUE);
		$this->forge->createTable('tbl_Pelanggan');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tbl_Pelanggan');
	}
}
