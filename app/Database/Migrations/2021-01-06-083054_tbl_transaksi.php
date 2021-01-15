<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblTransaksi extends Migration
{
	public function up()
	{
		$this->db->enableForeignKeyChecks();
		$this->forge->addField([
			'Id_Trx'				=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'auto_increment' 	=> TRUE
			],
			'Id_Admin'				=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'null'				=> TRUE
			],
			'Id_Pelanggan'			=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'null'				=> TRUE
			],
			'Id_Menu'				=> [
				'type'           	=> 'BIGINT',
				'constraint'     	=> 20,
				'unsigned'       	=> TRUE,
				'null'				=> TRUE
			],
			'Jumlah_Makanan'       		=> [
				'type'           	=> 'INT',
				'constraint'     	=> '11',
			],
			'Harga_Menu'       		=> [
				'type'           	=> 'INT',
				'constraint'     	=> '11',
			],
			'Tanggal_Trx'       	=> [
				'type'           	=> 'DATE'
			]
		]);
		$this->forge->addKey('Id_Trx', TRUE);
		$this->forge->addForeignKey('Id_Admin','tbl_user','id','CASCADE','CASCADE');
		$this->forge->addForeignKey('Id_Pelanggan','tbl_user','id','CASCADE','CASCADE');
		$this->forge->addForeignKey('Id_Menu','tbl_menu','Id_Menu','CASCADE','CASCADE');
		$this->forge->createTable('tbl_transaksi');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('tbl_transaksi');
	}
}
