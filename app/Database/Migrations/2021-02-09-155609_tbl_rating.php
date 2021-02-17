<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblRating extends Migration
{
	public function up()
	{
		$this->db->enableForeignKeyChecks();

		$this->forge->addField([
			'id_rating'			=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'auto_increment' 	=> TRUE
			],
			'id_menu'			=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'null'				=> TRUE
			],
			'id_plgn'				=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'null'				=> TRUE
			],
			'nilai'       			=> [
				'type'           	=> 'INT',
				'constraint'     	=> 2,
				'null'           	=> TRUE,
			],
			'catatan' 				=> [
				'type'           	=> 'TEXT',
				'null'           	=> TRUE,
			],
			'waktu_rekam' 			=> [
				'type'           	=> 'DATETIME',
			],
		]);
		$this->forge->addKey('id_rating', TRUE);
		$this->forge->addForeignKey('id_menu','tbl_Menu','id_menu','CASCADE','CASCADE');
		$this->forge->addForeignKey('id_plgn','tbl_Pelanggan','id_plgn','CASCADE','CASCADE');
		$this->forge->createTable('tbl_Rating');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tbl_Rating');
	}
}
