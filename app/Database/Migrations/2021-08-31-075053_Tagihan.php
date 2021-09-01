<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tagihan extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
			"id" => [
				"type" => "int",
				"constraint" => 3,
				"auto_increment" => true
			],
			"jenis" => [
				"type" => "varchar",
				"constraint" => 30,
			],
			"nim_mahasiswa" => [
				"type" => "varchar",
				"constraint" => 12,
			],
			"jumlah" => [
				"type" => "varchar",
				"constraint" => 7,
			],
			"tanggal_dibuat" => [
				"type" => "date"
			],
			"tanggal_batas" => [
				"type" => "date"
			],
			"is_lunas" => [
				"type" => "boolean",
				"default" => false
			]
		]);
		$this->forge->addKey( "id", true );
		$this->forge->addForeignKey( "nim_mahasiswa", "mahasiswa", "nim", "cascade", "cascade" );
		$this->forge->createTable( "tagihan" );
	}

	public function down()
	{
		//
		$this->forge->dropTable( "tagihan", true );
	}
}
