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
			'id_pmsn'				=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE
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
		$this->forge->addForeignKey('id_menu','tbl_menu','id_menu','CASCADE','CASCADE');
		$this->forge->addForeignKey('id_plgn','tbl_pelanggan','id_plgn','CASCADE','CASCADE');
		$this->forge->addForeignKey('id_pmsn','tbl_pemesanan','id_pmsn','CASCADE','CASCADE');
		$this->forge->createTable('tbl_rating');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tbl_rating');
	}
}
